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



}