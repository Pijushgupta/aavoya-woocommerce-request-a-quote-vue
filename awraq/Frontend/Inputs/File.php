<?php

namespace Awraq\Frontend\Inputs;

if (!defined('ABSPATH')) exit;

class File
{
	public static function create($formInput, $key, $id)
	{
		$form = '<div class="' . $formInput['data']['cssClass'] . '"><div class="file">';
		$acceptType = array();
		foreach ($formInput['data']['selectedFileType'] as $type) {
			switch ($type) {
				case 'Image':
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
		$acceptType = implode(",", array_unique($acceptType));
		/* Setting accept type with fallback accept type */
		$acceptType = $acceptType == '' ? 'accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"' : 'accept="' . $acceptType . '"';

		$form .= $formInput['data']['label'] ? '<label for="' . $id . $formInput['type'] . $key . '">' . $formInput['data']['label'] . '</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="file" id="' . $id . $formInput['type'] . $key . '" name="' . $id . $formInput['type'] . $key . '" ' . $required . ' ' . $acceptType . ' />';
		$form .= '</div></div>';
		return $form;
	}
}
