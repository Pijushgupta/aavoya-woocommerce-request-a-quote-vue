<?php

namespace Awraq\Frontend\Entry;

if (!defined('ABSPATH')) exit;

class Entry {

	/**
	 * add
	 * This to add form entries to the database
	 * @param  mixed $formId
	 * @param  mixed $postData
	 * @return bool
	 */
	public static function add($formId, $postData): bool {
		$status =  wp_insert_post(array(
			'ID' => '',
			'post_type' => 'aavoya_wraq_fe',
			'post_title' => (string)$formId,
			'post_content' => serialize($postData),
			'post_status' => 'publish'
		), true);
		return !is_wp_error($status) ? true : false;
	}


}
