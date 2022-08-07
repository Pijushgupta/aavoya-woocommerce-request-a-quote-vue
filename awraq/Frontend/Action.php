<?php

namespace Awraq\Frontend;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Awraq\Frontend\Form\Action\Map;

class Action {

	private static $globalScopeName = 'Awraq\Frontend\Action';

	public static function enable(): void {
		add_action('admin_post_awraqfSubmit', array(self::$globalScopeName, 'onSubmit'));
		add_action('admin_post_nopriv_awraqfSubmit', array(self::$globalScopeName, 'onSubmit'));
	}

	/**
	 * onSubmit
	 * This to trigger first after form submission
	 * @return void
	 */
	public static function onSubmit() {

		/**
		 *  Verifying Nonce for CSFR 
		 */
		if (wp_verify_nonce($_POST['awraqf_nonce'], 'awraqf_nonce') == false) return;

		/**
		 * checking if JWT got tampered or not
		 */
		$tokenId = self::decode_jwt(Officer::sanitize($_POST['jwt'], 'text'));
		if ($tokenId == false) return;

		/**
		 * validating and sanitizing form id field 
		 */
		$formID = (int)Officer::sanitize($_POST['formPostId'], 'int');

		/**
		 * checking token ID against form ID, it should same 
		 * if not terminate
		 */
		if ($tokenId != $formID) return;


		/* Terminating in case no form id or bad formID */
		if ($formID == 0 || get_post($formID) == null) return;


		$itemsToRemove = array('action', 'awraqf_nonce', 'formPostId', 'jwt', 'submit');
		foreach ($itemsToRemove as $itemToRemove) {
			unset($_POST[$itemToRemove]);
		}

		Map::check($formID, $_POST);



		die;
	}

	public static function decode_jwt($jwt) {
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
