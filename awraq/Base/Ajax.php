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
		$posts = Post::read();
		$row_bundle = Meta::get($posts);
		echo json_encode($row_bundle);
		
		wp_die();

	}

	public static function awraqDeletePost(){
		if(Officer::check($_POST) == false ) wp_die();

		Meta::delete(intval($_POST['post_id']));
		Post::delete(intval($_POST['post_id']));
		
		echo json_encode(true);
		wp_die();
	}

	public static function awraqSavePost(){
		if(Officer::check($_POST) == false ) wp_die();
		
		$drawerId	= (int)Officer::sanitize($_POST['drawerId'], 'int');
		$title		= Officer::sanitize($_POST['title'],'text');
		$sc			= '[awraq id="'.$drawerId.'"]';
		$fs			= (int)Officer::sanitize($_POST['fs'],'int');
		$drawer		= Officer::jsonToArray($_POST['drawer']);
		$formDrawer	= Officer::jsonToArray($_POST['formDrawer']);

		$drawer = array(
			'backgroundColor'		=> Officer::sanitize($drawer['backgroundColor'],'color'),
			'borderColor'			=> Officer::sanitize($drawer['borderColor'],'color'),
			'borderTab'				=> Officer::sanitize($drawer['borderTab'],'bool'),
			'borderType'			=> Officer::sanitize($drawer['borderType'],'text'),
			'borderWidth'			=> (int)Officer::sanitize($drawer['borderWidth'],'int'),
			'buttonText'			=> Officer::sanitize($drawer['buttonText'],'text'),
			'corners'				=> (int)Officer::sanitize($drawer['corners'],'int'),
			'cssClass'				=> Officer::sanitize($drawer['cssClass'],'class'),
			'fontSize'				=> (int)Officer::sanitize($drawer['fontSize'],'int'),
			'fontWeight'			=> (int)Officer::sanitize($drawer['fontWeight'],'int'),
			'hoverBackgroundColor'	=> Officer::sanitize($drawer['hoverBackgroundColor'],'color'),
			'hoverBorderColor'		=> Officer::sanitize($drawer['hoverBorderColor'],'color'),
			'hoverBorderType'		=> Officer::sanitize($drawer['hoverBorderType'],'text'),
			'hoverBorderWidth'		=> (int)Officer::sanitize($drawer['hoverBorderWidth'],'int'),
			'hoverTextColor'		=> Officer::sanitize($drawer['hoverTextColor'],'color'),
			'letterSpacing'			=> (int)Officer::sanitize($drawer['letterSpacing'],'int'),
			'paddingX'				=> (int)Officer::sanitize($drawer['paddingX'],'int'),
			'paddingY'				=> (int)Officer::sanitize($drawer['paddingY'],'int'),	
			'textColor'				=> Officer::sanitize($drawer['textColor'],'color'),
			'buttonShadow'			=> array(
				'blur'		=> (int)Officer::sanitize($drawer['buttonShadow']['blur'],'int'),
				'color'		=> Officer::sanitize($drawer['buttonShadow']['color'],'color'),
				'hOffset'	=> (int)Officer::sanitize($drawer['buttonShadow']['hOffset'],'int'),
				'spread'	=> (int)Officer::sanitize($drawer['buttonShadow']['spread'],'int'),
				'vOffset'	=> (int)Officer::sanitize($drawer['buttonShadow']['vOffset'],'int'),
			)
		);
		
		$formDrawer = array(
			'bgColor'				=> Officer::sanitize($formDrawer['bgColor'],'color'),
			'btPosition'			=> Officer::sanitize($formDrawer['btPosition'],'text'),
			'corners'				=> (int)Officer::sanitize($formDrawer['corners'],'int'),
			'formCssClassName'		=> Officer::sanitize($formDrawer['formCssClassName'],'class'),
			'formShadow'			=> array(
				'blur'		=> (int)Officer::sanitize($formDrawer['formShadow']['blur'],'int'),
				'color'		=> Officer::sanitize($formDrawer['formShadow']['color'],'color'),
				'hOffset'	=> (int)Officer::sanitize($formDrawer['formShadow']['hOffset'],'int'),
				'spread'	=> (int)Officer::sanitize($formDrawer['formShadow']['spread'],'int'),
				'vOffset'	=> (int)Officer::sanitize($formDrawer['formShadow']['vOffset'],'int'),
			),
			'paddingX'				=> (int)Officer::sanitize($formDrawer['paddingX'],'int'),
			'paddingY'				=> (int)Officer::sanitize($formDrawer['paddingY'],'int'),
			'svgCssClassName'		=> Officer::sanitize($formDrawer['svgCssClassName'],'class'),
			'svgFill'				=> Officer::sanitize($formDrawer['svgFill'],'color'),
			'svgShadow'				=> array(
				'blur'		=> (int)Officer::sanitize($formDrawer['svgShadow']['blur'],'int'),
				'color'		=> Officer::sanitize($formDrawer['svgShadow']['color'],'color'),
				'hOffset'	=> (int)Officer::sanitize($formDrawer['svgShadow']['hOffset'],'int'),
				'spread'	=> (int)Officer::sanitize($formDrawer['svgShadow']['spread'],'int'),
				'vOffset'	=> (int)Officer::sanitize($formDrawer['svgShadow']['vOffset'],'int'),
			),
			'svgSize'				=> (int)Officer::sanitize($formDrawer['svgSize'],'int'),
			'svgSpanBg'				=> Officer::sanitize($formDrawer['svgSpanBg'],'color'),
			'svgStroke'				=> Officer::sanitize($formDrawer['svgStroke'],'color')
		);

		
		echo json_encode(Meta::update($drawerId,$title,$sc,$fs,$drawer,$formDrawer));

		
		wp_die();	
	}
		
}