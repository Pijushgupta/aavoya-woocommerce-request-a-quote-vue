<?php

namespace Awraq\Base;

if (!defined('ABSPATH')) exit;

final class Enqueue
{

	private static $globalScopeName = 'Awraq\Base\Enqueue';

	public static function do()
	{
		add_action('admin_enqueue_scripts', array(self::$globalScopeName, 'add'));
	}

	public static function add($hook)
	{
		if ($hook != 'toplevel_page_' . AWRAQ_SPA_SLUG) return;

		if (file_exists(AWRAQ_ABS . 'assets/dist/main.js')) {
			wp_enqueue_script('awraq-vue-script', AWRAQ_REL . '/assets/dist/main.js', array(), '1.0.0', true);
		}

		if (file_exists(AWRAQ_ABS . 'assets/dist/main.css')) {
			wp_enqueue_style('awraq-tailwind-style', AWRAQ_REL . '/assets/dist/main.css', array(), '1.0.0');
		}
	}
}
