<?php

namespace Awraq\Page;

if (!defined('ABSPATH')) exit;

final class Ui
{
	private static $globalScopeName = 'Awraq\Page\Ui';

	public static function activate()
	{
		if (current_user_can('manage_options')) {
			add_action('admin_menu', array(self::$globalScopeName, 'create'));
		}
	}


	public static function create()
	{

		add_menu_page(
			__(AWRAQ_ADMIN_MENU_TITLE, AWRAQ_TEXT_DOMAIN),
			__(AWRAQ_ADMIN_MENU_NAME, AWRAQ_TEXT_DOMAIN),
			'manage_options',
			AWRAQ_SPA_SLUG,
			array(self::$globalScopeName, 'render'),
			'dashicons-clipboard',
			20
		);
	}

	public static function render()
	{
		printf('<div id="%1$s"></div>', AWRAQ_VUE_ROOT_ID);
	}
}
