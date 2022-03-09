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
		$url = admin_url('admin-ajax.php');
		$awraq = wp_create_nonce('awraq_nonce');
		printf('<script> var awraq_ajax_path = "%1$s"; var awraq_nonce = "%2$s";</script><div id="%3$s"></div>',$url,$awraq, AWRAQ_VUE_ROOT_ID);
	}
}
