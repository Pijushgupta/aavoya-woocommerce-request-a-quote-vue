<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) {
	exit;
}



final class Initdata
{

	public static function addInitData()
	{

		/**
		 * adding default data(option - css) incase its not present in database.
		 */
		if (get_option('aavoya_wraq_global_settings', null) == null) {

			update_option('aavoya_wraq_global_settings', self::globalData());
		}

	
	}

	public static function globalData()
	{
		$globaldata = array(
			'drawer' => array(
				'corners'				=>intval(8),
				'paddingX'				=>intval(15),
				'paddingY'				=>intval(7),
				'letterSpacing'			=>intval(1),
				'fontSize'				=>intval(16),
				'fontWeight'			=>intval(400),
				'backgroundColor'		=>sanitize_hex_color('#1f40ab'),
				'hoverBackgroundColor'	=>sanitize_hex_color('#1f40ab'),
				'textColor'				=>sanitize_hex_color('#ffffff'),
				'hoverTextColor'		=>sanitize_hex_color('#ffffff'),
				'buttonText'			=>sanitize_text_field('Request a Quote'),
				'cssClass'				=>sanitize_html_class('awraq'),
				'borderTab'				=>rest_sanitize_boolean(false),
				'borderType'			=>sanitize_text_field('none'),
				'borderWidth'			=>intval(2),
				'borderColor'			=>sanitize_hex_color('#1f40ab'),
				'hoverBorderType'		=>sanitize_text_field('none'),
				'hoverBorderWidth'		=>intval(2),
				'hoverBorderColor'		=>sanitize_hex_color('#1f40ab'),
				'buttonShadow'			=> array(
					'blur'		=>intval(0),
					'color'		=>sanitize_hex_color('#000000'),
					'hOffset'	=>intval(0),
					'spread'	=>intval(0),
					'vOffset'	=>intval(0),
				)
			),
			'formDrawer' => array(
				'bgColor'				=>sanitize_hex_color('#ececec'),
				'btPosition'			=>sanitize_html_class('top-right'),
				'corners'				=>intval(8),
				'formCssClassName'		=>sanitize_html_class('awraqform'),
				'formShadow'			=>array(
						'blur'		=>intval(0),
						'color'		=>sanitize_hex_color('#ececec'),
						'hOffset'	=>intval(0),
						'spread'	=>intval(0),
						'vOffset'	=>intval(0),
						),
				'paddingX'				=>intval(4),
				'paddingY'				=>intval(4),
				'svgCssClassName'		=>sanitize_html_class('svgwraq'),
				'svgFill'				=>sanitize_hex_color('#ffffff'),
				'svgShadow'				=> array(
						'blur'		=>intval(0),
						'color'		=>sanitize_hex_color('#ececec'),
						'hOffset'	=>intval(0),
						'spread'	=>intval(0),
						'vOffset'	=>intval(0),
						),
				'svgSize'				=>intval(20),
				'svgSpanBg'				=>sanitize_hex_color('#ffffff'),
				'svgStroke'				=>sanitize_hex_color('#ff0000')
				)
		);
		

		
	
		return serialize($globaldata);
	}
}
