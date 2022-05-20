<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Checkbox
{

	public static function create($formInput, $key, $id)
	{

		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="checkbox">';
		$form .= '<label style="display:block;">' . $formInput['data']['label'] . '</label>';
		foreach ($formInput['data']['Options'] as $k => $v) {
			$form .= '<input type="checkbox" id="' . $id . $formInput['name'] . $k . '" name="' . $id . $formInput['name'] . $k . '" value="' . $v['value'] . '" style="margin-right:10px;"/>' . '<label for="' . $id . $formInput['name'] . $k . '">' . $v['name'] . '</label><br>';
		}
		$form .= '</div></div>';
		return $form;
	}
}
