<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Name {
	public static function create($formInput, $key, $id) {


		$numberOfEnabledFields = 0;
		foreach ($formInput['data']['Options'] as $o) {
			if ($o['enabled'] == true) {
				$numberOfEnabledFields++;
			}
		}
		unset($o);
		if ($numberOfEnabledFields == 0) return;

		$class = '';
		if ($numberOfEnabledFields == 1) {
			$class = 'w-full';
		}
		if ($numberOfEnabledFields == 2) {
			$class = 'w-1/2 pr-2';
		}
		if ($numberOfEnabledFields == 3) {
			$class = 'w-1/3 pr-2';
		}

		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="flex name mt-2">';
		foreach ($formInput['data']['Options'] as $k => $o) {
			if ($o['enabled'] == true) {
				$required = $o['required'] == true ? esc_attr('required') : '';
				$placeholder = $o['placeholder'] ? 'placeholder="' . __(sanitize_text_field($o['placeholder']), AWRAQ_TEXT_DOMAIN) . '"' : '';
				$form .= '<div class="' . $class . '">';
				$form .= '<label for="' . esc_attr($id . preg_replace('/\s+/', '', $o['name']) . $key) . '" class="block">' . __(sanitize_text_field($o['label']), AWRAQ_TEXT_DOMAIN) . '</label>';
				$form .= '<input type="text" id="' . esc_attr($id . preg_replace('/\s+/', '', $o['name']) . $key) . '" name="' . esc_attr($id . preg_replace('/\s+/', '', $o['name']) . $key) . '" ' . $placeholder . ' ' . $required . ' class="block w-full">';
				$form .= '</div>';
			}
		}


		$form .= '</div></div>';
		return $form;
	}
}
