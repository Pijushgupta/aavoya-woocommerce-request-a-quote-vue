<?php

namespace Awraq\Frontend;
if(!defined('ABSPATH')) exit;
use Awraq\Base\Meta;

class Button {
	

		public static function create($buttonMeta = null,$id){
			if($buttonMeta == null) return false;
			
			$htmlId = 'awraq-button-' . $id;

			$html = '<style> #'.$htmlId.'{'."\r\n";
			$html .= 'cursor: pointer;'."\r\n"; 
			$html .= 'border-radius:' . $buttonMeta['corners'] . 'px !important;'."\r\n";
			$html .= 'padding: ' . $buttonMeta['paddingY'] .'px'.' '. $buttonMeta['paddingX'].'px !important;'."\r\n";
			$html .= 'letter-spacing: ' . $buttonMeta['letterSpacing'] .'px !important;'."\r\n";
			$html .= 'font-size: ' . $buttonMeta['fontSize'] .'px !important;'."\r\n";
			$html .= 'font-weight: ' . $buttonMeta['fontWeight'] .' !important;'."\r\n";
			$html .= 'background-color: ' . $buttonMeta['backgroundColor'] .' !important;'."\r\n";
			$html .= 'color: ' . $buttonMeta['textColor'] .' !important;'."\r\n";
			if($buttonMeta['borderTab'] != false && $buttonMeta['borderType'] != 'none'){
				$html .= 'border: ' . $buttonMeta['borderType'] .' ' .$buttonMeta['borderWidth'].'px '. $buttonMeta['borderColor'].'!important;'."\r\n";
			}
			
			$html .='box-shadow:'.$buttonMeta['buttonShadow']['hOffset'].'px'.' '.$buttonMeta['buttonShadow']['vOffset'].'px'.' '.$buttonMeta['buttonShadow']['blur'].'px'.' '.$buttonMeta['buttonShadow']['spread'].'px'.' '.$buttonMeta['buttonShadow']['color'].'!important;'."\r\n";
			$html .='}'."\r\n";
			/* Hover */
			$html .='#'.$htmlId.':hover{'."\r\n";
			$html .='background-color: ' . $buttonMeta['hoverBackgroundColor'] .' !important;'."\r\n";
			$html .='background-color: ' . $buttonMeta['hoverBackgroundColor'] .' !important;'."\r\n";
			if($buttonMeta['borderTab'] != false && $buttonMeta['hoverBorderType'] != 'none'){
				$html .= 'border: ' . $buttonMeta['hoverBorderType'] .' ' .$buttonMeta['hoverBorderWidth'].'px '. $buttonMeta['hoverBorderColor'].' !important;'."\r\n";
			}
			/* Hover ends */
			$html .='}</style>'."\r\n";
			$html .= '<button id="' . $htmlId . '" class="'.$buttonMeta['cssClass'].'" >' . $buttonMeta['buttonText'] . '</button>';

			return $html;


		}
}