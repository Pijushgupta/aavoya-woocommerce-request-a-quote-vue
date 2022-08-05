<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

class Csrfp {
	public static function create() {
		return '<input type="hidden" name="awraqf_nonce" value="' .	wp_create_nonce('awraqf_nonce') . '"/>';
	}
}
