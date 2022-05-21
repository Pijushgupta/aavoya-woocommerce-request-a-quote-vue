<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class Html
{
	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="content mt-2">';

		$form .= '<div>' . $formInput['data']['content'] . '</div>';
		$form .= '</div></div>';
		return $form;
	}
}
