<?php
//This to decode JWT token

namespace Awraq\Frontend\Form\Action;
if(!defined('ABSPATH')) exit;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token {
	/**
	 * decode
	 * This to Decode the JWT token and extract the Form ID.
	 * In case of Modified payload. It will hit exception and return false
	 * @param string $jwt
	 * @return bool|int
	 */
	public static function decode($jwt){
		if ($jwt == '') return false;

		if (get_option('aavoya_wraq_random_key', null) == null) return false;
		$key = get_option('aavoya_wraq_random_key');


		try {
			$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
		} catch (\Exception $e) {
			return false;
		}
		return (int)$decoded->data->ID;
	}
}