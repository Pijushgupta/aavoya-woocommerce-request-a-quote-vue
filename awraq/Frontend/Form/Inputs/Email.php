<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Email {
	public static function create($formInput, $key, $id) {
		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="email mt-2">';

		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['name'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="email" id="' . esc_attr($id . $formInput['name'] . $key) . '" name="' . esc_attr($formInput['uniqueName']) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . '/>';
		$form .= '</div></div>';
		return $form;
	}
}
