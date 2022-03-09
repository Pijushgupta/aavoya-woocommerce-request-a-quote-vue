<?php 

namespace Awraq\Base;
if(!defined('ABSPATH')) exit;
class Post {

	public static function create($id = ''){
		return wp_insert_post(array(ID => $id, 'post_type' => 'aavoya_wraq', 'post_status' => 'publish'));
	}

	public static function load(){

		return get_posts(array('post_type' => 'aavoya_wraq','post_status' => 'publish','posts_per_page' => -1));
	}

	public static function delete($id){
		wp_delete_post($id, true);
	}
}