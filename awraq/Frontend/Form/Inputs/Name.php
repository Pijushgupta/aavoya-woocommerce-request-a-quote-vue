<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Name {
	public static function create($formInput, $key, $id, $oldValueAsParam) {


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
			$class = 'aavoyaw-full';
		}
		if ($numberOfEnabledFields == 2) {
			$class = 'aavoyaw-1/2 aavoyapr-2';
		}
		if ($numberOfEnabledFields == 3) {
			$class = 'aavoyaw-1/3 aavoyapr-2';
		}

		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="aavoyaflex aavoyaname aavoyamt-2">';

		foreach ($formInput['data']['Options'] as $k => $o) {
			if ($o['enabled'] == true) {
				$required = $o['required'] == true ? esc_attr('required') : '';
				$placeholder = $o['placeholder'] ? 'placeholder="' . __(sanitize_text_field($o['placeholder']), AWRAQ_TEXT_DOMAIN) . '"' : '';
				if ($oldValueAsParam != false) {
					$value = strlen($oldValueAsParam[$formInput['uniqueName']][$k]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][$k]['data'] : '';
				} else {
					$value = '';
				}
				$form .= '<div class="' . $class . '">';
				$form .= '<label for="' . esc_attr($id . preg_replace('/\s+/', '', $o['name']) . $key) . '" class="block">' . __(sanitize_text_field($o['label']), AWRAQ_TEXT_DOMAIN) . ($required != "" ? " (*)" : "") . '</label>';
				$form .= '<input type="text" id="' . esc_attr($id . preg_replace('/\s+/', '', $o['name']) . $key) . '" name="' . esc_attr($formInput['uniqueName'] . '_' . $k) . '" ' . $placeholder . ' ' . $required . ' class="block w-full" value="' . $value . '">';
				$form .= '</div>';
			}
		}


		$form .= '</div></div>';
		return $form;
	}
}
