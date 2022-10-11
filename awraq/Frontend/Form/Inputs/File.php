<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class File {
	public static function create($formInput, $key, $id): string {
		/**
		 * Checking if custom css class Provided or not
		 */
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}

		$form = '<div class="' . $css . '"><div class="aavoyafile aavoyamt-2">';

		/**
		 * declaring accept type variable to hold accept types
		 */
		$acceptType = array();

		foreach ($formInput['data']['selectedFileType'] as $type) {
			switch ($type) {
				case 'image':
					array_push($acceptType, '.jpg', '.jpeg', '.png', '.gif');
					break;
				case 'video':
					array_push($acceptType, '.mp4', '.avi', '.mov');
					break;
				case 'audio':
					array_push($acceptType, '.mp3', '.wav', '.ogg');
					break;
				case 'document':
					array_push($acceptType, '.pdf', '.doc', '.docx', '.xls', '.xlsx' . '.ppt', '.pptx');
					break;
				case 'archive':
					array_push($acceptType, '.zip', '.rar', '.tar', '.gz', '.7z');
					break;
				case 'all':
					array_push($acceptType, '.jpg', '.jpeg', '.png', '.gif', '.mp4', '.avi', '.mov', '.mp3', '.wav', '.ogg', '.pdf', '.doc', '.docx', '.xls', '.xlsx' . '.ppt', '.pptx', '.zip', '.rar', '.tar', '.gz', '.7z');
					break;
				default:
					break;
			}
		}
		/**
		 * Joining accept types together 
		 */
		$acceptType = implode(",", array_unique($acceptType));

		/** 
		 * Setting accept type with fallback accept type 
		 */
		$acceptType = $acceptType == '' ? 'accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"' : 'accept="' . $acceptType . '"';

		/**
		 * Adding "required" to input if not empty 
		 */
		$required = ($formInput['data']['required'] == true) ? 'required' : '';

		/**
		 * Adding the input label if not empty
		 */
		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($id . $formInput['type'] . $key) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . ($required != "" ? " (*)" : "") . '</label>' : '';


		/**
		 * Adding the actual input , input type of form
		 */
		$form .= '<input type="file" id="' . esc_attr($id . $formInput['type'] . $key) . '" name="' . esc_attr($formInput['uniqueName']) . '" ' . esc_attr($required) . ' ' . sanitize_text_field($acceptType) . ' />';

		/**
		 * Closing the tags
		 */
		$form .= '</div></div>';

		/**
		 * returning the html
		 */
		return $form;
	}
}
