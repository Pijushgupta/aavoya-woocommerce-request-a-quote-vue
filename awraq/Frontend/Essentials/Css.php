<?php

namespace Awraq\Frontend\Essentials;

if (!defined('ABSPATH')) exit;

class Css {
	public static function create() {
		$css 	= '<style>';
		$css .= '.file>label:first-child, .email>label:first-child, .textarea>label:first-child, .text>label:first-child, .radio>label:first-child, .checkbox>label:first-child{display:block; margin-top:10px;}';
		$css .= '.flex{display:flex;}.flex-row{flex-direction:row;}.flex-wrap{flex-wrap:wrap;}.block{display:block;} .w-full{ width:100%;} .w-1\/2{width:50%;}.w-1\/2:last-child{padding-right:0;} .w-1\/3{width:33.333333%;}.w-1\/3:last-child{padding-right:0;}.pr-2{padding-right:.5rem;}.my-2{margin-top:.5rem;margin-bottom:.5rem;}.mt-2{margin-top:.5rem;}.file input{padding: 12px 5px; border: 1px solid #ececec; display: block; width: 100%; cursor:pointer;}';
		$css .= '.textarea textarea{width:100%; height:150px;}';
		$css .= '</style>';
		return $css;
	}
}
