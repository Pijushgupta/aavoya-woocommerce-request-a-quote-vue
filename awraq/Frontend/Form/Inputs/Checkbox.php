<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Checkbox {

	public static function create($formInput, $key, $id, $oldValueAsParam) {
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css =  sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}
		$required = $formInput['data']['required'] == true ?  ' (*)' : '';
		$form = '<div class="' . $css . '"><div class="aavoyacheckbox aavoyamt-2">';
		$form .= '<label style="display:block;">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) .  $required . '</label>';
		foreach ($formInput['data']['Options'] as $k => $v) {
			if ($oldValueAsParam != false) {
				$value = strlen($oldValueAsParam[$formInput['uniqueName']][$k]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][$k]['data'] : '';
			} else {
				$value = '';
			}
			$checked = $value == $v['value'] ? 'checked' : '';
			$form .= '<div class="' . sanitize_html_class($id . $formInput['name'] . $k) . '"><input type="checkbox" id="' . esc_attr($id . $formInput['uniqueName'] . $k) . '" name="' . esc_attr($formInput['uniqueName'] . '_' . $k) . '" value="' . sanitize_text_field($v['value']) . '" ' . $checked . ' style="margin-right:10px;"/>' . '<label for="' . esc_attr($id . $formInput['uniqueName'] . $k) . '">' . __(sanitize_text_field($v['name']), AWRAQ_TEXT_DOMAIN) . '</label></div>';
		}
		$form .= '</div></div>';
		return $form;
	}
}
