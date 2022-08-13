<?php

namespace Awraq\Base;


use Awraq\Base\Officer;
use Awraq\Base\Meta;

if (!defined('ABSPATH')) exit;

class Forms {

	private static $globalScopeName = 'Awraq\Base\Forms';

	public static function activate() {
		add_action('wp_ajax_awraqGetForms', array(self::$globalScopeName, 'awraqGetForms'));
		add_action('wp_ajax_awraqCreateForms', array(self::$globalScopeName, 'awraqCreateForms'));
		add_action('wp_ajax_awraqSaveFormData', array(self::$globalScopeName, 'awraqSaveFormData'));
		add_action('wp_ajax_awraqGetFormMeta', array(self::$globalScopeName, 'awraqGetFormMeta'));
		add_action('wp_ajax_awraqDeleteForm', array(self::$globalScopeName, 'awraqDeleteForm'));
	}

	public static function awraqGetForms() {
		if (!Officer::check($_POST)) wp_die();

		$forms = get_posts(array('post_type' => 'aavoya_wraq_form', 'post_status' => 'publish', 'posts_per_page' => -1));
		empty($forms) ? $forms = null : '';

		echo json_encode($forms);
		wp_die();
	}

	public static function awraqCreateForms() {
		if (!Officer::check($_POST)) wp_die();
		echo json_encode(get_post(wp_insert_post(array('ID' => '', 'post_type' => 'aavoya_wraq_form', 'post_status' => 'publish'))));
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
}
