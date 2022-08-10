<?php

/**
 * This validation checks if required html inputs are submitted or not 
 */

namespace Awraq\Frontend\Form\Action;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Meta;


class Validation {
	public static function do($formID = null, $postData = null): bool {
		if ($formID == null or $postData == null) return false;
		$formMeta = Meta::getForm($formID);
		foreach ($formMeta as $inputMeta) {
			if (!array_key_exists($inputMeta['uniqueName'], $postData)) {
				if (in_array($inputMeta['type'], array('text', 'phone', 'textarea', 'email', 'checkbox', 'radio', 'file', 'date'))) {
					if ($inputMeta['data']['required'] == 1) return false;
				}
				if ($inputMeta['type'] == 'name') {
					if ($inputMeta['data']['Options'][0]['required'] == 1 || $inputMeta['data']['Options'][1]['required'] == 1 || $inputMeta['data']['Options'][2]['required'] == 1) return false;
				}
				if ($inputMeta['type'] == 'address') {
					if (
						$inputMeta['data']['Options'][0]['required'] == 1 ||
						$inputMeta['data']['Options'][1]['required'] == 1 ||
						$inputMeta['data']['Options'][3]['required'] == 1 ||
						$inputMeta['data']['Options'][4]['required'] == 1 ||
						$inputMeta['data']['Options'][5]['required'] == 1
					) {
						return false;
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
						if ($counter == 0) return false;
					}
				}
			}
		}

		return true;
	}
}
