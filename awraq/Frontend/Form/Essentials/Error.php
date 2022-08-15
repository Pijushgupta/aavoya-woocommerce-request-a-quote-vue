<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Meta;

class Error {
	public static function show($id = null) {
		//if ($id == null) return;

		if (empty($_SESSION['error'])) {
			echo 'Hello';
		}
		//$formMeta = Meta::getForm($id);
		var_dump($_SESSION['error']);
		return '';
	}
}
