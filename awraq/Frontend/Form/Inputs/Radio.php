<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;
class Radio {

	public static function create($formInput, $key, $id): string {
		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="radio mt-2">';
		$form .= '<label >' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>';
		foreach ($formInput['data']['Options'] as $k => $v) {
			$form .= '<input type="radio" id="' . esc_attr($id . $formInput['name'] . $k) . '" name="' . esc_attr($formInput['uniqueName']) . '" value="' . sanitize_text_field($v['value']) . '" style="margin-right:10px;"/>' . '<label for="' . esc_attr($id . $formInput['name'] . $k) . '">' . __(sanitize_text_field($v['name']), AWRAQ_TEXT_DOMAIN) . '</label><br>';
		}
		$form .= '</div></div>';
		return $form;
	}
}
