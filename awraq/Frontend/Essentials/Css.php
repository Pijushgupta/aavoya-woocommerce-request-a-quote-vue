<?php

namespace Awraq\Frontend\Essentials;

if (!defined('ABSPATH')) exit;

class Css
{
	public static function create()
	{
		$css 	= '<style>';
		$css .= '.file>label:first-child, .email>label:first-child, .textarea>label:first-child, .text>label:first-child, .radio>label:first-child, .checkbox>label:first-child{display:block; margin-top:10px;}';
		$css .= '.flex{display:flex;}.block{display:block;} .w-full{ width:100%;} .w-1\/2{width:50%;} .w-1\/3{width:33.333333%;}.pr-2{padding-right:1.75rem;}';
		$css .= '</style>';
		return $css;
	}
}
