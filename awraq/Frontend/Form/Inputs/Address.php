<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Address {
	public static function create($formInput, $key, $id, $oldValueAsParam) {
		/*
		 * Counting number of active/enabled fields: $numberOfEnabledFields
		 * storing enabled fields : $options
		 * This is needed to create proper html grid.
		 */
		$numberOfEnabledFields = 0;
		$options = array();
		foreach ($formInput['data']['Options'] as $o) {
			if ($o['enabled'] == true) {
				$numberOfEnabledFields++;
				array_push($options, $o);
			}
		}
		unset($o);


		/**
		 *  Checking if total number of active fields is an Odd number or not
		 */
		$odd = false;
		if ($numberOfEnabledFields % 2 != 0) {
			$odd = true;
		}

		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="aavoyaflex aavoyaflex-row aavoyaflex-wrap aavoyaaddress aavoyamt-2">';

		/**
		 * Counting number of array elements
		 */
		$numberOfFiled = count($options);

		/**
		 * Finally Looping the array and applying proper css class for decoration purpose
		 */
		$c = 0; //this to use  as counter 
		for ($i = 0; $i < count($formInput['data']['Options']); $i++) {

			if ($formInput['data']['Options'][$i]['enabled'] == true) {

				if ($odd == true && $c == 0) { // making the first field full width in case total number of fields is and odd number
					$class = 'w-full';
				} else {
					$class = 'w-1/2 pr-2';
				}
				$required = $formInput['data']['Options'][$i]['required'] ? 'required' : '';
				$placeholder = $formInput['data']['Options'][$i]['placeholder'] ? 'placeholder="' . $formInput['data']['Options'][$i]['placeholder'] . '"' : '';

				if ($oldValueAsParam != false) {
					$value = strlen($oldValueAsParam[$formInput['uniqueName']][$i]['data']) > 0 ? $oldValueAsParam[$formInput['uniqueName']][$i]['data'] : '';
				} else {
					$value = '';
				}
				$form .= '<div class="' . $class . '">';
				$form .= '<label for="' . esc_attr($id . preg_replace('/\s+/', '', $formInput['data']['Options'][$i]['name']) . $key) . '" class="aavoyablock">' . __(sanitize_text_field($formInput['data']['Options'][$i]['label']), AWRAQ_TEXT_DOMAIN) . ($required != "" ? " (*)" : "") . '</label>';
				$form .= '<input type="text" id="' . esc_attr($id . preg_replace('/\s+/', '', $formInput['data']['Options'][$i]['name']) . $key) . '" name="' . esc_attr($formInput['uniqueName'] . '_' . $i) . '" class="aavoyablock aavoyaw-full"' . esc_attr($required) . ' ' . __(sanitize_text_field($placeholder), AWRAQ_TEXT_DOMAIN) . ' value="' . $value . '">';
				$form .= '</div>';
				$c++;
			}
		}


		$form .= '</div></div>';
		return $form;
	}
}
