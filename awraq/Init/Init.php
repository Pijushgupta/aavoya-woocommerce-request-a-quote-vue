<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;

use Awraq\Init\Cpt;
use Awraq\Init\Initdata;


class Init
{
	public static function activate()
	{

			Cpt::create();
			Initdata::addInitData();
			return TRUE;
		
	}
}
