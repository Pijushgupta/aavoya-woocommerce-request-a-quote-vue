<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Text
{
	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="text mt-2">';

		$form .= $formInput['data']['label'] ? '<label>' . $formInput['data']['label'] . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="text" name="' . $id . $formInput['name'] . $key . '"  placeholder="' . $formInput['data']['placeholder'] . '" ' . $required . ' class="w-full"/>';
		$form .= '</div></div>';
		return $form;
	}
}
