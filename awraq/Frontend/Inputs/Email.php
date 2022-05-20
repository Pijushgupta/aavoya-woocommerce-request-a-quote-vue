<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Email
{
	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="email">';

		$form .= $formInput['data']['label'] ? '<label for="' . $id . $formInput['name'] . $key . '">' . $formInput['data']['label'] . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="email" id="' . $id . $formInput['name'] . $key . '" name="' . $id . $formInput['name'] . $key . '"  placeholder="' . $formInput['data']['placeholder'] . '" ' . $required . '/><br>';
		$form .= '</div></div>';
		return $form;
	}
}
