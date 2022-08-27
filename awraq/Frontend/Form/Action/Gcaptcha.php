<?php

namespace Awraq\Frontend\Form\Action;
if(!defined('ABSPATH')) exit;

use Awraq\Base\Officer;


class Gcaptcha {
	public static function verify($token = null){
		/**
		 * Checking token
		 */
		if($token == null) return false;
		$token = sanitize_text_field($token);

		/**
		 * getting captcha Secret key
		 */
		$captchaKeys = get_option('awraq_getGoogleCaptchaKeys',null);
		if($captchaKeys == null) return false;
		$captchaKeys = unserialize($captchaKeys);
		if(!array_key_exists('secretKey',$captchaKeys)) return false;
		$captchaSecret = sanitize_text_field($captchaKeys['secretKey']);
		unset($captchaKeys);

		/**
		 * Making cURL request
		 */
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $captchaSecret . '&response=' . $token;
		$ch = curl_init();

		//TODO: remove it on Production
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . '/../../../Base/cacert-2022-07-19.pem');
		curl_setopt($ch, CURLOPT_CAPATH, __DIR__ . '/../../../Base/cacert-2022-07-19.pem');
		//
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if($error){
			return false;
		}

		if($result){
			$result = Officer::jsonToArray($result);
			/**
			 * it can true or false
			 */
			return $result['success'];
		}


	}
}