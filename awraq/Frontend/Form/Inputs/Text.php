<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Text {
	public static function create($formInput, $key, $id, $oldValueAsParam) {
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}

		$form = '<div class="' . $css . '"><div class="aavoyatext aavoyamt-2">';
		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['uniqueName'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . ($required != "" ? " (*)" : "") . '</label>' : '';

		if ($oldValueAsParam != false) {
			$value = strlen($oldValueAsParam[$formInput['uniqueName']][0]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][0]['data'] : '';
		} else {
			$value = '';
		}

		$form .= '<input id="' . esc_attr($id . $formInput['uniqueName'] . $key) . '" type="text" name="' . esc_attr($formInput['uniqueName']) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . ' class="aavoyaw-full" value="' . $value . '"/>';
		$form .= '</div></div>';

		return $form;
	}
}
