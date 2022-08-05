<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

class Submit {
	public static function create() {
		$form = '<div class="submit mt-2">';
		$form .= '<input type="submit" name="submit" value="Submit"/>';
		$form .= '</div>';
		return $form;
	}
}
