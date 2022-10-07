<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Html {
	public static function create($formInput, $key, $id) {
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="aavoyacontent aavoyamt-2">';

		$form .= '<div>' . $formInput['data']['content'] . '</div>';
		$form .= '</div></div>';
		return $form;
	}
}
