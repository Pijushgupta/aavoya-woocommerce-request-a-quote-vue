<?php

namespace Awraq\Base;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;
use Awraq\Base\Meta;

class Button {
	public  static $globalScopeName = 'Awraq\Base\Button';

	public static function enable() {
		add_action('wp_ajax_awraqCreatePost', array(self::$globalScopeName, 'awraqCreateButton'));
		add_action('wp_ajax_awraqLoadPost', array(self::$globalScopeName, 'awraqLoadButtons'));
		add_action('wp_ajax_awraqDeletePost', array(self::$globalScopeName, 'awraqDeleteButton'));
		add_action('wp_ajax_awraqSavePost', array(self::$globalScopeName, 'awraqSaveButton'));
	}

	/**
	 * Creating Button
	 * @param void
	 * @return void
	 */
	public static function awraqCreateButton(): void {
		if (Officer::check($_POST) == false) wp_die();

		$post_id    =    wp_insert_post(array(
			'ID' => '',
			'post_type' => 'aavoya_wraq',
			'post_status' => 'publish'
		));
		Meta::addDefault($post_id);

		/*
        * get_post by default will return the lastest post if 'posts_per_page' => 1
        */
		echo json_encode(Meta::get(get_posts(array(
			'post_type' => 'aavoya_wraq',
			'post_status' => 'publish',
			'posts_per_page' => 1
		))));
		wp_die();
	}

	/**
	 * Sending buttons data
	 * @param void
	 * @return void
	 */
	public static function awraqLoadButtons() {
		if (Officer::check($_POST) == false) wp_die();
		$posts = get_posts(array(
			'post_type' => 'aavoya_wraq',
			'post_status' => 'publish',
			'posts_per_page' => -1
		));
		if($posts == false || $posts == '' || count($posts) < 1){
			echo json_encode(null);
			wp_die();
		}
		$row_bundle = Meta::get($posts);
		echo json_encode($row_bundle);

		wp_die();
	}

	/**
	 * This method for deleting a button
	 * @param void
	 * @return void
	 */
	public static function awraqDeleteButton() {
		if (Officer::check($_POST) == false) wp_die();

		Meta::delete(intval($_POST['post_id']));
		wp_delete_post(intval($_POST['post_id']), true);

		echo json_encode(true);
		wp_die();
	}

	public static function awraqSaveButton() {
		if (Officer::check($_POST) == false) wp_die();

		$drawerId	= (int)Officer::sanitize($_POST['drawerId'], 'int');
		$title		= Officer::sanitize($_POST['title'], 'text');
		$sc		= '[awraq id="' . $drawerId . '"]';
		$fs		= (int)Officer::sanitize($_POST['fs'], 'int');
		$drawer		= Officer::jsonToArray($_POST['drawer']);
		$formDrawer	= Officer::jsonToArray($_POST['formDrawer']);

		$drawer = array(
			'backgroundColor'		=> Officer::sanitize($drawer['backgroundColor'], 'color'),
			'borderColor'			=> Officer::sanitize($drawer['borderColor'], 'color'),
			'borderTab'			=> Officer::sanitize($drawer['borderTab'], 'bool'),
			'borderType'			=> Officer::sanitize($drawer['borderType'], 'text'),
			'borderWidth'			=> (int)Officer::sanitize($drawer['borderWidth'], 'int'),
			'buttonText'			=> Officer::sanitize($drawer['buttonText'], 'text'),
			'corners'			=> (int)Officer::sanitize($drawer['corners'], 'int'),
			'cssClass'			=> Officer::sanitize($drawer['cssClass'], 'class'),
			'fontSize'			=> (int)Officer::sanitize($drawer['fontSize'], 'int'),
			'fontWeight'			=> (int)Officer::sanitize($drawer['fontWeight'], 'int'),
			'hoverBackgroundColor'          => Officer::sanitize($drawer['hoverBackgroundColor'], 'color'),
			'hoverBorderColor'		=> Officer::sanitize($drawer['hoverBorderColor'], 'color'),
			'hoverBorderType'		=> Officer::sanitize($drawer['hoverBorderType'], 'text'),
			'hoverBorderWidth'		=> (int)Officer::sanitize($drawer['hoverBorderWidth'], 'int'),
			'hoverTextColor'		=> Officer::sanitize($drawer['hoverTextColor'], 'color'),
			'letterSpacing'			=> (int)Officer::sanitize($drawer['letterSpacing'], 'int'),
			'paddingX'			=> (int)Officer::sanitize($drawer['paddingX'], 'int'),
			'paddingY'			=> (int)Officer::sanitize($drawer['paddingY'], 'int'),
			'textColor'			=> Officer::sanitize($drawer['textColor'], 'color'),
			'buttonShadow'			=> array(
				'blur'		=> (int)Officer::sanitize($drawer['buttonShadow']['blur'], 'int'),
				'color'		=> Officer::sanitize($drawer['buttonShadow']['color'], 'color'),
				'hOffset'	=> (int)Officer::sanitize($drawer['buttonShadow']['hOffset'], 'int'),
				'spread'	=> (int)Officer::sanitize($drawer['buttonShadow']['spread'], 'int'),
				'vOffset'	=> (int)Officer::sanitize($drawer['buttonShadow']['vOffset'], 'int'),
			)
		);

		$formDrawer = array(
			'bgColor'			=> Officer::sanitize($formDrawer['bgColor'], 'color'),
			'btPosition'			=> Officer::sanitize($formDrawer['btPosition'], 'text'),
			'corners'			=> (int)Officer::sanitize($formDrawer['corners'], 'int'),
			'formCssClassName'		=> Officer::sanitize($formDrawer['formCssClassName'], 'class'),
			'formShadow'			=> array(
				'blur'		=> (int)Officer::sanitize($formDrawer['formShadow']['blur'], 'int'),
				'color'		=> Officer::sanitize($formDrawer['formShadow']['color'], 'color'),
				'hOffset'	=> (int)Officer::sanitize($formDrawer['formShadow']['hOffset'], 'int'),
				'spread'	=> (int)Officer::sanitize($formDrawer['formShadow']['spread'], 'int'),
				'vOffset'	=> (int)Officer::sanitize($formDrawer['formShadow']['vOffset'], 'int'),
			),
			'paddingX'			=> (int)Officer::sanitize($formDrawer['paddingX'], 'int'),
			'paddingY'			=> (int)Officer::sanitize($formDrawer['paddingY'], 'int'),
			'svgCssClassName'		=> Officer::sanitize($formDrawer['svgCssClassName'], 'class'),
			'svgFill'			=> Officer::sanitize($formDrawer['svgFill'], 'color'),
			'svgShadow'			=> array(
				'blur'		=> (int)Officer::sanitize($formDrawer['svgShadow']['blur'], 'int'),
				'color'		=> Officer::sanitize($formDrawer['svgShadow']['color'], 'color'),
				'hOffset'	=> (int)Officer::sanitize($formDrawer['svgShadow']['hOffset'], 'int'),
				'spread'	=> (int)Officer::sanitize($formDrawer['svgShadow']['spread'], 'int'),
				'vOffset'	=> (int)Officer::sanitize($formDrawer['svgShadow']['vOffset'], 'int'),
			),
			'svgSize'			=> (int)Officer::sanitize($formDrawer['svgSize'], 'int'),
			'svgSpanBg'			=> Officer::sanitize($formDrawer['svgSpanBg'], 'color'),
			'svgStroke'			=> Officer::sanitize($formDrawer['svgStroke'], 'color')
		);


		wp_update_post(array('ID' => $drawerId, 'post_title' => $title, 'post_status' => 'publish'));
		Meta::update($drawerId, $title, $sc, $fs, $drawer, $formDrawer);
		echo json_encode(true);


		wp_die();
	}
}
