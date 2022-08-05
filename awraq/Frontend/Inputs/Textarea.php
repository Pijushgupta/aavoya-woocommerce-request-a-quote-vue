<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Textarea {
	public static function create($formInput, $key, $id) {
		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="textarea mt-2">';

		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['name'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<textarea id="' . esc_attr($id . $formInput['name'] . $key) . '"  type="text" name="' . esc_attr($id . $formInput['name'] . $key) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . '/></textarea><br>';
		$form .= '</div></div>';
		return $form;
	}
}
