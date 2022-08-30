<?php

namespace Awraq\Base;

use Awraq\Base\Officer;
use Awraq\Base\Meta;

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
	}

	public static function awraqGetForms() {
		if (!Officer::check($_POST)) wp_die();

		$forms = get_posts(array('post_type' => 'aavoya_wraq_form', 'post_status' => 'publish', 'posts_per_page' => -1));
		empty($forms) ? $forms = null : '';

		echo json_encode($forms);
		wp_die();
	}

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
		echo json_encode($forms);
		wp_die();
	}

	public static function awraqCreateForms() {
		if (!Officer::check($_POST)) wp_die();
		//TODO: Admin notification meta
		$postId = wp_insert_post(array('ID' => '', 'post_type' => 'aavoya_wraq_form', 'post_status' => 'publish'));
		add_post_meta($postId, 'awraqFormAdminNotification', serialize(array('sent_to_email' => '{wordpress_admin}', 'from_name' => '{wordpress_admin_name}', 'from_email' => 'noreplay@domain.com', 'replay_To' => '', 'bcc' => '', 'subject' => '', 'message' => '{all}')));
		echo json_encode(get_post($postId));
		wp_die();
	}

	public static function awraqSaveFormData() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if ($postId == 0) wp_die();

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

	public static function awraqGetFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if ($postId == 0) wp_die();

		echo json_encode(Meta::getForm($postId));
		wp_die();
	}

	public static function awraqDeleteForm() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['id'], 'int');
		if ($postId == 0) wp_die();

		Meta::deleteForm($postId);
		wp_delete_post($postId, true);

		echo json_encode(true);
		wp_die();
	}

	public static function awraqGetCaptchaMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = $_POST['formId'];
		if (!$postId) wp_die();

		$postId = (int)Officer::sanitize($postId, 'int');
		$isCaptch = get_post_meta($postId, 'googleCaptchaMeta', true);
		if ($isCaptch == true) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
		wp_die();
	}

	public static function awraqUpdateCaptchaMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = $_POST['formId'];
		if (!$postId) wp_die();

		$postId = (int)Officer::sanitize($postId, 'int');
		$isCaptch = get_post_meta($postId, 'googleCaptchaMeta', true);

		echo json_encode(update_post_meta($postId, 'googleCaptchaMeta', !$isCaptch));
		wp_die();
	}
	public static function awraqGetAdminFormMeta() {
		if (!Officer::check($_POST)) wp_die();
		$postId = $_POST['id'];
		if (!$postId) wp_die();
		$postId = (int)Officer::sanitize($postId, 'int');

		$meta = get_post_meta($postId, 'awraqFormAdminNotification', true);

		echo json_encode(unserialize($meta));

		wp_die();
	}
}
