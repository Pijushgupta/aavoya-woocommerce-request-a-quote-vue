<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

class Css {
	public static function create() {
		$css 	= '<style>';
		$css .= '.aavoyafile>label:first-child, .aavoyaemail>label:first-child, .aavoyatextarea>label:first-child, .aavoyatel>label:first-child, .aavoyaradio>label:first-child, .aavoyacheckbox>label:first-child .aavoyaphone>label:first-child .aavoyacontent {display:block; margin-top:10px;}';
		$css .= '.aavoyaflex{display:flex;} .aavoyaflex-row{flex-direction:row;} .aavoyaflex-wrap{flex-wrap:wrap;} .aavoyablock{display:block;} .aavoyaw-full{ width:100%;} .aavoyaw-1\/2{width:50%;} .aavoyaw-1\/2:last-child{padding-right:0;} .aavoyaw-1\/3{width:33.333333%;} .aavoyaw-1\/3:last-child{padding-right:0;} .aavoyapr-2{padding-right:.5rem;} .aavoyamy-2{margin-top:.5rem;margin-bottom:.5rem;}.aavoyamt-2{margin-top:.5rem;} .aavoyafile input{padding: 12px 5px; border: 1px solid #ececec; display: block; width: 100%; cursor:pointer;}';
		$css .= '.aavoyatextarea textarea{width:100%; height:150px;}';
		$css .= '.awraq-form input:not(type=["submit"]) , .awraq-form textarea{background:#f9f9f9;}';
		$css .= '.awraq-form .submit {text-align:center;}';
		$css .= '</style>';
		return $css;
	}
}
