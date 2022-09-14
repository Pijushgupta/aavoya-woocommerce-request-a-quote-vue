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
		$intStatus = preg_match_all("/\{.*\}/i",$setting_element,$output);
		/**
		 * if no pattern found return the data
		 */
		if($intStatus === 0) {
			return $setting_element;
		}

		/**
		 * if pattern found, trim {,}
		 */
		$output = trim($output[0][0],'{}');

		if($output === 'wordpress_admin'){
			$admins = get_users(array(
				'role__in' => array('administrator')
			));
			$admins = array_map(function ($user) {
				return array(
					'id' => intval($user->ID),
					'email' => sanitize_text_field($user->user_email),
				);
			}, $admins);

			return $admins[0]['email'];
		}

		if($output === 'wordpress_admin_name'){
			$admins = get_users(array(
				'role__in' => array('administrator')
			));
			$admins = array_map(function ($user) {
				return array(
					'id' => intval($user->ID),
					'name' => sanitize_text_field($user->display_name),
				);
			}, $admins);

			return $admins[0]['name'];
		}

		if($output === 'noreplay@domain.com'){
			return 'noreply@'.$_SERVER['SERVER_NAME'];
		}

		$output = explode('_',$output);
		foreach($output as $element){
			if(array_key_exists($element,self::$formData)){

				if(array_key_exists(1, $output)){
					return self::$formData[$output[0]][$output[1]]['data'];
				}else{
					return self::$formData[$output[0]][0]['data'];
				}
			}
		}



	}
	public static function transalateMessage($message){
		foreach(self::$formData as $key => $inputArray){
			if(count($inputArray) > 1) {
				foreach ( $inputArray as $k => $value ) {
					if(str_contains($message,'{'.$key.'_'.$k.'}')){

						$message = str_replace('{'.$key.'_'.$k.'}',$inputArray[$k]['data'],$message);
					}
				}
			}else{
				if(str_contains($message, '{'.$key.'}')){
					$message = str_replace('{'.$key.'}',$inputArray[0]['data'],$message);
				}
			}

		}


		/**
		 * special case for {all}
		 */
		if(str_contains($message,'{all}')){
			$values = '';
			foreach(self::$formData as $j => $d){

					foreach($d as $e => $f){
						$values .= $d[$e]['data'] . ' ';
					}


			}
			$message = str_replace('{all}',$values,$message);
		}
		return $message;
	}
	public static function sendMail($data){
		$validatedEmailsString = '';
		$formName = '';
		$validatedFormEmail = '';
		$validatedReplyTo = '';
		$validatedBcc = '';
		$subject = '';
		$body = '';
		if(array_key_exists('sent_to_email',$data)){
			/**
			 * Validating Emails
			 */
			$sentToEmails = $data['sent_to_email'];
			$sentToEmails = explode(',',$sentToEmails);
			$count = 0;
			foreach($sentToEmails as $email){
				if(filter_var($email, FILTER_VALIDATE_EMAIL) != false){
					if($count == 0){
						$validatedEmailsString = $email;
					}else{
						$validatedEmailsString .= ','.$email;
					}
					$count ++;
				}
			}
			/**
			 * end of email validation
			 */
		}
		if(array_key_exists('from_name',$data)){
			$formName = $data['form_name'];
		}
		if(array_key_exists('from_email',$data)){
			$formEmails = $data['form_email'];
			$formEmails = explode(',',$formEmails);
			$count = 0;
			foreach($formEmails as $formEmail){
				if(filter_var($formEmail,FILTER_VALIDATE_EMAIL) != false){
					if($count == 0){
						$validatedFormEmail = $formEmail;
					}else{
						$validatedFormEmail .= ','.$formEmail;
					}
					$count++;
				}
			}
		}
		if(array_key_exists('replay_To',$data)){
			$replyTo = $data['replay_To'];
			if(filter_var($replyTo, FILTER_VALIDATE_EMAIL) != false){
				$validatedReplyTo = $replyTo;
			}
		}
		if(array_key_exists('bcc',$data)){
			$bccs = $data['bcc'];
			$bccs = explode(',',$bccs);
			$count = 0;
			foreach($bccs as $bcc){
				if(filter_var($bcc, FILTER_VALIDATE_EMAIL) != false){
					if($count == 0){
						$validatedBcc = $bcc;
					}else{
						$validatedBcc .= ','.$bcc;
					}
					$count++;
				}
			}


		}
		if(array_key_exists('subject',$data)){
			$subject = $data['subject'];
		}
		if(array_key_exists('message',$data)){
			$body = $data['message'];
		}

		var_dump($body);


	}
	public static function sendAdminNotification(int $formID){
		/**
		 * Getting Admin email notification setting from form meta
		 */
		$adminNotificationSettings = unserialize(get_post_meta($formID,'awraqFormAdminNotification',true));
		/**
		 * Checking if it is enabled or not
		 */
		if($adminNotificationSettings['en'] === false) return false;
		/**
		 * unsetting, since it's not required anymore
		 */
		unset($adminNotificationSettings['en']);
		$newArray = array();

		foreach ( $adminNotificationSettings as $key => $setting ) {
			if($key !== 'message'){
				$setting_elements = explode( ',', $setting );
				$count = 0;

				foreach ( $setting_elements as $setting_element ) {
					if($count == 0){
						$newAarray[$key] = self::transalate($setting_element);
					}else{
						$newAarray[$key] .= ',' . self::transalate($setting_element);
					}
					$count ++;
				}
			}
			if($key == 'message'){
				$newAarray[$key] = self::transalateMessage($setting);
			}


		}


	}
	public static function sendUserNotification(int $formID) {
		/**
		 * getting user email notification setting from form meta
		 */
		$userNotificationSettins = unserialize( get_post_meta( $formID, 'awraqFormUserNotification', true ) );
		/**
		 * checking if it is enabled or not
		 */
		if ( $userNotificationSettins['en'] === false ) return false;


		/**
		 * unsetting, since it's not required anymore
		 */
		unset( $userNotificationSettins['en'] );
		$newAarray = array();

		foreach ( $userNotificationSettins as $key => $setting ) {
				if($key !== 'message'){
					$setting_elements = explode( ',', $setting );
					$count = 0;

					foreach ( $setting_elements as $setting_element ) {
						if($count == 0){
							$newAarray[$key] = self::transalate($setting_element);
						}else{
							$newAarray[$key] .= ',' . self::transalate($setting_element);
						}
						$count ++;
					}
				}
				if($key == 'message'){
					$newAarray[$key] = self::transalateMessage($setting);
				}

		}
		self::sendMail($newAarray);

	}
}