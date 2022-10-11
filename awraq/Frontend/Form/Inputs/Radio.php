<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;
class Radio {

	public static function create($formInput, $key, $id, $oldValueAsParam): string {
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="aavoyaradio aavoyamt-2">';
		$required = $formInput['data']['label'] ? " (*)" : "";
		$form .= '<label >' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . $required . '</label>';
		if ($oldValueAsParam != false) {
			$value = strlen($oldValueAsParam[$formInput['uniqueName']][0]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][0]['data'] : '';
		}


		foreach ($formInput['data']['Options'] as $k => $v) {
			$checked = $value = $v['value'] ? 'checked' : '';
			$form .= '<input type="radio" id="' . esc_attr($id . $formInput['uniqueName'] . $k) . '" name="' . esc_attr($formInput['uniqueName']) . '" value="' . sanitize_text_field($v['value']) . '" ' . $checked . ' style="margin-right:10px;"/>' . '<label for="' . esc_attr($id . $formInput['uniqueName'] . $k) . '">' . __(sanitize_text_field($v['name']), AWRAQ_TEXT_DOMAIN) . '</label><br>';
		}
		$form .= '</div></div>';
		return $form;
	}
}
