<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Textarea {
	public static function create($formInput, $key, $id, $oldValueAsParam) {
		if(array_key_exists('cssClass',$formInput['data'])){
			$css = sanitize_html_class($formInput['data']['cssClass']);
		}else{
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="textarea mt-2">';

		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['name'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		if($oldValueAsParam != false){
			$value = strlen($oldValueAsParam[$formInput['uniqueName']][0]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][0]['data'] : '';
		}else{
			$value = '';
		}

		$form .= '<textarea id="' . esc_attr($id . $formInput['name'] . $key) . '"  type="text" name="' . esc_attr($formInput['uniqueName']) . '"  placeholder="' . __(sanitize_text_field($formInput['data']['placeholder']), AWRAQ_TEXT_DOMAIN) . '" ' . $required . '/>' . $value . '</textarea>';
		$form .= '</div></div>';
		return $form;
	}
}
