<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Meta;

class Error {
	public static function show($id = null) {
		if ($id == null) return;
		$formValidatinErrors = get_transient((string)($id . '-' . 'errors-' . $_SERVER['REMOTE_ADDR']));

		if ($formValidatinErrors != false) {
			$formValidatinErrors = unserialize($formValidatinErrors);
			delete_transient((string)($id . '-' . 'errors-' . $_SERVER['REMOTE_ADDR']));
			return self::prepareErrorMsg($id, $formValidatinErrors);
		}

		return '';
	}
	public static function prepareErrorMsg($id, $formValidatinErrors) {

		$formMeta = Meta::getForm($id);
		$html = '<div class="input-waring">';
		foreach ($formValidatinErrors as $k => $d) {
			$key = explode('_', $d);

			foreach ($formMeta as $inputMeta) {

				if ($inputMeta['uniqueName'] == $key[0]) {

					if ($key[1]) {
						if (strlen($inputMeta['data']['Options'][$key[1]]['label']) > 0) {
							$html .= '<div class="validation-error-msg">' . __($inputMeta['data']['Options'][$key[1]]['label'], AWRAQ_TEXT_DOMAIN) . ' is required. </div>';
						} else {
							$html .= '<div class="validation-error-msg">' . __($inputMeta['data']['Options'][$key[1]]['name'], AWRAQ_TEXT_DOMAIN) . ' is required. </div>';
						}
						$target = $inputMeta['data']['Options'][$key[1]]['name'];
						$html .= '<style> body [name="' . $inputMeta['uniqueName'] . '_' . $key[1] . '"]{' . apply_filters('validation_error_css', 'border:1px solid red;') . '}</style>';
					} else {
						if (strlen($inputMeta['data']['label']) > 0) {
							$html .= '<div class="validation-error-msg">' . __($inputMeta['data']['label'], AWRAQ_TEXT_DOMAIN) . ' is required </div>';
						} else {
							$html .= '<div class="validation-error-msg">' . __($inputMeta['name'], AWRAQ_TEXT_DOMAIN) . 'is required </div>';
						}
						$html .= '<style> body [name="' . $inputMeta['uniqueName'] . '"]{' . apply_filters('validation_error_css', 'border:1px solid red;') . '}</style>';
					}
				}
			}
		}
		$html .= '</div>';
		return $html;
	}
}
