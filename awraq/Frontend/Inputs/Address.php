<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Address
{
	public static function create($formInput, $key, $id)
	{
		/*
		 * Counting number of active/enabled fields
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
		 * end
		 */

		/**
		 *  Checking if total number of active fields is an Odd number or not
		 */
		$odd = false;
		if ($numberOfEnabledFields % 2 != 0) {
			$odd = true;
		}

		/**
		 * end
		 */

		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="flex flex-row flex-wrap address mt-2">';



		/**
		 * Counting number of array elements
		 */
		$numberOfFiled = count($options);

		/**
		 * Finally Looping the array and applying proper css class for decoration purpose
		 */
		for ($i = 0; $i < $numberOfFiled; $i++) {

			if ($odd == true && $i == 0) {
				$class = 'w-full';
			} else {
				$class = 'w-1/2 pr-2';
			}
			$required = $options[$i]['required'] == true ? 'required' : '';
			$placeholder = $options[$i]['placeholder'] ? 'placeholder="' . $options[$i]['placeholder'] . '"' : '';
			$form .= '<div class="' . $class . '">';
			$form .= '<label for="' . $id . preg_replace('/\s+/', '', $options[$i]['name']) . $key . '" class="block">' . $options[$i]['label'] . '</label>';
			$form .= '<input type="text" id="' . $id . preg_replace('/\s+/', '', $options[$i]['name']) . $key . '" name="' . $id . preg_replace('/\s+/', '', $options[$i]['name']) . $key . '" class="block w-full"' . $required . ' ' . $placeholder . '>';
			$form .= '</div>';
		}
		/**
		 * end of for loop
		 */

		$form .= '</div></div>';
		return $form;
	}
}
