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
		$response = wp_remote_get( $url );

		if(is_wp_error($response)){
			return false;
		}

		$body     = wp_remote_retrieve_body( $response );
		if(!is_wp_error($body)){
			$result = Officer::jsonToArray($body);
			/**
			 * it can true or false
			 */
			return $result['success'];
		}


	}
}