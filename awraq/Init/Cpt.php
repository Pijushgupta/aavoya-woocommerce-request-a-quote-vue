<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;




final class Cpt
{
	public static function createPostType()
	{
		if (!post_type_exists('aavoya_wraq')) {
			register_post_type('aavoya_wraq', array(
				'labels' => array(
					'name' => __('Aavoya Request a Quote', 'aavoya-woocommerce-request-a-quote'),
					'singular_name' => __('Aavoya Request a Quote', 'aavoya-woocommerce-request-a-quote'),
					'add_new' => __('Add New', 'aavoya-woocommerce-request-a-quote'),
					'add_new_item' => __('Add New Item', 'aavoya-woocommerce-request-a-quote'),
					'edit_item' => __('Edit Item', 'aavoya-woocommerce-request-a-quote'),
					'new_item' => __('New Item', 'aavoya-woocommerce-request-a-quote'),
					'view_item' => __('View Item', 'aavoya-woocommerce-request-a-quote'),
					'search_items' => __('Search Items', 'aavoya-woocommerce-request-a-quote'),
					'not_found' => __('Nothing Found', 'aavoya-woocommerce-request-a-quote'),
					'not_found_in_trash' => __('Nothing Found in Trash', 'aavoya-woocommerce-request-a-quote'),
					'parent_item_colon' => ''
				),
				'description' => 'Aavoya Request a Quote',
				'public' => true,
				'exclude_from_search' => true, // When a search is conducted through search.php, should it be excluded?
				'publicly_queryable' => true, // When a parse_request() search is conducted, should it be included?
				'show_ui' => true, // Should the primary admin menu be displayed?
				'show_in_nav_menus' => false, // Should it show up in Appearance > Menus?
				'show_in_menu' => true, // This inherits from show_ui, and determines *where* it should be displayed in the admin
				'show_in_admin_bar' => false, // Should it show up in the toolbar when a user is logged in?
				'has_archive' => false,
				'rewrite' => false
			));
		}
	}
}
