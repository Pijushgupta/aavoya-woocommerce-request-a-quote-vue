<?php

namespace Awraq\Thirdparty;

use Awraq\Base\Officer;
use Awraq\Base\Post;

class Woho {

	private static $globalScopeName = 'Awraq\Thirdparty\Woho';

	public static function enable() {
		add_action('wp_ajax_awraqProducts', array(self::$globalScopeName, 'awraqProducts'));	
	}

	public static function awraqProducts(){


		if(!Officer::check($_POST)) wp_die();

		$products = get_posts(
			array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'posts_per_page' => -1,
			)
		);

		$shortCodes = Post::read();
		$filteredShortCodes = array();
		foreach($shortCodes as $key => $shortCode){
			$filteredShortCodes[$key]['id'] 	= intval($shortCode->ID); 
			$filteredShortCodes[$key]['title']	= esc_html($shortCode->post_title);
		}

		$filteredProducts = array();
		foreach($products as $key => $product){
			$filteredProducts[$key]['id'] = intval($product->ID);
			$filteredProducts[$key]['title'] = esc_html($product->post_title);
			$filteredProducts[$key]['slug'] = esc_html($product->post_name);
			$filteredProducts[$key]['options'] = $filteredShortCodes;
			//$filteredProducts[$key]['selected'] = intval(get_post_meta($product->ID, '_awraq_shortcode_id', true));
			$filteredProducts[$key]['selected'] = intval(0);

		}

		echo json_encode($filteredProducts);
		wp_die();
	}

}