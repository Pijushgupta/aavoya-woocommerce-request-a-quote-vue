<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

use Firebase\JWT\JWT;


class Token {

	public static function create($id = null): string {
		if ($id == null) return '';

		$jwtToken = self::encode($id);
		if ($jwtToken == '') return '';

		return '<input type="hidden" name="jwt" value="' . $jwtToken . '">';
	}

	/**
	 * creating JWT
	 * @param int $id
	 * @return string
	 */
	public static function encode($id): string {
		$payload = array(
			'iss' => get_bloginfo('url'), //issuer
			'aud' => get_bloginfo('url'), //for audience
			'iat' => time(), //creating time
			'exp' => time() + (60 * 60 * 24 * 1), //24hrs
			'data' => array('ID' => $id)
		);

		if (get_option('aavoya_wraq_random_key', null) == null) return '';
		$key = get_option('aavoya_wraq_random_key');

		$jwt = JWT::encode($payload, $key, 'HS256');
		return $jwt;
	}
}
