<?php 
namespace Awraq\Frontend;
if(!defined('ABSPATH')) exit;
use Awraq\Base\Meta;
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
		add_shortcode('awraq', array(self::$globalScopeName, 'awraqButton'));
		add_shortcode('awraqf', array(self::$globalScopeName, 'awraqForm'));
	}	
	
	/**
	 * awraq_button
	 *
	 * @param  array $a(attribute array)
	 * @return void
	 */
	public static function awraqButton($a){
		if(!$a['id']) { return false;}
		$id = intval($a['id']);
	
		$buttonMeta = Meta::get($id);
		if($buttonMeta == false) return false;
		
		if($buttonMeta['fs'] == 0){
			$html = '<div style="padding:2em;border:2px solid red; display:inline-block;"> Please assign a Form to the Button</div>';
			return $html;
		}
		$html = Button::create($buttonMeta['drawer'],$id);
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
		return Form::create($formInputs,$id);
	}

}