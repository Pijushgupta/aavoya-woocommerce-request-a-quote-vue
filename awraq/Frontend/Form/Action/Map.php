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
			//echo $inputArray[0];
			foreach ($formMeta as $inputMeta) {
				if ($inputMeta['uniqueName'] == $inputArray[0]) {

					if (!in_array($inputMeta['uniqueName'], $sanitizedPostData)) {
						array_push($sanitizedPostData, array($inputMeta['uniqueName'] => array())); //creating new array element to hold data
					}


					if (count($inputArray) > 1) {
						if ($inputMeta['type'] == 'name') { //name type element 
							if ($inputMeta['data']['Options'][$inputArray[1]]['enabled'] != 1) return false; //Terminate everything - Possible hacking attempt 
							if ($inputMeta['data']['Options'][$inputArray[1]]['required'] == 1) { //checking if the field is required 
								if (empty($input) and $input != 0) return false; //if field is is required but with no data
							}
							sanitize_text_field($input);
						}

						if ($inputMeta['type'] == 'checkbox') { // checkbox type element 

						}

						if ($inputMeta['type'] == 'address') { // address type element 

						}
						echo '<pre>';
						print_r($inputArray);
						echo '</pre>';
					}
				}
			}
		}
	}
}
