<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

class Origin {
	public static function create() {
		return '<input type="hidden" name="origin" value="' . get_permalink() . '" />';
	}
}
