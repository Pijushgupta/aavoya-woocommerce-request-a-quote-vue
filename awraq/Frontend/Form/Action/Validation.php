<?php

/**
 * This validation checks if required html inputs are submitted or not 
 */

namespace Awraq\Frontend\Form\Action;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Meta;


class Validation {
	public static function do($formID = null, $postData = null) {
		if ($formID == null or $postData == null) return false;
		$formMeta = Meta::getForm($formID);

		$validation_error =  array();
		foreach ($formMeta as $inputMeta) {
			if (in_array($inputMeta['type'], array('text', 'phone', 'textarea', 'email', 'checkbox', 'radio',  'date'))) {

				if ($inputMeta['data']['required'] == 1) {
					if (!array_key_exists($inputMeta['uniqueName'], $postData)) {
						array_push($validation_error, sanitize_text_field($inputMeta['uniqueName']));
					} else {
						// incase of checkbox, if nothing is selected, there will be no uniqueNamed array in $postData, Thus it will trigger above if statement.
						if ($inputMeta['type'] != 'checkbox') {
							if (strlen($postData[$inputMeta['uniqueName']][0]['data']) == 0) {
								array_push($validation_error, sanitize_text_field($inputMeta['uniqueName']));
							}
						}
					}
				}
			}
			if ($inputMeta['type'] == 'name' || $inputMeta['type'] == 'address') {
				$isRequired = 0;
				foreach ($inputMeta['data']['Options'] as  $d) {
					if ($d['required'] == 1) {
						$isRequired = 1;
					}
				}
				if ($isRequired == 1) {
					if (!array_key_exists($inputMeta['uniqueName'], $postData)) {
						array_push($validation_error, sanitize_text_field($inputMeta['uniqueName']));
					} else {
						foreach ($inputMeta['data']['Options'] as $k => $e) {
							if ($e['required'] == 1 && empty($postData[$inputMeta['uniqueName']][$k]['data'])) {
								array_push($validation_error, sanitize_text_field($inputMeta['uniqueName'] . '_' . $k));
							}
						}
					}
				}
			}
			if ($inputMeta['type'] == 'content') { /* Do nothing, its a read only */
			}
			if ($inputMeta['type'] == 'file') { // This validation happening before file sanitization 
				if ($inputMeta['data']['required'] == 1) {
					$counter = 0;
					foreach ($_FILES as $key => $file) {
						if ($inputMeta['uniqueName'] == $key) {
							$counter++;
						}
					}
					if ($counter == 0) {
						array_push($validation_error, sanitize_text_field($inputMeta['uniqueName']));
					}
				}
			}
		}


		if (!empty($validation_error)) {
			return $validation_error;
		} else {
			return true;
		}
	}
}
