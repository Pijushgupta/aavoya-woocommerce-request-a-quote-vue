<?php

namespace Awraq\Base;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;

class Entries {
	private static $globalScopeName = 'Awraq\Base\Entries';
	public static function enable() {
		add_action('wp_ajax_awraqEntriesGet', array(self::$globalScopeName, 'awraqEntriesGet'));
		add_action('wp_ajax_awraqEntryDelete', array(self::$globalScopeName, 'awraqEntryDelete'));
		add_action('wp_ajax_awraqEntryOpened', array(self::$globalScopeName, 'awraqEntryOpened'));
	}

	/**
	 *
	 * @return void
	 */
	public static function awraqEntriesGet() {
		if (!Officer::check($_POST)) wp_die();
		$entries = get_posts(array(
			'post_type' => 'aavoya_wraq_fe',
			'post_status' => 'publish',
			'posts_per_page' => -1
		));

		$e = array();

		foreach ($entries as $key => $entry) {
			$e[$key]['id'] = $entry->ID;
			$e[$key]['entry'] = unserialize($entry->post_content);
			$e[$key]['form_name'] = get_the_title((int)esc_html($entry->post_title)) == '' ? (int)$entry->post_title : get_the_title((int)esc_html($entry->post_title)) ;
			$e[$key]['date'] = $entry->post_date;
			$e[$key]['is_opened'] = get_post_meta($entry->ID, 'aavoya_wraq_fe_is_opened', true) ? get_post_meta($entry->ID, 'aavoya_wraq_fe_is_opened', true) : false;
		}

		if ($entries) {
			echo json_encode($e);
		} else {
			echo json_encode(0);
		}

		wp_die();
	}

	public static function awraqEntryDelete() {
		if (!Officer::check($_POST)) wp_die();
		$postId = (int)Officer::sanitize($_POST['entryId'], 'int');
		$status = wp_delete_post($postId, true);
		if ($status != false || $status != null) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
		wp_die();
	}

	/**
	 * awraqEntryOpened
	 * @return void
	 */
	public static function awraqEntryOpened() {
		if (!Officer::check($_POST)) wp_die();
		if (!$_POST['postId']) wp_die();
		$postId = (int)Officer::sanitize($_POST['postId'], 'int');

		echo json_encode(update_post_meta($postId, 'aavoya_wraq_fe_is_opened', true));
		wp_die();
	}
}
