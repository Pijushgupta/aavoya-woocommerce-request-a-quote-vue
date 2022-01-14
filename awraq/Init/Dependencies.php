<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;



final class dependencies
{

	public static function check()
	{
		require_once(ABSPATH . '/wp-admin/includes/plugin.php');

		//check if woocommerce is active or not
		if (!is_plugin_active('woocommerce/woocommerce.php')) {

			return false;
		}

		//check if contact form 7 is active or not
		if (!is_plugin_active('contact-form-7/wp-contact-form-7.php')) {

			return false;
		}

		return true;
	}
}
