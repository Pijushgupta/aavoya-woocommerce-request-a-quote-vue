<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

class Id {
	public static function create($id) {
		return '<input type="hidden" name="formPostId" value="' . $id . '">';
	}
}
