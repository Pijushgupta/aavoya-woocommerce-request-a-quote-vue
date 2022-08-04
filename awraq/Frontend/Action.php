<?php

namespace Awraq\Frontend;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;
use Awraq\Base\Meta;

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
		 * validating and sanitizing form id field 
		 */
		$formID = (int)Officer::sanitize($_POST['formPostId'], 'int');


		/* Terminating in case no form id or bad formID */
		if ($formID == 0 || get_post($formID) == null) return;
		/* ends */

		$formMeta = Meta::getForm($formID);

		var_dump($formMeta);
		die;
	}
}
