<?php

namespace Awraq\Base;

if (!defined('ABSPATH')) exit;

class Notice
{
	private static $globalScopeName = 'Awraq\Base\Notice';
	private static $class = '';
	private static $msg = '';

	public static function error($msg = 'error', $is_dismissible = TRUE)
	{
		self::$class = ($is_dismissible == TRUE) ? 'notice notice-error is-dismissible' : 'notice notice-error';
		self::$msg = __($msg, AWRAQ_TEXT_DOMAIN);
		add_action('admin_notices', array(self::$globalScopeName, 'awraq_notice'));
	}

	public static function warning($msg = 'warning', $is_dismissible = TRUE)
	{
		self::$class = ($is_dismissible == TRUE) ? 'notice notice-warning is-dismissible' : 'notice notice-warning';
		self::$msg = __($msg, AWRAQ_TEXT_DOMAIN);
		add_action('admin_notices', array(self::$globalScopeName, 'awraq_notice'));
	}

	public static function success($msg = 'success', $is_dismissible = TRUE)
	{
		self::$class = ($is_dismissible == TRUE) ? 'notice notice-success is-dismissible' : 'notice notice-success';
		self::$msg = __($msg, AWRAQ_TEXT_DOMAIN);
		add_action('admin_notices', array(self::$globalScopeName, 'awraq_notice'));
	}

	public static function info($msg = 'info', $is_dismissible = TRUE)
	{
		self::$class = ($is_dismissible == TRUE) ? 'notice notice-info is-dismissible' : 'notice notice-info';
		self::$msg = __($msg, AWRAQ_TEXT_DOMAIN);
		add_action('admin_notices', array(self::$globalScopeName, 'awraq_notice'));
	}

	public static function  awraq_notice()
	{

		$class	= self::$class;
		$msg	= self::$msg;

		if ($class == '' and $msg == '') {
			return;
		}

		printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($msg));
	}
}
