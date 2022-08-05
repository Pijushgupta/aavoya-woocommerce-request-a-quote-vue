<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Address {
	public static function create($formInput, $key, $id) {
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

		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="flex flex-row flex-wrap address mt-2">';

		/**
		 * Counting number of array elements
		 */
		$numberOfFiled = count($options);

		/**
		 * Finally Looping the array and applying proper css class for decoration purpose
		 */
		for ($i = 0; $i < $numberOfFiled; $i++) {

			if ($odd == true && $i == 0) { // making the first field full width in case total number of fields is and odd number
				$class = 'w-full';
			} else {
				$class = 'w-1/2 pr-2';
			}
			$required = $options[$i]['required'] == true ? 'required' : '';
			$placeholder = $options[$i]['placeholder'] ? 'placeholder="' . $options[$i]['placeholder'] . '"' : '';
			$form .= '<div class="' . $class . '">';
			$form .= '<label for="' . esc_attr($id . preg_replace('/\s+/', '', $options[$i]['name']) . $key) . '" class="block">' . __(sanitize_text_field($options[$i]['label']), AWRAQ_TEXT_DOMAIN) . '</label>';
			$form .= '<input type="text" id="' . esc_attr($id . preg_replace('/\s+/', '', $options[$i]['name']) . $key) . '" name="' . esc_attr($id . preg_replace('/\s+/', '', $options[$i]['name']) . $key) . '" class="block w-full"' . esc_attr($required) . ' ' . __(sanitize_text_field($placeholder), AWRAQ_TEXT_DOMAIN) . '>';
			$form .= '</div>';
		}


		$form .= '</div></div>';
		return $form;
	}
}
