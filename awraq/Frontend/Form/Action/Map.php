<?php

/**
 * This class is responsible for mapping and sanitizing form data with blueprint(form meta)
 */

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

				/**
				 * if input type is file
				 * sanitizing file name with wordpress's sanitization method 
				 * And checking allowed file type with file extension  with uploaded file
				 */
				if (in_array($type[0], array('file'))) {
					$input['data'] = sanitize_file_name($input['data']);
					foreach ($formMeta as $inputMeta) {
						if ($inputMeta['uniqueName'] == $key) {
							$selectedFileTypes = $inputMeta['data']['selectedFileType'];
							$extensionList = array();
							if (in_array('all', $selectedFileTypes)) {
								array_push($extensionList, '.jpg', '.png', '.gif', '.mp4', '.avi', '.mov', '.mp3', '.wav', '.ogg', '.pdf', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.zip', '.rar', '.7z', '.tar', '.gz');
							} else {
								if (in_array('image', $selectedFileTypes)) {
									array_push($extensionList, '.jpg', '.png', '.gif');
								}
								if (in_array('video', $selectedFileTypes)) {
									array_push($extensionList, '.mp4', '.avi', '.mov');
								}
								if (in_array('audio', $selectedFileTypes)) {
									array_push($extensionList, '.mp3', '.wav', '.ogg');
								}
								if (in_array('document', $selectedFileTypes)) {
									array_push($extensionList, '.pdf', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx');
								}
								if (in_array('archive', $selectedFileTypes)) {
									array_push($extensionList, '.zip', '.rar', '.7z', '.tar', '.gz');
								}
							}
							$fileExtension = explode('.', $input['data']);
							$fileExtension = $fileExtension[count($fileExtension) - 1];
							$fileExtension = '.' . $fileExtension;

							if (!in_array($fileExtension, $extensionList)) {
								return false;
							}
							break;
						}
					}
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
}
