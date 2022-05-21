<?php

namespace Awraq\Frontend\Inputs;

class Radio
{

	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="radio mt-2">';
		$form .= '<label>' . $formInput['data']['label'] . '</label>';
		foreach ($formInput['data']['Options'] as $k => $v) {
			$form .= '<input type="radio" id="' . $id . $formInput['name'] . $k . '" name="' . $id . $formInput['name'] . $key . '" value="' . $v['value'] . '" style="margin-right:10px;"/>' . '<label for="' . $id . $formInput['name'] . $k . '">' . $v['name'] . '</label><br>';
		}
		$form .= '</div></div>';
		return $form;
	}
}
