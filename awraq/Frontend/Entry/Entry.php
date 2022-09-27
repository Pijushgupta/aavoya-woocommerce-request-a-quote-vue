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
			'post_type' => sanitize_text_field('aavoya_wraq_fe'),
			'post_title' => (string)$formId,
			'post_content' => serialize($postData),
			'post_status' => sanitize_text_field('publish')
		), true);
		if (!is_wp_error($status)) {
			add_post_meta($status, 'aavoya_wraq_fe_is_opened', false);
		}

		return !is_wp_error($status) ? true : false;
	}
}
