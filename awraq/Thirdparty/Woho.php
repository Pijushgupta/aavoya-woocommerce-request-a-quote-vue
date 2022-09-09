<?php

namespace Awraq\Thirdparty;

use Awraq\Base\Officer;

use Awraq\Base\Meta;

class Woho {

	private static $globalScopeName = 'Awraq\Thirdparty\Woho';

	public static function enable() {
		add_action('wp_ajax_awraqProducts', array(self::$globalScopeName, 'awraqProducts'));
		add_action('wp_ajax_awraqUpdateProduct', array(self::$globalScopeName, 'awraqUpdateProduct'));
		add_action('wp_ajax_awraqGetProductCat', array(self::$globalScopeName, 'awraqGetProductCat'));
		add_action('wp_ajax_awarqUpdateProductTerm', array(self::$globalScopeName, 'awarqUpdateProductTerm'));
		add_action('wp_ajax_awraqGetProductTag', array(self::$globalScopeName, 'awraqGetProductTag'));
	}

	public static function awraqProducts() {

		if (!Officer::check($_POST)) wp_die();

		$products = get_posts(array('post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1));;

		$shortCodes = get_posts(array(
			'post_type' => 'aavoya_wraq',
			'post_status' => 'publish',
			'posts_per_page' => -1
		));
		$filteredShortCodes = array();

		foreach ($shortCodes as $key => $shortCode) {
			$filteredShortCodes[$key]['id'] 	= (int)Officer::sanitize($shortCode->ID, 'int');
			$filteredShortCodes[$key]['title']	= esc_html($shortCode->post_title);
		}

		$filteredProducts = array();
		foreach ($products as $key => $product) {

			$product_meta = Meta::getProduct($product->ID);

			$filteredProducts[$key]['id'] = (int)Officer::sanitize($product->ID, 'int');
			$filteredProducts[$key]['title'] = esc_html($product->post_title);
			$filteredProducts[$key]['slug'] = esc_html($product->post_name);
			$filteredProducts[$key]['options'] = $filteredShortCodes;
			$filteredProducts[$key]['selected'] = (int)Officer::sanitize($product_meta['selected'], 'int');
			$filteredProducts[$key]['switch'] = Officer::sanitize($product_meta['switch'], 'bool');
		}
		if (count($filteredProducts) <= 0) {
			$filteredProducts = null;
		}
		echo json_encode($filteredProducts);
		wp_die();
	}

	public static function awraqUpdateProduct() {
		if (!Officer::check($_POST)) wp_die();

		$product_id	=	(int)Officer::sanitize($_POST['product_id'], 'int');
		$selected	=	(int)Officer::sanitize($_POST['selected'], 'int');
		$switch		=	Officer::sanitize($_POST['switch'], 'bool');

		echo json_encode(Meta::updateProduct($product_id, array('selected' => $selected, 'switch' => $switch)));
		wp_die();
	}

	public static function awraqGetProductCat() {
		if (!Officer::check($_POST)) wp_die();

		$filteredOptions = array();
		$options = get_posts(array('post_type' => 'aavoya_wraq', 'post_status' => 'publish', 'posts_per_page' => -1));

		foreach ($options as $key => $option) {
			$filteredOptions[$key]['id'] = (int)Officer::sanitize($option->ID, 'int');
		}

		$wooCats = get_categories(array('taxonomy' => 'product_cat', 'hierarchical' => 1, 'orderby' => 'term_order', 'hide_empty' => false));
		$filteredWooCats = array();

		foreach ($wooCats as $key => $value) {

			$term_meta = unserialize(get_term_meta($value->term_id, 'awraq_term_meta', true));

			if ((int)Officer::sanitize($value->parent, 'int') != 0) {
				$filteredWooCats[$key]['name'] = self::fullNameWithParent($wooCats, $value->parent) . esc_html($value->name);
			} else {
				$filteredWooCats[$key]['name'] = esc_html($value->name);
			}


			$filteredWooCats[$key]['term_id']		= (int)Officer::sanitize($value->term_id, 'int');
			$filteredWooCats[$key]['count']		= (int)Officer::sanitize($value->count, 'int');
			$filteredWooCats[$key]['parent']		= (int)Officer::sanitize($value->parent, 'int');
			$filteredWooCats[$key]['selected']	=  $term_meta !== false ? (int)Officer::sanitize($term_meta['selected'], 'int'):0;
			$filteredWooCats[$key]['switch']		= $term_meta !== false ? Officer::sanitize($term_meta['switch'], 'bool'): 0;
			$filteredWooCats[$key]['options']		= $filteredOptions;
		}
		echo json_encode($filteredWooCats);
		wp_die();
	}

	public static function fullNameWithParent($cats, $parent_id) {
		$svg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline fill-cyan-500" viewBox="0 0 20 20" ><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>';
		foreach ($cats as $cat) {
			if ($cat->term_id == $parent_id) {
				return $cat->name . $svg;
			}
		}
	}

	public static function awarqUpdateProductTerm() {
		if (!Officer::check($_POST)) wp_die();

		$term_id	= (int)Officer::sanitize($_POST['term_id'], 'int');
		$selected	= (int)Officer::sanitize($_POST['selected'], 'int');
		$switch		= Officer::sanitize($_POST['switch'], 'bool');

		$term_meta	= serialize(array('selected' => $selected, 'switch' => $switch));

		echo update_term_meta($term_id, 'awraq_term_meta', $term_meta);

		wp_die();
	}

	public static function awraqGetProductTag() {
		if (!Officer::check($_POST)) wp_die();

		$filteredOptions = array();
		$options = get_posts(array('post_type' => 'aavoya_wraq', 'post_status' => 'publish', 'posts_per_page' => -1));

		foreach ($options as $key => $option) {
			$filteredOptions[$key]['id'] = (int)Officer::sanitize($option->ID, 'int');
		}

		$wooTags = get_tags(array('taxonomy' => 'product_tag', 'hide_empty' => false));
		$filteredWooCats = array();

		foreach ($wooTags  as $key => $value) {

			$term_meta = unserialize(get_term_meta($value->term_id, 'awraq_term_meta', true));
			$filteredWooCats[$key]['name']		= esc_html($value->name);
			$filteredWooCats[$key]['term_id']		= (int)Officer::sanitize($value->term_id, 'int');
			$filteredWooCats[$key]['count']		= (int)Officer::sanitize($value->count, 'int');
			$filteredWooCats[$key]['selected']	= $term_meta !== false ? (int)Officer::sanitize($term_meta['selected'], 'int'): 0;
			$filteredWooCats[$key]['switch']		= $term_meta !== false ? Officer::sanitize($term_meta['switch'], 'bool'): 0;
			$filteredWooCats[$key]['options']		= $filteredOptions;
		}

		echo json_encode($filteredWooCats);
		wp_die();
	}
}
