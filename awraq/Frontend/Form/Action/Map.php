<?php

/**
 * This class is responsible for mapping and sanitizing form data with blueprint(form meta)
 */

namespace Awraq\Frontend\Form\Action;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Meta;

class Map {

	/**
	 * check
	 *
	 * @param  mixed $formID
	 * @param  mixed $post
	 * @return void
	 */
	public static function check($formID, $post) {
		if (!$formID || !$post) return;

		/**
		 * Form creating bluepirnt
		 */
		$formMeta = Meta::getForm($formID);

		/**
		 * Declaring empty variable of array type store post data 
		 */
		$mappedPostData = array();

		/**
		 * Looping through posted data
		 */
		foreach ($post as $key => $input) {

			/**
			 * exploding post element key, to check if its a nested element or not. 
			 * nested element , name="name-0_0" will be array(0=>'text-0',1=>'0') after exploding.
			 * by the second index, will can assume that its a nested element and next sibling element is about to come
			 * and put all the elements in a associated array  
			 */
			$inputArray = explode('_', $key);

			/**
			 * Looping through form meta.
			 * Form meta used as verification blueprint 
			 */
			foreach ($formMeta as $inputMeta) {

				if ($inputMeta['uniqueName'] == $inputArray[0]) {
					/**
					 * checking inputArray index,
					 * if its more than 1, its a nested html element 
					 */
					if (count($inputArray) > 1) {
						/**
						 * elements that can only have nested html data
						 */
						if ($inputMeta['type'] == 'name' || $inputMeta['type'] == 'address' || $inputMeta['type'] == 'checkbox') { //name type element 

							/**
							 * Terminate everything - Possible hacking attempt 
							 * since its a indication of new field that is not generated form server 
							 */
							if (!$inputMeta['data']['Options'][$inputArray[1]]) return false;

							/**
							 * creating exception for checkbox, it will not have enable/disable option 
							 */
							if ($inputMeta['type'] != 'checkbox') {
								if ($inputMeta['data']['Options'][$inputArray[1]]['enabled'] != 1) return false;
							}

							/**
							 * setting array index to store the data 
							 */
							$mappedPostData[$inputMeta['uniqueName']][$inputArray[1]]['name'] = $inputMeta['data']['Options'][$inputArray[1]]['name'];

							/**
							 * saving the data after basic sanitization 
							 */
							$mappedPostData[$inputMeta['uniqueName']][$inputArray[1]]['data'] = $input;
						}
					} else {
						/**
						 * Saving data for non nested html inputs 
						 */

						$mappedPostData[$inputMeta['uniqueName']][0]['name'] = $inputMeta['name'];
						$mappedPostData[$inputMeta['uniqueName']][0]['data'] = $input;
					}
				}
			}
		}

		return self::sanitizedPostData($mappedPostData, $formMeta);
	}

	/**
	 * sanitizedPostData
	 *
	 * @param  mixed $postdata
	 * @param  mixed $formMeta
	 * @return mixed
	 */
	public static function sanitizedPostData($postdata = null, $formMeta = null) {
		/**
		 * return if no argument provided 
		 */
		if ($postdata == null || $formMeta == null) return false;

		/**
		 * looping through submitted data after nesting
		 */
		foreach ($postdata as $key => &$inputs) {
			/**
			 * exploding key(name-0, textarea-1)
			 * after exploding it will be array('0'=>'name','1'=>'0')
			 * so we can use the index 0 to determine the type of data  
			 * and apply appropriate sanitization
			 */
			$type = explode('-', $key);

			/**
			 * Again looping through the input. Since, inputs are now nested. 
			 * Even inputs with a singular data are also nested with index 0
			 */
			foreach ($inputs as &$input) {

				/**
				 * Sanitizing input name 
				 */
				$input['name'] = sanitize_text_field($input['name']);

				/**
				 * If input type is text 
				 * Sanitizing with wordpress's sanitization method 
				 */
				if (in_array($type[0], array('text', 'name', 'address', 'textarea', 'checkbox', 'radio', 'date'))) {
					$input['data'] = sanitize_text_field($input['data']);
				}

				/**
				 * if input type is email
				 * Sanitizing with Wordpress's sanitization method
				 */
				if (in_array($type[0], array('email'))) {
					$input['data'] = sanitize_email($input['data']);
				}



				if (in_array($type[0], array('phone'))) {
					$input['data'] = sanitize_text_field(preg_replace('/[^0-9]/', '', $input['data']));
				}
			}
			unset($input);
		}
		unset($inputs);
		return $postdata;
	}

	public static function file($filesArray = null, $formID = null) {
		/**
		 * Basic argument check
		 */
		if ($filesArray == null || $formID == null) return false;

		/**
		 * getting form meta
		 */
		$formMeta = Meta::getForm($formID);
		if (!$formMeta) return false;
		echo '<pre>';
		print_r($formMeta);
		echo '</pre>';
		foreach ($filesArray as $key => $fileArray) {
			$counter = 0;
			foreach ($formMeta as $inputMeta) {
				if ($inputMeta['uniqueName'] == $key) {
					$counter++;
					// if (self::sanitizeFile($inputMeta, $fileArray) == false) {
					// 	return false;
					// }
				}
			}
			if ($counter == 0) return false;
		}
	}
	public static function sanitizeFile($inputMeta = null, $fileArray = null) {
		if ($inputMeta == null || $fileArray == null) return false;

		//get allowed filetype
		$selectedFileTypes = $inputMeta['data']['selectedFileType'];
		$fileTypeArray = array();
		foreach ($selectedFileTypes as $key => $selectedFileType) {
			if ($selectedFileType['type'] == 'all') {
				array_push($fileTypeArray, '.jpg', '.png', '.gif', '.mp4', '.avi', '.mov', '.mp3', '.wav', '.ogg', '.pdf', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.zip', '.rar', '.7z', '.tar', '.gz');
				break;
			} else {
				if ($selectedFileType['type'] == 'image') {
					array_push($fileTypeArray, '.jpg', '.png', '.gif');
				}
				if ($selectedFileType['type'] == 'video') {
					array_push($fileTypeArray, '.mp4', '.avi', '.mov');
				}
				if ($selectedFileType['type'] == 'audio') {
					array_push($fileTypeArray, '.mp3', '.wav', '.ogg');
				}
				if ($selectedFileType['type'] == 'document') {
					array_push($fileTypeArray, '.pdf', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx');
				}
				if ($selectedFileType['type'] == 'archive') {
					array_push($fileTypeArray, '.zip', '.rar', '.7z', '.tar', '.gz');
				}
			}
		}
		$fileTypeArray = array_unique($fileTypeArray);
		//create mime types

		//check filetype 

		//upload the file 

		//check return of uploaded for error 
		//on success add the url with file unique name in post array
		//

	}
}
