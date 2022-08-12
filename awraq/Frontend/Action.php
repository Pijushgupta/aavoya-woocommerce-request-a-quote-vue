<?php

namespace Awraq\Frontend;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;
use Awraq\Frontend\Form\Action\Ip;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Awraq\Frontend\Form\Action\Map;
use Awraq\Frontend\Form\Action\Validation;
use Awraq\Frontend\Entry\Entry;


class Action {

	private static $globalScopeName = 'Awraq\Frontend\Action';

	public static function enable(): void {
		add_action('admin_post_awraqfSubmit', array(self::$globalScopeName, 'onSubmit'));
		add_action('admin_post_nopriv_awraqfSubmit', array(self::$globalScopeName, 'onSubmit'));
	}

	/**
	 * onSubmit
	 * This method to trigger first after form submission
	 * @return void
	 */
	public static function onSubmit() {
		if (!$_POST) return;


		/**
		 * Redirecting Page if origin URL is not set(removed)
		 */
		if (!$_POST['origin']) {
			wp_redirect('/');
			exit();
		}

		/**
		 * Sanitizing Origin Url , to be used in redirect(s)
		 */
		$originUrl = esc_url_raw($_POST['origin'], wp_allowed_protocols());

		/**
		 * checking if Ip blocked or not
		 */
		if (Ip::is_blocked((string)$_SERVER['REMOTE_ADDR']) == true) {
			wp_redirect($originUrl);
			exit();
		}

		/**
		 *  Verifying Nonce for CSFR 
		 */
		if (wp_verify_nonce($_POST['awraqf_nonce'], 'awraqf_nonce') == false) {
			wp_redirect($originUrl);
			exit();
		}

		/**
		 * checking if JWT got tampered or not
		 */
		$tokenId = self::decode_jwt(Officer::sanitize($_POST['jwt'], 'text'));
		if ($tokenId == false) {
			wp_redirect($originUrl);
			exit();
		};

		/**
		 * validating and sanitizing form id field 
		 */
		$formID = (int)Officer::sanitize($_POST['formPostId'], 'int');

		/**
		 * checking token ID against form ID, it should same 
		 * if not terminate
		 */
		if ($tokenId != $formID) {
			wp_redirect($originUrl);
			exit();
		};


		/* Terminating in case no form id or bad formID */
		if ($formID == 0 || get_post($formID) == null) {
			wp_redirect($originUrl);
			exit();
		};

		/**
		 * Removing supporting data from Post var
		 */
		$inputsToRemove = array('action', 'awraqf_nonce', 'formPostId', 'origin', 'jwt', 'submit');
		foreach ($inputsToRemove as $inputToRemove) {
			unset($_POST[$inputToRemove]);
		}

		/**
		 * Mapping the 'flat' array of post data to proper nested data
		 * And doing doing Sanitization
		 */
		$mappedPostData = Map::check($formID, $_POST);

		/**
		 * In case its Map::check returns false for violation
		 * redirecting to same origin Page 
		 */
		if ($mappedPostData === false) {
			wp_redirect($originUrl);
			exit();
		}

		/**
		 * checking if required filed are submitted or not, if not return to main form 
		 */
		$validatedPostData = Validation::do($formID, $mappedPostData);
		if ($validatedPostData === false) {
			wp_redirect($originUrl);
			exit();
		}



		/**
		 * checking if file(s) uploaded with the form 
		 * if uploaded sanitize and upload and add url and name to post array
		 */
		if (!empty($_FILES)) {
			$allowedPostSize =  (string)ini_get('upload_max_filesize');
			$sizeSuffix =  strtolower(substr($allowedPostSize, -1));
			if (in_array($sizeSuffix, array('g', 'm', 'k'))) {

				switch ($sizeSuffix) {
					case 'g':
						(int)$allowedPostSize *= 1024 * 1024 * 1024;
						break;
					case 'm':
						(int)$allowedPostSize *= 1024 * 1024;
						break;
					case 'k':
						(int)$allowedPostSize *= 1024;
						break;
				}
			}
			$fileArrayAfterUpload = Map::file($_FILES, $formID, $allowedPostSize);
			if ($fileArrayAfterUploa == false) {
				//if false PANIC and block the IP immediately, un-authorized payload 
			}
			$counter = 0;
			foreach ($fileArrayAfterUpload as $k => $f) {
				$mappedPostData[$k][$counter] = $f;
				$counter++;
			}
		}

		/**
		 * local filter
		 * to target data of form #10 with this filter : add_filter('raqba_form_before_saving_10','my_custom_funtion');
		 */
		$entryData = apply_filters('raqba_form_before_saving_{$formID}', $mappedPostData);

		/**
		 * global filter 
		 * to target data of forms with this filter : add_filter('raqba_form_before_saving','my_custom_funtion');
		 */
		$entryData = apply_filters('raqba_form_before_saving', $mappedPostData);

		/**
		 * If adding post data to database was not successful, then redirect user to origin page
		 */
		if (Entry::add($formID, $entryData) == false) {
			wp_redirect($originUrl);
			exit();
		}


		$emialData = apply_filters('raqba_form_before_email_{$formID}', $mappedPostData);
		$emialData = apply_filters('raqba_form_before_email', $mappedPostData);

		//Send email 

		//redirect if any redirect url provided







		var_dump($mappedPostData);












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
