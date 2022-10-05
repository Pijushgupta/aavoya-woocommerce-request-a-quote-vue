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
		$ch = curl_init();

		//TO be removed
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//		curl_setopt($ch, CURLOPT_VERBOSE, true);
//		curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . '/cacert-2022-07-19.pem');
//		curl_setopt($ch, CURLOPT_CAPATH, __DIR__ . '/cacert-2022-07-19.pem');
		//To be removed

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		echo json_encode($result);
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
