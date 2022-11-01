<?php

namespace Awraq\Base;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;



class Gcaptcha {
	public static $globalScopeName = 'Awraq\Base\Gcaptcha';

	/**
	 * enabling ajax call
	 * @return void
	 */
	public static function enable() {
		add_action('wp_ajax_awraqCheckCaptcha', array(self::$globalScopeName, 'awraqCheckCaptcha'));
		add_action('wp_ajax_awraqGetCaptchaKeys', array(self::$globalScopeName, 'awraqGetCaptchaKeys'));
		add_action('wp_ajax_awraqSetCaptchaKeys', array(self::$globalScopeName, 'awraqSetCaptchaKeys'));
	}

	/**
	 * checking if google keys are valid or not
	 * @return void
	 */
	public static function awraqCheckCaptcha() {
		if (!Officer::check($_POST)) wp_die();

		$secret = Officer::sanitize($_POST['secret'], 'text');
		$token = Officer::sanitize($_POST['token'], 'text');
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $token;
		$response = wp_remote_get( $url );
		$body     = wp_remote_retrieve_body( $response );
		echo json_encode($body);
		wp_die();
	}

	/**
	 * Provides google captcha keys(secret key and site key)
	 * @return void
	 */
	public static function awraqGetCaptchaKeys() {
		if (!Officer::check($_POST)) wp_die();
		$googleCaptchKeys = get_option('awraq_getGoogleCaptchaKeys', null);
		if ($googleCaptchKeys === null) {
			echo json_encode(false);
		} else {
			echo json_encode(unserialize($googleCaptchKeys));
		}
		wp_die();
	}

	/**
	 * Saving Google Keys to database
	 * @return void
	 */
	public static function awraqSetCaptchaKeys() {
		if(!Officer::check($_POST)) wp_die();
		if(!$_POST['secretKey'] || !$_POST['siteKey']) wp_die();

		$secretKey = Officer::sanitize($_POST['secretKey'],'text');
		$siteKey = Officer::sanitize($_POST['siteKey'],'text');


		$key = serialize(array(
			'secretKey' => $secretKey,
			'siteKey' => $siteKey
		));
		echo json_encode(update_option('awraq_getGoogleCaptchaKeys', $key));
		wp_die();
	}
}
