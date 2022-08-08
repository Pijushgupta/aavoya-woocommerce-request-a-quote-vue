<?php

namespace Awraq\Frontend\Form\Action;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Meta;

class Map {
	public static function check($formID, $post) {
		if (!$formID || !$post) return;

		/**
		 * Form creating bluepirnt
		 */
		$formMeta = Meta::getForm($formID);

		echo "<pre>";
		print_r($formMeta);
		echo "</pre>";
		var_dump($post);

		$sanitizedPostData = array();
		foreach ($post as $key => $input) {

			$inputArray = explode('_', $key);

			foreach ($formMeta as $inputMeta) {
				if ($inputMeta['uniqueName'] == $inputArray[0]) {
					if (count($inputArray) > 1) {
						if ($inputMeta['type'] == 'name') { //name type element 
							if ($inputMeta['data']['Options'][$inputArray[1]]['enabled'] != 1) return false; //Terminate everything - Possible hacking attempt 
							if ($inputMeta['data']['Options'][$inputArray[1]]['required'] == 1) { //checking if the field is required 
								if (empty($input) and $input != 0) return false; //if field is is required but with no data
							}
							$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['name'] = $inputMeta['data']['Options'][$inputArray[1]]['name'];
							$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['data'] = sanitize_text_field($input);
						}

						if ($inputMeta['type'] == 'checkbox') { // checkbox type element 

							if ($inputMeta['data']['Options'][$inputArray[1]]['required'] == 1) { //checking if the field is required 
								if (empty($input) and $input != 0) return false; //if field is is required but with no data
							}
							$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['name'] = $inputMeta['data']['Options'][$inputArray[1]]['name'];
							$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['data'] = sanitize_text_field($input);
						}

						if ($inputMeta['type'] == 'address') { // address type element 
							if ($inputMeta['data']['Options'][$inputArray[1]]['enabled'] != 1) return false; //Terminate everything - Possible hacking attempt 
							if ($inputMeta['data']['Options'][$inputArray[1]]['required'] == 1) { //checking if the field is required 
								if (empty($input) and $input != 0) return false; //if field is is required but with no data
							}
							$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['name'] = $inputMeta['data']['Options'][$inputArray[1]]['name'];
							$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['data'] = sanitize_text_field($input);
						}
					} else {
						$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['name'] = $inputMeta['name'];
						$sanitizedPostData[$inputMeta['uniqueName']][$inputArray[1]]['data'] = sanitize_text_field($input);
					}
				}
			}
		}
		var_dump($sanitizedPostData);
	}
}
