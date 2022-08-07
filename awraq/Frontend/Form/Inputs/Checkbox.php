<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Checkbox {

	public static function create($formInput, $key, $id) {

		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="checkbox mt-2">';
		$form .= '<label style="display:block;">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>';
		foreach ($formInput['data']['Options'] as $k => $v) {
			$form .= '<div class="' . sanitize_html_class($id . $formInput['name'] . $k) . '"><input type="checkbox" id="' . esc_attr($id . $formInput['name'] . $k) . '" name="' . esc_attr($formInput['uniqueName'] . '_' . $k) . '" value="' . sanitize_text_field($v['value']) . '" style="margin-right:10px;"/>' . '<label for="' . esc_attr($id . $formInput['name'] . $k) . '">' . __(sanitize_text_field($v['name']), AWRAQ_TEXT_DOMAIN) . '</label></div>';
		}
		$form .= '</div></div>';
		return $form;
	}
}
