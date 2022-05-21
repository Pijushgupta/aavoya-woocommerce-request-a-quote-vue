<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Textarea
{
	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="textarea mt-2">';

		$form .= $formInput['data']['label'] ? '<label>' . $formInput['data']['label'] . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<textarea  type="text" name="' . $id . $formInput['name'] . $key . '"  placeholder="' . $formInput['data']['placeholder'] . '" ' . $required . '/></textarea><br>';
		$form .= '</div></div>';
		return $form;
	}
}
