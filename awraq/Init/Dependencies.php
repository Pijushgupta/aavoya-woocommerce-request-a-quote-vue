<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;



final class dependencies
{

	public static function check()
	{
		require_once(ABSPATH . '/wp-admin/includes/plugin.php');


		//check if contact form 7 is active or not
		

		return true;
	}
}
