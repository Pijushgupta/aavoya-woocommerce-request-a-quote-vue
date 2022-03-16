<?php

namespace Awraq\Base;
use Awraq\Base\Officer;
use Awraq\Base\Post;
use Awraq\Base\Meta;



if (!defined('ABSPATH')) exit;

class Ajax
{
	private static $globalScopeName = 'Awraq\Base\Ajax';

	public static function enable()
	{
		add_action('wp_ajax_awraqCreatePost', array(self::$globalScopeName, 'awraqCreatePost'));	
		add_action('wp_ajax_awraqLoadPost', array(self::$globalScopeName, 'awraqLoadPost'));	
		add_action('wp_ajax_awraqDeletePost', array(self::$globalScopeName, 'awraqDeletePost'));	
		add_action('wp_ajax_awraqSavePost', array(self::$globalScopeName, 'awraqSavePost'));
		
	}


	public static function awraqCreatePost()
	{
		if(Officer::check($_POST) == false ) wp_die();

		$post_id 	= Post::create();
		Meta::addDefault($post_id);

		echo json_encode(0);
		wp_die();

	}

	public static function awraqLoadPost()
	{
		if(Officer::check($_POST) == false ) wp_die();
		$posts = Post::load();
		$row_bundle = Meta::get($posts);
		echo json_encode($row_bundle);
		
		wp_die();

	}

	public static function awraqDeletePost(){
		if(Officer::check($_POST) == false ) wp_die();
		
		Post::delete(intval($_POST['post_id']));
		Meta::delete(intval($_POST['post_id']));

		echo json_encode(true);
		wp_die();
	}

	public static function awraqSavePost(){
		if(Officer::check($_POST) == false ) wp_die();
		
		// $drawerId	= intval($_POST['drawerId']);
		// $title		= sanitize_text_field( $_POST['title'] );
		// $fs			= intval($_POST['fs']);
		// $drawer		= json_decode($_POST['drawer'],true);
		// $formDrawer	= json_decode($_POST['formDrawer'], true);

		// echo json_encode($drawer["corners"]);
		// wp_die();

		
		
	}
	

	


	
	
}
