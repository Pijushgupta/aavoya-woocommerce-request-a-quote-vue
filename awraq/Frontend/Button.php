<?php

namespace Awraq\Frontend;
if(!defined('ABSPATH')) exit;
use Awraq\Base\Meta;

class Button {
	

		public static function create($buttonMeta = null,$id,$uniqueId){
			if($buttonMeta == null) return false;
			
			$htmlId = 'awraq-button-' . $id.rand(0,9999);

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
			$html .="<script> \r\n";
			$html .="window.addEventListener('load',function(){ \r\n";
			$html .= "let awraqButton = document.querySelector('#".$htmlId."'); \r\n";
			$html .= "awraqButton.addEventListener('click',function(){ \r\n";
			$html .= "let targettingElementId = awraqButton.getAttribute('data-attr'); \r\n";
			$html .= " document.getElementById(targettingElementId).style.display = 'flex'; \r\n";
			//$html .= "console.log(targettingElementId);";
			$html .= "});\r\n";
			$html .="}); \r\n";
			$html .="</script> \r\n";
			$html .= '<div class="button-area"><button id="' . $htmlId . '" class="'.$buttonMeta['cssClass'].'"  data-attr="'.$uniqueId.'">' . $buttonMeta['buttonText'] . '</button></div>';

			return $html;


		}
}