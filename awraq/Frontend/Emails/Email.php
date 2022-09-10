<?php
namespace Awraq\Frontend\Emails;
if(!defined('ABSPATH')) exit;

class Email {
	/**
	 * @param int $formID
	 * @param array $formData
	 *
	 * @return bool
	 */
	public static function init(int $formID,array $formData):bool{
		self::sendAdminNotification($formID,$formData);
		self::sendUserNotification($formID,$formData);
		return true;
	}
	public static function transalate(){

	}
	public static function sendAdminNotification(int $formID,array $formData){
		$adminNotificationSettings = unserialize(get_post_meta($formID,'awraqFormAdminNotification',true));
		if($adminNotificationSettings['en'] === false) return false;

	}
	public static function sendUserNotification(int $formID,array $formData){
		/**
		 * getting user email notification setting from form meta
		 */
		$userNotificationSettins = unserialize(get_post_meta($formID,'awraqFormUserNotification',true));
		/**
		 * checking if it is enabled or not
		 */
		if($userNotificationSettins['en'] === false) return false;

		/**
		 * unsetting, since its not required anymore
		 */
		unset($userNotificationSettins['en']);

		foreach($userNotificationSettins as $setting){
			if($setting['sent_to_email']){
				$sent_tos = explode(',',$setting['sent_to_email']);
				foreach($sent_tos as $sent_to){
					
				}
			}
			if($setting['from_name']){}
			if($setting['from_email']){}
			if($setting['replay_To']){}
			if($setting['subject']){}
			if($setting['message']){}
		}


	}
}