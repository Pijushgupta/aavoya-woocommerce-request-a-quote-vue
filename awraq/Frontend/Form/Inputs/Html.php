<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Html {
	public static function create($formInput, $key, $id) {
		$form = '<div class="' . sanitize_html_class($formInput['data']['cssClass']) . '"><div class="content mt-2">';

		$form .= '<div>' . $formInput['data']['content'] . '</div>';
		$form .= '</div></div>';
		return $form;
	}
}
