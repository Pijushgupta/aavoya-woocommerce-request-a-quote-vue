<?php

namespace Awraq\Base;

use Tiptap\Editor as TC;
use Tiptap\Extensions\StarterKit as StarterKit;
use Tiptap\Marks\Link as Link;

if (!defined('ABSPATH')) exit;
class Officer {

	/**
	 * check
	 * Nonce Checker for AJAX Requests
	 * @param  mixed $postdata
	 * @return boolean
	 */
	public static function check($postdata = false) {

		if ($postdata == false) return false;

		if ($postdata['awraq_nonce']) {

			if (wp_verify_nonce($postdata['awraq_nonce'], 'awraq_nonce')) {
				return true;
			}
		}
		return false;
	}



	/**
	 * jsonToArray
	 * Convert JSON to Array
	 * @param  mixed $json
	 * @return array
	 */
	public static function jsonToArray($json = null) {
		if ($json == null) return false;
		/**
		 * preserving newline char \n
		 */
		$json = str_replace('\\n', 'raqbyaavoyanewlinechar', $json);
		$json = str_replace('\\', '', $json);
		$json = str_replace('raqbyaavoyanewlinechar', '\\n', $json);
		$array = (array)json_decode($json, true);
		return $array;
	}



	/**
	 * sanitize
	 * Sanitize the data
	 * @param  mixed $element
	 * @param  string $type
	 * @return mixed
	 */
	public static function sanitize($element = null, $type = null) {
		if ($element == null or $type == null) return false;

		switch ($type) {

			case 'text':
				return sanitize_text_field($element);

			case 'int':
				return intval($element);

			case 'float':
				return floatval($element);

			case 'bool':
				return rest_sanitize_boolean($element);

			case 'class':
				return sanitize_html_class($element);

			case 'email':
				return sanitize_email($element);

			case 'color':
				return sanitize_hex_color($element);

			default:
				return null;
		}
	}


	/**
	 * formInputSanitize
	 * @param  mixed $element
	 * @return mixed
	 */
	public static function formInputSanitize($element) {
		if (gettype($element) == 'array') {
			foreach ($element as  &$value) {

				/* Common Direct Properties */
				$value['name']				= self::sanitize($value['name'], 'text') == false ? '' : self::sanitize($value['name'], 'text');
				$value['type']				= self::sanitize($value['type'], 'text') == false ? '' : self::sanitize($value['type'], 'text');
				$value['uniqueName']	= self::sanitize($value['uniqueName'], 'text') == false ? '' : self::sanitize($value['uniqueName'], 'text');
				$value['dataType']		= self::sanitize($value['dataType'], 'text') == false ? '' : self::sanitize($value['dataType'], 'text');
				$value['tabState']		= (int)self::sanitize($value['tabState'], 'int');
				$value['cssClass']		= self::sanitize($value['cssClass'], 'class') == false ? '' : self::sanitize($value['cssClass'], 'class');
				/* Common Direct Properties ends */





				switch ($value['type']) {
					case 'text':
					case 'textarea':
					case 'email':
					case 'phone':
						self::textDataSanitize($value['data']);
						break;
					case 'name':
					case 'address':
						self::nameAddressDataSanitize($value['data']);
						break;
					case 'checkbox':
					case 'radio':
						self::checkboxRadioDataSanitize($value['data']);
						break;
					case 'content':
						self::contentDataSanitization($value['data']);
						break;
					case 'file':
						self::fileDataSanitize($value['data']);
						break;
					case 'date':
						self::dateDataSanitize($value['data']);
						break;
					default:
						break;
				}
			} //Main loop ends
			unset($value);

			return $element;
		} // main if ends

	}

	/**
	 * textDataSanitize : This to Sanitize the text/email/phone/textarea input
	 * blueprint from the backend of the form
	 * @param  mixed $data (called by reference)
	 * @return void 
	 */
	public static function textDataSanitize(&$data) {
		$data['placeholder']	= self::sanitize($data['placeholder'], 'text')  == false ? '' : self::sanitize($data['placeholder'], 'text');
		$data['label']				= self::sanitize($data['label'], 'text') == false ? '' : self::sanitize($data['label'], 'text');
		$data['required']			= self::sanitize($data['required'], 'bool');
	}

	/**
	 * nameAddressDataSanitize : This to Sanitize the name/address input 
	 * blueprint from the backend of the form
	 * @param  mixed $data( called by reference)
	 * @return void 
	 */
	public static function nameAddressDataSanitize(&$data) {
		$data['tabState']	= (int)self::sanitize($data['tabState'], 'int');

		foreach ($data['Options'] as &$o) {
			$o['name']				= self::sanitize($o['name'], 'text') == false ? '' : self::sanitize($o['name'], 'text');
			$o['label']				= self::sanitize($o['label'], 'text') == false ? '' : self::sanitize($o['label'], 'text');
			$o['placeholder']	= self::sanitize($o['placeholder'], 'text') == false ? '' : self::sanitize($o['placeholder'], 'text');
			$o['enabled']			= self::sanitize($o['enabled'], 'bool');
			$o['required']		= self::sanitize($o['required'], 'bool');
		}
		unset($o);
	}


	/**
	 * contentDataSanitization : This to Sanitize the content(json) and convert it into html
	 * then again sanitize/allow only allowed html tags
	 * blueprint from the backend of the form
	 * @param  mixed $data(called by reference)
	 * @return void
	 */
	public static function contentDataSanitization(&$data) {
		$tcObject	= new TC([

			'extensions' => [
				new StarterKit,
				new Link
			],

		]);
		$tcObject->sanitize($data['content']);
		$data['content'] = $tcObject->getHTML();
	}


	/**
	 * checkboxRadioDataSanitize : This to Sanitize the checkbox/radio input
	 * blueprint from the backend of the form
	 * @param  mixed $data (called by reference)
	 * @return void
	 */
	public static function checkboxRadioDataSanitize(&$data) {
		$data['label']		= self::sanitize($data['label'], 'text') == false ? '' : self::sanitize($data['label'], 'text');
		$data['required']	= self::sanitize($data['required'], 'bool');

		foreach ($data['Options'] as &$o) {
			$o['id']			= (int)self::sanitize($o['id'], 'int');
			$o['name']		= self::sanitize($o['name'], 'text') == false ? '' : self::sanitize($o['name'], 'text');
			$o['value']		= self::sanitize($o['value'], 'text') == false ? '' : self::sanitize($o['value'], 'text');
		}
		unset($o);
	}


	/**
	 * fileDataSanitize : This to Sanitize the file input 
	 * blueprint from the backend of the form
	 * @param  mixed $data (called by reference)
	 * @return void
	 */
	public static function fileDataSanitize(&$data) {

		$data['label']		= self::sanitize($data['label'], 'text') == false ? '' : self::sanitize($data['label'], 'text');
		$data['required']	= self::sanitize($data['required'], 'bool');

		/* 
		* Maximum File Size 
		*/
		$data['maxFileSize'] = (int)self::sanitize($data['maxFileSize'], 'int');

		/* 
		* Selected file Type 
		*/
		foreach ($data['selectedFileType'] as &$ft) {
			$ft	= self::sanitize($ft, 'text') == false ? '' : self::sanitize($ft, 'text');
		}
		unset($ft);

		/* 
		* Supported file Types 
		*/
		foreach ($data['supportedFileTypes'] as &$s) {
			$s['key']			= (int)self::sanitize($s['key'], 'int');
			$s['name']		= self::sanitize($s['name'], 'text') == false ? '' : self::sanitize($s['name'], 'text');
			$s['type']		= self::sanitize($s['type'], 'text') == false ? '' : self::sanitize($s['type'], 'text');
		}
		unset($s);
	}


	/**
	 * dateDataSanitize : This to Sanitize the date input 
	 * blueprint from the backend of the form
	 * @param  mixed $data (called by reference)
	 * @return void
	 */
	public static function dateDataSanitize(&$data) {
		$data['label']			= self::sanitize($data['label'], 'text') == false ? '' : self::sanitize($data['label'], 'text');
		$data['required']		= self::sanitize($data['required'], 'bool');
		$data['dateType'] 	= (int)self::sanitize($data['dateType'], 'int');

		foreach ($data['dateData'] as &$d) {

			$d['key'] 	= (int)self::sanitize($d['key'], 'int');
			$d['name'] 	= self::sanitize($d['name'], 'text') == false ? '' : self::sanitize($d['name'], 'text');

			foreach ($d['range'] as  &$r) {

				$r 	= self::sanitize($r, 'text') == false ? '' : self::sanitize($r, 'text');
				//$r['endDate'] 		= self::sanitize($r['endDate'], 'text') == false ? '' : self::sanitize($r['endDate'], 'text');
			}
			unset($r);
		}
		unset($d);
	}
}
