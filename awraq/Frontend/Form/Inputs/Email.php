<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Email {
	public static function create($formInput, $key, $id, $oldValueAsParam) {
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}

		$form = '<div class="' . $css . '"><div class="aavoyaemail aavoyamt-2">';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['name'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . ($required != "" ? " (*)" : "") . '</label>' : '';

		if ($oldValueAsParam != false) {
			$value = strlen($oldValueAsParam[$formInput['uniqueName']][0]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][0]['data'] : '';
		} else {
			$value = '';
		}

		$form .= '<input type="email" id="' . esc_attr($id . $formInput['name'] . $key) . '" class="aavoyaw-full" name="' . esc_attr($formInput['uniqueName']) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . ' value="' . $value . '"/>';
		$form .= '</div></div>';
		return $form;
	}
}
