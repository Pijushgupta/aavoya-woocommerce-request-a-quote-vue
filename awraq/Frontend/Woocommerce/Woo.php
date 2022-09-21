<?php

namespace Awraq\Frontend\Woocommerce;
if (!defined('ABSPATH')) exit;

class Woo {

	public static $globalScopeName = 'Awraq\Frontend\Woocommerce\Woo';
	public static $postId = null;
	public static $raqId = false;

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

		/* Priority 0*/
		self::$raqId = self::findInProduct();

		/* Priority 1 - Category*/
		if(self::$raqId == false || get_post(self::$raqId) == null){

			self::$raqId = self::findInCat();

		}
		/* Priority 2*/
		if(self::$raqId == false || get_post(self::$raqId) == null){
			self::$raqId = self::findInTag();
		}

		/**
		 * Checking associated button still exists
		 * Don't need to check form associated with the button still exists or not
		 * Since it's done by Button generating code
		 */
		if(self::$raqId == false || get_post(self::$raqId) == null) return;

		if(self::$raqId != false){
			self::disableSingleAddtoCart();
			self::addButton();
			return;
		}

	}

	/**
	 * Finds Button id in Product's Meta
	 * @return false|mixed
	 */
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

	/**
	 * Finds Button id in Product's Category meta
	 * Search through multiple categories and select the category with the highest id
	 * @return false|mixed
	 */
	public static function findInCat(){
		if(self::$postId == null) return false;

		$product_categories = get_the_terms(self::$postId,'product_cat');

		if(is_wp_error($product_categories)) return false;
		if($product_categories == false) return false;

		$raqMetaArray = array();
		foreach($product_categories as $key => $product_category){
			$raqMeta = get_term_meta($product_category->term_id,'awraq_term_meta',true);
			if($raqMeta != false || $raqMeta != ''){
				array_push($raqMetaArray,array($product_category->term_id,unserialize($raqMeta)));
			}
		}

		/**
		 * Only selecting the category with higher ID value;
		 */
		$counter = 0;
		$raqMeta = false;
		foreach($raqMetaArray as $k=>$d){
			if($d[0] > $counter && $d[1]['switch'] == true){
				$counter = $d[0];
				$raqMeta = $d[1]['selected'];
			}
		}
		return $raqMeta;

	}

	/**
	 * Finds Button id in Product's Tag meta
	 * Search through multiple tags and select the tag with the highest id
	 * @return false|mixed
	 */
	public static function findInTag(){
		if(self::$postId == null) return false;
		$product_tags = get_the_terms(self::$postId,'product_tag');

		if(is_wp_error($product_tags)) return false;
		if($product_tags == false) return false;

		$raqMetaArray = array();
		foreach($product_tags as $key => $product_tag){
			$raqMeta = get_term_meta($product_tag->term_id,'awraq_term_meta',true);
			if($raqMeta != false || $raqMeta != ''){
				array_push($raqMetaArray,array($product_tag->term_id,unserialize($raqMeta)));
			}
		}
		/**
		 * Only selecting the tag with higher ID value;
		 */
		$counter = 0;
		$raqMeta = false;
		foreach($raqMetaArray as $k=>$d){
			if($d[0] > $counter && $d[1]['switch'] == true){
				$counter = $d[0];
				$raqMeta = $d[1]['selected'];
			}
		}
		return $raqMeta;


	}

	/**
	 * Disable the Woocommerce's default price
	 * Disable the Woocommerce's deafult "add to cart" button
	 * @return void
	 */
	public static function disableSingleAddtoCart(){
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
		//TODO: add custom code for few themes that bypass normal add to cart, like astra.
	}

	/**
	 * Add RAQ button with popup form
	 * @return void
	 */
	public static function addButton(){
		add_action('woocommerce_single_product_summary',function(){
			echo do_shortcode('[awraq id="'.self::$raqId.'"]');
		},30);
	}
}
