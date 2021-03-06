<?php 

namespace Awraq\Base;
if(!defined('ABSPATH')) exit;
class Post {

	public static function create($id = ''){
		return wp_insert_post(array('ID' => $id, 'post_type' => 'aavoya_wraq', 'post_status' => 'publish'));
	}
	public static function createForm($id = ''){
		return wp_insert_post(array('ID' => $id, 'post_type' => 'aavoya_wraq_form', 'post_status' => 'publish'));
	}

	public static function read($posts_per_page = -1){
		return get_posts(array('post_type' => 'aavoya_wraq','post_status' => 'publish','posts_per_page' => $posts_per_page));
	}

	public static function readProduct(){
		return get_posts(array('post_type' => 'product','post_status' => 'publish','posts_per_page' => -1));
	}

	public static function readForm(){
		return get_posts(array('post_type' => 'aavoya_wraq_form','post_status' => 'publish','posts_per_page' => -1));
	}

	public static function delete($id = null){
		if($id == null) return false;
		wp_delete_post($id, true);
	}

	public static function update($id = null ,$data){
		if($id == null) return false;
		if(!is_array($data)) return false;

		$data['status'] = $data['status'] ? $data['status'] : 'publish';
		return wp_update_post(array('ID'=>$id,'post_title'=> $data['title'], 'post_status' => $data['status']));	
	}

}