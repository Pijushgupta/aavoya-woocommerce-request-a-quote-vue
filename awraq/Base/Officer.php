<?php 
namespace Awraq\Base;
if(!defined('ABSPATH')) exit;
class Officer{
	public static function check($postdata = false){
		
		if($postdata == false) return;

		if($postdata['awraq_nonce']){

			if(wp_verify_nonce($postdata['awraq_nonce'], 'awraq_nonce')){
				return true;
			}

		}

		return false;
	}

}