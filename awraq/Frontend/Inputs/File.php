<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class File {
	public static function create($formInput, $key, $id): string {
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="file mt-2">';

		/**
		 * declaring accept type variable to hold accept types
		 */
		$acceptType = array();

		foreach ($formInput['data']['selectedFileType'] as $type) {
			switch ($type) {
				case 'image':
					array_push($acceptType, '.jpg', '.png', '.gif');
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
					array_push($acceptType, '.jpg', '.png', '.gif', '.mp4', '.avi', '.mov', '.mp3', '.wav', '.ogg', '.pdf', '.doc', '.docx', '.xls', '.xlsx' . '.ppt', '.pptx', '.zip', '.rar', '.tar', '.gz', '.7z');
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
		 * Adding the input label if not empty
		 */
		$form .= $formInput['data']['label'] ? '<label for="' . $id . $formInput['type'] . $key . '">' . $formInput['data']['label'] . '</label>' : '';

		/**
		 * Adding "required" to input if not empty 
		 */
		$required = ($formInput['data']['required'] == true) ? 'required' : '';

		/**
		 * Adding the actual input , input type of form
		 */
		$form .= '<input type="file" id="' . $id . $formInput['type'] . $key . '" name="' . $id . $formInput['type'] . $key . '" ' . $required . ' ' . $acceptType . ' />';

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
