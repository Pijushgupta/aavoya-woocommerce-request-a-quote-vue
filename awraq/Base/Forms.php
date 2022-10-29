<?php

namespace Awraq\Base;

use Awraq\Base\Officer as Officer;
use Awraq\Base\Meta as Meta;

if (!defined('ABSPATH')) exit;

class Forms {

	private static $globalScopeName = 'Awraq\Base\Forms';

	public static function activate() {
		add_action('wp_ajax_awraqGetForms', array(self::$globalScopeName, 'awraqGetForms'));
		add_action('wp_ajax_awraqGetFormHavingMeta', array(self::$globalScopeName, 'awraqGetFormHavingMeta'));
		add_action('wp_ajax_awraqCreateForms', array(self::$globalScopeName, 'awraqCreateForms'));
		add_action('wp_ajax_awraqSaveFormData', array(self::$globalScopeName, 'awraqSaveFormData'));
		add_action('wp_ajax_awraqGetFormMeta', array(self::$globalScopeName, 'awraqGetFormMeta'));
		add_action('wp_ajax_awraqDeleteForm', array(self::$globalScopeName, 'awraqDeleteForm'));
		add_action('wp_ajax_awraqGetCaptchMeta', array(self::$globalScopeName, 'awraqGetCaptchMeta'));
		add_action('wp_ajax_awraqGetCaptchaMeta', array(self::$globalScopeName, 'awraqGetCaptchaMeta'));
		add_action('wp_ajax_awraqUpdateCaptchaMeta', array(self::$globalScopeName, 'awraqUpdateCaptchaMeta'));
		add_action('wp_ajax_awraqGetAdminFormMeta', array(self::$globalScopeName, 'awraqGetAdminFormMeta'));
		add_action('wp_ajax_awraqUpdateAdminFormMeta', array(self::$globalScopeName, 'awraqUpdateAdminFormMeta'));
		add_action('wp_ajax_awraqGetUserFormMeta', array(self::$globalScopeName, 'awraqGetUserFormMeta'));
		add_action('wp_ajax_awraqUpdateUserFormMeta', array(self::$globalScopeName, 'awraqUpdateUserFormMeta'));
	}

	/**
	 * Getting forms
	 * @param void
	 * @return void
	 */
	public static function awraqGetForms() {
		if (!Officer::check($_POST)) wp_die();

		$forms = get_posts(array('post_type' => 'aavoya_wraq_form', 'post_status' => 'publish', 'posts_per_page' => -1));
		empty($forms) ? $forms = null : '';

		echo json_encode($forms);
		wp_die();
	}

	/**
	 * Getting form that having Valid inputs(meta)
	 * @param void
	 * @return void
	 */
	public static function awraqGetFormHavingMeta() {
		if (!Officer::check($_POST)) wp_die();
		$forms = get_posts(array('post_type' => 'aavoya_wraq_form', 'post_status' => 'publish', 'posts_per_page' => -1));
		if (empty($forms)) {
			echo json_encode(null);
			wp_die();
		}
		foreach ($forms as $key => $form) {
			if (Meta::getForm($form->ID) == false) {
				unset($forms[$key]);
			}
		}

		if (gettype($forms) == 'array' && empty($forms)) {
			$forms = null;
		}
		echo json_encode($forms);
		wp_die();
	}

	/**
	 * Creating form and form meta for form inputs and notifications(admin and user)
	 * @param void
	 * @return void
	 */
	public static function awraqCreateForms() {
		if (!Officer::check($_POST)) wp_die();

		$postId = wp_insert_post(array('ID' => '', 'post_type' => 'aavoya_wraq_form', 'post_status' => 'publish'));
		add_post_meta(
			$postId,
			'awraqFormAdminNotification',
			serialize(
				array(
					'en' => 'false',
					'sent_to_email' => sanitize_text_field('{wordpress_admin}'),
					'from_name' => sanitize_text_field('{wordpress_admin_name}'),
					'from_email' => sanitize_text_field('{noreplay@domain.com}'),
					'replay_To' => '',
					'bcc' => '',
					'subject' => '',
					'message' => sanitize_text_field('{all}')
				)
			)
		);
		add_post_meta(
			$postId,
			'awraqFormUserNotification',
			serialize(
				array(
					'en' => 'false',
					'sent_to_email' => '',
					'from_name' => sanitize_text_field('{wordpress_admin_name}'),
					'from_email' => sanitize_text_field('{noreplay@domain.com}'),
					'replay_To' => '',
					'subject' => '',
					'message' => ''
				)
			)
		);
		echo json_encode(get_post($postId));
		wp_die();
	}

	/**
	 * Saving Form Meta(all from design and input related data stored as meta)
	 * @param void
	 * @return void
	 */
	public static function awraqSaveFormData() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if (!$postId ||$postId == 0) wp_die();

		/* Sanitizing Form Title from backend */
		$formTitle = Officer::sanitize($_POST['title'], 'text');

		/* Updating Form Title */
		if ($formTitle) {
			wp_update_post(array('ID' => $postId, 'post_title' => $formTitle, 'post_status' => 'publish'));
		}
		/* Updating Form Title ends */

		/* Converting json string of form filed to array and Sanitizing Form fields -  from backend */
		$data = Officer::jsonToArray($_POST['formdata']);

		$dataSanitized = Officer::formInputSanitize($data);

		echo json_encode(Meta::updateForm($postId, $dataSanitized));

		wp_die();
	}

	/**
	 * Getting form Meta(all from design and input related data stored as meta)
	 * @param void
	 * @return void
	 */
	public static function awraqGetFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if (!$postId ||$postId == 0) wp_die();

		echo json_encode(Meta::getForm($postId));
		wp_die();
	}

	/**
	 * Deleting form
	 * @return void
	 */
	public static function awraqDeleteForm() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if (!$postId ||$postId == 0) wp_die();

		Meta::deleteForm($postId);
		wp_delete_post($postId, true);

		echo json_encode(true);
		wp_die();
	}

	/**
	 * Getting form captcha Meta(google captcha - boolean data)
	 * @param void
	 * @return void
	 */
	public static function awraqGetCaptchaMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['formId'], 'int');
		if (!$postId || $postId == 0) wp_die();

		$isCaptch = get_post_meta($postId, 'googleCaptchaMeta', true);
		if ($isCaptch == true) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
		wp_die();
	}

	/**
	 * Saving form captcha Meta(google captcha - boolean data)
	 * @return void
	 * @return void
	 */
	public static function awraqUpdateCaptchaMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['formId'], 'int');
		if (!$postId || $postId == 0) wp_die();

		$isCaptch = get_post_meta($postId, 'googleCaptchaMeta', true);
		echo json_encode(update_post_meta($postId, 'googleCaptchaMeta', !$isCaptch));
		wp_die();
	}

	/**
	 * Getting form admin Meta(notification setting)
	 * @param void
	 * @return void
	 */
	public static function awraqGetAdminFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if (!$postId || $postId == 0) wp_die();

		$meta = get_post_meta($postId, 'awraqFormAdminNotification', true);
		echo json_encode(unserialize($meta));
		wp_die();
	}

	/**
	 * Saving form admin Meta(notification setting)
	 * @param void
	 * @return void
	 */
	public static function awraqUpdateAdminFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if (!$postId || $postId == 0) wp_die();

		$data = Officer::jsonToArray($_POST['data']);
		foreach ($data as $key => &$input) {
			if ($key != 'en' && $key != 'message') {
				$input = sanitize_text_field($input);
			}
			if ($key == 'message') {
				$input = wp_kses_post($input);
			}
		}
		unset($input);
		echo json_encode(update_post_meta($postId, 'awraqFormAdminNotification', serialize($data)));
		wp_die();
	}

	/**
	 * Getting from User Meta (notification setting)
	 * @param void
	 * @return void
	 */
	public static function awraqGetUserFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize( $_POST['id'], 'int');
		if (!$postId || $postId == 0) wp_die();

		$meta = get_post_meta($postId, 'awraqFormUserNotification', true);
		echo json_encode(unserialize($meta));
		wp_die();
	}

	/**
	 * Updating from User Meta (notification setting)
	 * @param void
	 * @return void
	 */
	public static function awraqUpdateUserFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if (!$postId || $postId == 0) wp_die();

		$data = Officer::jsonToArray($_POST['data']);
		var_dump($data);
		foreach ($data as $key => &$input) {
			if ($key != 'en' && $key != 'message') {
				$input = sanitize_text_field($input);
			}
			if ($key == 'message') {
				$input = wp_kses_post($input);
			}
		}
		unset($input);
		echo json_encode(update_post_meta($postId, 'awraqFormUserNotification', serialize($data)));
		wp_die();
	}
}
