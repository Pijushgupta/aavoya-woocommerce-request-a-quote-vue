<?php
namespace Awraq\Frontend\Emails;
if(!defined('ABSPATH')) exit;

class Email {

	public static $formData;
	/**
	 * @param int $formID
	 * @param array $formData
	 *
	 * @return bool
	 */
	public static function init(int $formID,array $formData):bool{
		self::$formData = $formData;
		//self::sendAdminNotification($formID);
		self::sendUserNotification($formID);
		return true;
	}
	public static function transalate($setting_element){
		/**
		 * checking this pattern -  {anything}
		 */
		$intStatus = preg_match_all("/\{ .* \}/im",$setting_element,$output);
		/**
		 * if no pattern found return the data
		 */
		if($intStatus == 0) return $setting_element;

		/**
		 * if pattern found, trim {,}
		 */
		$output = trim($output[0][0],'{}');

		if($output == 'all'){

		}
	}
	public static function sendAdminNotification(int $formID,array $formData){
		$adminNotificationSettings = unserialize(get_post_meta($formID,'awraqFormAdminNotification',true));
		if($adminNotificationSettings['en'] === false) return false;

	}
	public static function sendUserNotification(int $formID) {
		/**
		 * getting user email notification setting from form meta
		 */
		$userNotificationSettins = unserialize( get_post_meta( $formID, 'awraqFormUserNotification', true ) );
		/**
		 * checking if it is enabled or not
		 */
		if ( $userNotificationSettins['en'] === false ) {
			return false;
		}

		/**
		 * unsetting, since its not required anymore
		 */
		unset( $userNotificationSettins['en'] );
		$newAarray = array();

		foreach ( $userNotificationSettins as $key => $setting ) {
			
				$setting_elements = explode( ',', $setting );
				$count = 0;
				foreach ( $setting_elements as $setting_element ) {
					if($count == 0){
						$newAarray[$key] = self::transalate($setting_element);
					}else{
						$newAarray[$key] = ',' . self::transalate($setting_element);
					}
					$count ++;
				}

		}
	}
}