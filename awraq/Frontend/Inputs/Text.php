<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Text
{
	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="text">';

		$form .= $formInput['data']['label'] ? '<label>' . $formInput['data']['label'] . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="text" name="' . $id . $formInput['name'] . $key . '"  placeholder="' . $formInput['data']['placeholder'] . '" ' . $required . '/><br>';
		$form .= '</div></div>';
		return $form;
	}
}
