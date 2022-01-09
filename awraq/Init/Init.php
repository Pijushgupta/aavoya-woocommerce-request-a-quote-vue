<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;

use Awraq\Init\Cpt;
use Awraq\Init\Initdata;
use Awraq\Init\Dependencies;

class Init
{
	public static function activate()
	{

		if (Dependencies::check() == TRUE) {

			Cpt::createPostType();

			Initdata::addInitData();

			flush_rewrite_rules();

			return TRUE;
		} else {

			return FALSE;
		}
	}
}
