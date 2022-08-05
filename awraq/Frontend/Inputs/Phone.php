<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Phone {
	public static function create($formInput, $key, $id): string {
		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="tel mt-2">';

		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['name'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="tel" id="' . esc_attr($id . $formInput['name'] . $key) . '" name="' . esc_attr($id . $formInput['name'] . $key) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . ' class="w-full"/>';
		$form .= '</div></div>';
		return $form;
	}
}
