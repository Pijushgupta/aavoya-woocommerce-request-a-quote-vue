<?php 
namespace Awraq\Frontend;
if(!defined('ABSPATH')) exit;
use Awraq\Base\Meta;
use Awraq\Frontend\Action;
use Awraq\Frontend\Form;
use Awraq\Frontend\Button;

class Shortcode{

	private static $globalScopeName = 'Awraq\Frontend\Shortcode';
		
	/**
	 * activate
	 *
	 * @return void
	 */
	public static function activate(){

		/*
		 * Registering Shortcode
		 */
		add_shortcode('awraq', array(self::$globalScopeName, 'awraqButton'));
		add_shortcode('awraqf', array(self::$globalScopeName, 'awraqForm'));

		/* 
		* Activating Action
		*/
		Action::enable();
	}	
	
	/**
	 * awraq_button
	 *
	 * @param  array $a(attribute array)
	 * @return void
	 */
	public static function awraqButton($a):string{
		if(!$a['id']) { return false;}
		$id = intval($a['id']);
	
		$buttonMeta = Meta::get($id);
		if($buttonMeta == false) return false;
		
		/*
		 * [fs] is the post id of selected form, stored inside the meta.
		 * if [fs] is not set, then the button is not going to be active.
		 */
		if($buttonMeta['fs'] == 0){
			$html = '<div style="padding:2em;border:2px solid red; display:inline-block;"> Please assign a Form to the Button</div>';
			return $html;
		}
		
		$html = Button::create($buttonMeta['drawer'],$id);
		$html .= self::formWrapper($buttonMeta['formDrawer'],$id);
		if(str_contains($html,'{form}')){
			$a = array('id'=>$buttonMeta['fs']);
			$html = str_replace('{form}',self::awraqForm($a),$html );
		}
		return $html;
	}

	public static function formWrapper($formWrapper = null, $id = null){
		if($formWrapper == null || $id == null) return false;
		$htmlId = 'formbyaavoya-'.$id;
		$xButtonId = 'xCloseId'.$id;
		$html = '<div class="form-area"><style> #'.$htmlId.'{';
		$html .= 'background-color:'.$formWrapper['bgColor'].'!important;'."\n\r";
		$html .= 'position:relative;'."\n\r";
		$html .= 'padding:'.$formWrapper['paddingY'].'px '. $formWrapper['paddingX'].'px ;'."\n\r";
		$html .= 'box-shadow:'.$formWrapper['formShadow']['hOffset'].'px '. $formWrapper['formShadow']['vOffset'].'px ' . $formWrapper['formShadow']['blur'].'px '.$formWrapper['formShadow']['spread'].'px '.$formWrapper['formShadow']['color'].'; '."\n\r";
		$html .='border-radius:'.$formWrapper['corners'].'px;'."\n\r";
		$html .='} #'.$xButtonId.'{';
		$html .='position:absolute;';
		if($formWrapper['btPosition'] == 'top-right'){
			$html .='top:0'.';'."\n\r";
			$html .='right:0'.';'."\n\r";
			$html .='margin-top: -'.($formWrapper['svgSize']/2).'px;'."\n\r";
			$html .='margin-right: -'.($formWrapper['svgSize']/2).'px;'."\n\r";
		}
		if($formWrapper['btPosition'] == 'top-left'){
			$html .='top:0'.';'."\n\r";
			$html .='left:0'.';'."\n\r";
			$html .='margin-top: -'.($formWrapper['svgSize']/2).'px;'."\n\r";
			$html .='margin-left: -'.($formWrapper['svgSize']/2).'px;'."\n\r";
		}

		$html .='border-radius:9999px;';
		$html .='background-color:'.$formWrapper['svgSpanBg'].';';
		$html .='box-shadow:'.$formWrapper['svgShadow']['hOffset'].'px '. $formWrapper['svgShadow']['vOffset'].'px ' . $formWrapper['svgShadow']['blur'].'px '.$formWrapper['svgShadow']['spread'].'px '.$formWrapper['svgShadow']['color'].'; '."\n\r";

		$html .='} #xButtonSvg'.$id.'{'."\n\r";
		$html .='width:'.$formWrapper['svgSize'].'px;'."\n\r";
		$html .='height:'.$formWrapper['svgSize'].'px;'."\n\r";
		$html .='fill:'.$formWrapper['svgFill'].';'."\n\r";
		$html .='stroke:'.$formWrapper['svgStroke'].';'."\n\r";
		$html .='}</style>';
		$html .= '<div id="'.$htmlId.'" class="'. sanitize_html_class($formWrapper['formCssClassName']).'">';
		$html .= '<span id="'.$xButtonId.'"><svg xmlns="http://www.w3.org/2000/svg" class="'.sanitize_html_class($formWrapper['svgCssClassName']).'" id="xButtonSvg'.$id.'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>';
		$html .= '{form}</div></div>';
		return $html;
	}

	
	/**
	 * awraqForm
	 *
	 * @param  mixed $a
	 * @return void
	 */
	public static function awraqForm($a){
		if(!$a['id']) { return false;}
		$id = intval($a['id']);
	
		$formInputs = Meta::getForm($id);
		if($formInputs == false) return false;
		/* Creating the Form */
		return Form::create($formInputs,$id);
	}

}