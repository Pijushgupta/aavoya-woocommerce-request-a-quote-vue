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
		 * Also checking the set form still exists
		 */
		if($buttonMeta['fs'] == 0 || get_post($buttonMeta['fs']) == null){
			$html = '<div style="padding:2em;border:2px solid red; display:inline-block;"> Please assign a Form to the Button</div>';
			return $html;
		}


		$randomNumber= rand(0,9999);
		$uniqueId = 'awraq'.$id.''.$randomNumber;
		$html = Button::create($buttonMeta['drawer'],$id,$uniqueId);


		$html .= self::formWrapper($buttonMeta['formDrawer'],$id,$uniqueId);
		if(str_contains($html,'{form}')){
			$a = array('id'=>$buttonMeta['fs']);
			$html = str_replace('{form}',self::awraqCreateForm($a),$html );
		}
		return $html;
	}

	public static function formWrapper($formWrapper = null, $id = null,$uniqueId = null){
		if($formWrapper == null || $id == null || $uniqueId == null) return false;
		$htmlId = 'formwrapper'.$id.rand(0,9999);
		$xButtonId = 'xCloseId'.$id;
		$html = "\r\n".'<div class="form-area" style="display:none; position: absolute; inset: 0;  justify-content: center; align-items: center; z-index:99;" id='.$uniqueId.' >'."\r\n".' <style> #'.$htmlId.'{';
		$html .= 'background-color:'.$formWrapper['bgColor'].'!important;'."\r\n";
		$html .= 'position:relative;'."\r\n";
		$html .= 'padding:'.$formWrapper['paddingY'].'px '. $formWrapper['paddingX'].'px ;'."\r\n";
		$html .= 'box-shadow:'.$formWrapper['formShadow']['hOffset'].'px '. $formWrapper['formShadow']['vOffset'].'px ' . $formWrapper['formShadow']['blur'].'px '.$formWrapper['formShadow']['spread'].'px '.$formWrapper['formShadow']['color'].'; '."\r\n";
		$html .='border-radius:'.$formWrapper['corners'].'px;'."\r\n";
		$html .='}'."\r\n".' #'.$xButtonId.'{'."\r\n";
		$html .='position:absolute;'."\r\n";
		$html .='cursor:pointer;'."\r\n";
		$html .='display:flex;'."\r\n";
		if($formWrapper['btPosition'] == 'top-right'){
			$html .='top:0'.';'."\r\n";
			$html .='right:0'.';'."\r\n";
			$html .='margin-top: -'.($formWrapper['svgSize']/2).'px;'."\r\n";
			$html .='margin-right: -'.($formWrapper['svgSize']/2).'px;'."\r\n";
		}
		if($formWrapper['btPosition'] == 'top-left'){
			$html .='top:0'.';'."\r\n";
			$html .='left:0'.';'."\r\n";
			$html .='margin-top: -'.($formWrapper['svgSize']/2).'px;'."\r\n";
			$html .='margin-left: -'.($formWrapper['svgSize']/2).'px;'."\r\n";
		}

		$html .='border-radius: 9999px;'."\r\n";
		$html .='background-color:'.$formWrapper['svgSpanBg'].';'."\r\n";
		$html .='box-shadow:'.$formWrapper['svgShadow']['hOffset'].'px '. $formWrapper['svgShadow']['vOffset'].'px ' . $formWrapper['svgShadow']['blur'].'px '.$formWrapper['svgShadow']['spread'].'px '.$formWrapper['svgShadow']['color'].'; '."\r\n";

		$html .='} #xButtonSvg'.$id.'{'."\r\n";
		$html .='width:'.$formWrapper['svgSize'].'px;'."\r\n";
		$html .='height:'.$formWrapper['svgSize'].'px;'."\r\n";
		$html .='fill:'.$formWrapper['svgFill'].';'."\r\n";
		$html .='stroke:'.$formWrapper['svgStroke'].';'."\r\n";
		$html .= '}'.'</style>';
		$html .='<script>';
		$html .='window.addEventListener("load", function(){'."\r\n";
		$html .='let xButton = document.querySelector("#'.$xButtonId.'");' . "\r\n";
		$html .='xButton.addEventListener("click",function(){'. "\r\n";
		$html .='let elementToTarget = xButton.getAttribute("data-attr");'."\r\n";
		$html .='let formDiv = document.getElementById(elementToTarget);';
		$html .='formDiv.style.display = "none";'."\r\n";
		$html .='});'."\r\n";
		$html .= '});</script>';
		$html .= '<div id="'.$htmlId.'" class="'. sanitize_html_class($formWrapper['formCssClassName']).'" >';
		$html .= '<span id="'.$xButtonId.'" data-attr="'.$uniqueId.'"><svg xmlns="http://www.w3.org/2000/svg" class="'.sanitize_html_class($formWrapper['svgCssClassName']).'" id="xButtonSvg'.$id.'" viewBox="0 0 24 24"  stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>';
		$html .= '{form}</div></div>';
		return $html;
	}

	public static function awraqCreateForm($a){
		if(!$a['id']) { return false;}
		$id = intval($a['id']);
		$post_type = get_post_type($id);
		if($post_type == 'aavoya_wraq_form'){
			return self::awraqForm($a);
		}
		$activationToken = true;
		//TODO: Check activation token
		if($activationToken == true){
			switch ($post_type){
				case 'wpcf7_contact_form':
					return do_shortcode('[contact-form-7 id="'.$id.'"]');
					break;
			    case 'wpforms':
					return do_shortcode('[wpforms id="'.$id.'"]');
					break;
				case 'forminator_forms':
					return do_shortcode('[forminator_form id="'.$id.'"]');
					break;
				case 'forminator_polls':
					return do_shortcode('[forminator_poll id="'.$id.'"]');
					break;
				case 'forminator_quizzes':
					return do_shortcode('[forminator_quiz id="'.$id.'"]');
					break;
			}
		}
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

		/* Creating Aavoya the Form */
		$formInputs = Meta::getForm($id);
		if($formInputs == false) return false;
		return Form::create($formInputs,$id);

	}

}