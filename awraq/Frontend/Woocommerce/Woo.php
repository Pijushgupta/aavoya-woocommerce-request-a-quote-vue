<?php

namespace Awraq\Frontend\Woocommerce;
if (!defined('ABSPATH')) exit;

class Woo {

	public static $globalScopeName = 'Awraq\Frontend\Woocommerce\Woo';
	public static $postId = null;
	public static $raqId = null;

	public static function activate(): void {
		/**
		 * Template Redirect :  as it will make sure that our code only get
		 * executed on template redirection and Template redirect fires only
		 * on Frontend. So our code is safe from executing in admin area too.
		 */
		add_action('template_redirect',array(self::$globalScopeName,'init'));

	}

	public static function init(){
		/**
		 * it will verify if woocommerce installed and if its a product page/post
		 */
		if (!function_exists('is_product')) return;
		if (!is_product()) return;

		global $post;
		self::$postId = $post->ID;
		self::$raqId = self::findInProduct();

		if(self::$raqId != false){
			//TODO: Check if the button still exist or not
			self::disableSingleAddtoCart();
			self::addButton();
			return;
		}
	}

	public static function findInProduct(){
		if(self::$postId == null) return false;
		$raqMeta = get_post_meta(self::$postId,'_awraq_button_data',true);
		if($raqMeta == false || $raqMeta == '') return false;
		$raqMeta = unserialize($raqMeta);
		if( array_key_exists('switch',$raqMeta) && $raqMeta['switch'] == true && array_key_exists('selected',$raqMeta) ){
			return $raqMeta['selected'];
		}
		return false;
	}
	public static function findInCat(){}
	public static function findInTag(){}
	public static function disableSingleAddtoCart(){
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
		//TODO: add custom code for few themes that bypass normal add to cart, like astra.
	}
	public static function addButton(){
		add_action('woocommerce_single_product_summary',function(){
			echo do_shortcode('[awraq id="'.self::$raqId.'"]');
		},30);
	}
}
