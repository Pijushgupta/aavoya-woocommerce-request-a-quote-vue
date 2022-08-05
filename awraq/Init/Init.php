<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;

use Awraq\Init\Cpt;
use Awraq\Init\Initdata;
use Awraq\Init\Random;


class Init {
	public static function activate() {

		Cpt::create();
		Initdata::addInitData();
		Random::add();
		return TRUE;
	}
}
