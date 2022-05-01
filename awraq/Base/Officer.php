<?php 
namespace Awraq\Base;
if(!defined('ABSPATH')) exit;
class Officer{
		
	/**
	 * check
	 * Nonce Checker for AJAX Requests
	 * @param  mixed $postdata
	 * @return boolean
	 */
	public static function check($postdata = false){
		
		if($postdata == false) return false;

		if($postdata['awraq_nonce']){

			if(wp_verify_nonce($postdata['awraq_nonce'], 'awraq_nonce')){
				return true;
			}
		}
		return false;
	}
	


	/**
	 * jsonToArray
	 * Convert JSON to Array
	 * @param  mixed $json
	 * @return void
	 */
	public static function jsonToArray($json = null ){
		if($json == null) return false;

		$array = (array)json_decode( str_replace('\\','',$json) , true);
		return $array;
	}


	
	/**
	 * sanitize
	 * Sanitize the data
	 * @param  mixed $element
	 * @param  string $type
	 * @return mixed
	 */
	public static function sanitize($element = null ,$type = null){
		if($element == null OR $type == null) return false;

		switch ($type){

			case 'text':
				return sanitize_text_field($element);

			case 'int':
				return intval($element) ;
				
			case 'float':
				return floatval($element);
				
			case 'bool':
				return rest_sanitize_boolean( $element);
				
			case 'class':
				return sanitize_html_class($element);
				
			case 'email':
				return sanitize_email($element);
				
			case 'color':
				return sanitize_hex_color($element);	
				
			default:
				return null;	
				
		}	

	}

	
	/**
	 * formInputSanitize
	 * @param  mixed $element
	 * @return mixed
	 */
	public static function formInputSanitize($element){
		if( gettype($element) === 'array'){
			foreach ($element as  &$value) {
				/* Common Properties */
				$value['name']			= self::sanitize($value['name'],'text') == false ? '' : self::sanitize($value['name'],'text');
				$value['type']			= self::sanitize($value['type'],'text') == false ? '' : self::sanitize($value['type'],'text');
				$value['dataType']	= self::sanitize($value['dataType'],'text') == false ? '' : self::sanitize($value['dataType'],'text');
				$value['tabState']	= (int)self::sanitize($value['tabState'],'int');

				$value['data']['label']					= self::sanitize($value['data']['label'],'text') == false ? '' : self::sanitize($value['data']['label'],'text');
				$value['data']['required']			= self::sanitize($value['data']['required'],'bool');
				$value['data']['cssClass']			= self::sanitize($value['data']['cssClass'],'class') == false ? '' : self::sanitize($value['data']['cssClass'],'class');
				/* Common Properties ends */

				switch($value['type']){
					case 'text':
					case 'textarea':
					case 'email':
						self::textDataSanitize($value);
						break;
					case 'checkbox':
					case 'radio':
						self::checkboxRadioDataSanitize($value);
						break;
					case 'file':
						self::fileDataSanitize($value);
						break;
					case 'date':
						self::dateDataSanitize($value);		
						break;
					default:
						break;
				}

			} //Main loop ends
			unset($value);

			return $element;
		} // main if ends

	}
	
	/**
	 * textDataSanitize
	 *
	 * @param  mixed $input
	 * @return void
	 */
	public static function textDataSanitize(&$input){
		$input['data']['placeholder']		= self::sanitize($input['data']['placeholder'],'text')  == false ? '': self::sanitize($input['data']['placeholder'],'text');
	}	
	/**
	 * checkboxRadioDataSanitize
	 *
	 * @param  mixed $input
	 * @return void
	 */
	public static function checkboxRadioDataSanitize(&$input){
		foreach($input['data']['Options'] as &$option){
			$option['id']			= (int)self::sanitize($option['id'],'int');
			$option['name']		= self::sanitize($option['name'],'text') == false ? '': self::sanitize($option['name'],'text');
			$option['value']	= self::sanitize($option['value'],'text') == false ? '' : self::sanitize($option['value'],'text');
		}
		unset($option);
	}	
	/**
	 * fileDataSanitize
	 *
	 * @param  mixed $input
	 * @return void
	 */
	public static function fileDataSanitize(&$input){
		/* Maximum File Size */
		$input['data']['maxFileSize'] = (int)self::sanitize($input['data']['maxFileSize'],'int');

		/* Selected file Type */
		foreach($input['data']['selectedFileType'] as &$ft){
			$ft	= self::sanitize($ft,'text') == false ? '' : self::sanitize($ft,'text');
		}
		unset($ft);

		/* Supported file Types */
		foreach($input['data']['supportedFileTypes'] as &$supportedFileType){
				$supportedFileType['key']				= (int)self::sanitize($supportedFileType['key'],'int');
				$supportedFileType['name']			= self::sanitize($supportedFileType['name'],'text') == false ? '' : self::sanitize($supportedFileType['name'],'text');
				$supportedFileType['type']			= self::sanitize($supportedFileType['type'],'text') == false ? '' : self::sanitize($supportedFileType['type'],'text');
		}
		unset($supportedFileType);
	}	
	/**
	 * dateDataSanitize
	 *
	 * @param  mixed $input
	 * @return void
	 */
	public static function dateDataSanitize(&$input){
		$input['data']['dateType'] = (int)self::sanitize($input['data']['dateType'],'int');  

			foreach($input['data']['dateData'] as &$d){

				$d['key'] = (int)self::sanitize($d['key'],'int');
				$d['name'] = self::sanitize($d['name'],'text') == false ? '' : self::sanitize($d['name'],'text');

				foreach($d['range'] as &$r){

					$r['startDate'] = self::sanitize($r['startDate'],'text') == false ? '' : self::sanitize($r['startDate'],'text');
					$r['endDate'] = self::sanitize($r['endDate'],'text') == false ? '' : self::sanitize($r['endDate'],'text');

				}
				unset($r);

			}
			unset($d);
	}


}