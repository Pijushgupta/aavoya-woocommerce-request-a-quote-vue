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
	 * @return void|bool
	 */
	public static function check($formID, $post) {
		if (!$formID || !$post) return;

		/**
		 * Form creating blueprint
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

	public static function file($filesArray = null, $formID = null, $allowedPostSize = null) {
		/**
		 * Basic argument check
		 */
		if ($filesArray == null || $formID == null || $allowedPostSize == null) return false;

		/**
		 * getting form meta
		 */
		$formMeta = Meta::getForm($formID);
		if (!$formMeta) return false;

		foreach ($filesArray as $key => $fileArray) {
			/**
			 * this counter become positive in case uploaded file input name 
			 * matches with form meta. 
			 * Otherwise someone trying to upload a file to input field that is not 
			 * defined in backend form 
			 */
			$counter = 0;

			$fileArrayAfterUpload = array();
			foreach ($formMeta as $inputMeta) {
				if ($inputMeta['uniqueName'] == $key) {
					/**
					 * Cehcking uploaded file size is bigger than the allowed size
					 */
					if ($allowedPostSize < $fileArray['size']) return false;

					$counter++;
					/**
					 * Sending the file for sanitization and upload  
					 */
					$fileStatus = self::sanitizeFileAndUpload($inputMeta, $fileArray);

					/**
					 * if sanitization or upload fail return false  
					 */
					if ($fileStatus == false) return false;

					/**
					 * Storing file URL and Name after upload 
					 */
					$fileArrayAfterUpload[$key] = $fileStatus;
				}
			}
			if ($counter == 0) return false;
			return $fileArrayAfterUpload;
		}
	}
	/**
	 * sanitizeFileAndUpload
	 *
	 * @param  array $inputMeta
	 * @param  array $fileArray
	 * @return array
	 */
	public static function sanitizeFileAndUpload($inputMeta = null, $fileArray = null) {
		if ($inputMeta == null || $fileArray == null) return false;

		//get allowed filetype
		$selectedFileTypes = $inputMeta['data']['selectedFileType'];
		$fileTypeArray = array();
		foreach ($selectedFileTypes as $key => $selectedFileType) {
			if ($selectedFileType == 'all') {
				array_push($fileTypeArray, '.jpg', '.png', '.gif', '.mp4', '.avi', '.mov', '.mp3', '.wav', '.ogg', '.pdf', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.zip', '.rar', '.7z', '.tar', '.gz');
				break;
			} else {
				if ($selectedFileType == 'image') {
					array_push($fileTypeArray, '.jpg', '.png', '.gif');
				}
				if ($selectedFileType == 'video') {
					array_push($fileTypeArray, '.mp4', '.avi', '.mov');
				}
				if ($selectedFileType == 'audio') {
					array_push($fileTypeArray, '.mp3', '.wav', '.ogg');
				}
				if ($selectedFileType == 'document') {
					array_push($fileTypeArray, '.pdf', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx');
				}
				if ($selectedFileType == 'archive') {
					array_push($fileTypeArray, '.zip', '.rar', '.7z', '.tar', '.gz');
				}
			}
		}
		$fileTypeArray = array_unique($fileTypeArray);

		//create mime types
		$mimeTypeAssocArray = array(
			'.jpg' => 'image/jpeg',
			'.jpeg' => 'image/jpeg',
			'.png' => 'image/png',
			'.gif' => 'image/gif',
			'.mp4' => 'video/mp4',
			'.avi' => 'video/x-msvideo',
			'.mov' => 'video/quicktime',
			'.mp3' => 'audio/mpeg',
			'.wav' => 'audio/wav',
			'.ogg' => 'audio/ogg',
			'.pdf' => 'application/pdf',
			'.doc' => 'application/msword',
			'.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'.xls' => 'application/vnd.ms-excel',
			'.xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'.ppt' => 'application/vnd.ms-powerpoint',
			'.pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			'.zip' => 'application/zip',
			'.rar' => 'application/vnd.rar',
			'.7z' => 'application/x-7z-compressed',
			'.tar' => 'application/x-tar',
			'.gz' => 'application/gzip'
		);
		$supportedMimeTypes = array();
		foreach ($fileTypeArray as $fileType) {
			$supportedMimeTypes[substr($fileType, 1, strlen($fileType))] =   $mimeTypeAssocArray[$fileType];
		}


		/**
		 * check filetype/name  
		 * wp_check_filetype() , it returns file extension and type in case of mached mime type 
		 * else, array('ext' => false , 'type' => false) 
		 */
		$fileInfo = wp_check_filetype(basename($fileArray['name']), $supportedMimeTypes);
		if ($fileInfo['ext'] == false) return false;

		//upload the file 
		$uploadMime = array($fileInfo['ext'] => $fileInfo['type']);
		$fileResult = wp_handle_upload($fileArray, array(
			'test_form' => false,
			'mimes' => $uploadMime
		), null);

		//check file error 
		if (array_key_exists('error', $fileResult)) {
			return false;
		}

		//on success add the url with file unique name in post array
		return array(
			'name' =>  basename($fileResult['file']),
			'data' => $fileResult['url']
		);
	}
}
