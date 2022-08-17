<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Textarea {
	public static function create($formInput, $key, $id, $oldValueAsParam) {
		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="textarea mt-2">';

		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['name'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$value = strlen($oldValueAsParam[$formInput['uniqueName']][0]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][0]['data'] : '';
		$form .= '<textarea id="' . esc_attr($id . $formInput['name'] . $key) . '"  type="text" name="' . esc_attr($formInput['uniqueName']) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . '/>' . $value . '</textarea>';
		$form .= '</div></div>';
		return $form;
	}
}
