<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Name
{
	public static function create($formInput, $key, $id)
	{


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

		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="flex name mt-2">';
		foreach ($formInput['data']['Options'] as $k => $o) {
			if ($o['enabled'] == true) {
				$required = $o['required'] == true ? 'required' : '';
				$placeholder = $o['placeholder'] ? 'placeholder="' . $o['placeholder'] . '"' : '';
				$form .= '<div class="' . $class . '">';
				$form .= '<label for="' . $id . preg_replace('/\s+/', '', $o['name']) . $key . '" class="block">' . $o['label'] . '</label>';
				$form .= '<input type="text" id="' . $id . preg_replace('/\s+/', '', $o['name']) . $key . '" name="' . $id . preg_replace('/\s+/', '', $o['name']) . $key . '" ' . $placeholder . ' ' . $required . ' class="block w-full">';
				$form .= '</div>';
			}
		}


		$form .= '</div></div>';
		return $form;
	}
}
