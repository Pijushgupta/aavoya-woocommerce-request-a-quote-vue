<?php 

namespace Awraq\Thirdparty;

if(!defined('ABSPATH')) exit;



class Forms{
	
	/**
	 * suppoetedForms
	 * Will Return the Title of the supported form 
	 * @param  string $postType
	 * @return mixed string/boolean
	 */
	public static function supportedForms($postType = null){
		if($postType == null) return;
		$title = false ;

		foreach (AWRAQ_SUPPORTED_PLUGINS as $supportedPlugin) {
			if($supportedPlugin['post_type'] == $postType){
				$title = $supportedPlugin['name'];
			}	
		}
		return $title;	
	}
		
	/**
	 * isInstalled
	 * Checking if the specific form plugin is active or not form its POST TYPE
	 * @param  mixed $postType
	 * @return boolean
	 */
	public static function isInstalled($postType = null){

		if($postType == null) return false;

		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		
		foreach(AWRAQ_SUPPORTED_PLUGINS as $supportedPlugin){

			if($supportedPlugin['post_type'] == $postType){
				return is_plugin_active($supportedPlugin['plugin_dir']);
			}	
		}	
	}


	public static function getForms($type = null){
		if($type == null) return false;

	

		/**
		 * checking if form plugin is supported or not 
		 */
		$titleText = self::supportedForms($type);

		if(!$titleText) return false;

		$forms = get_posts(array(
			'post_type' => $type,
			'posts_per_page' => -1
		));

		$formsFormatted = array();

		foreach ($forms as $key => $value) {
			$formsFormatted[$key]['id'] = intval($value->ID);
			$formsFormatted[$key]['title'] = esc_html($titleText) .' - ' . esc_html($value->post_title);
		}

		return $formsFormatted;
	}
	
	/**
	 * oldest
	 * Returns the oldest form id among all the forms
	 * @param  mixed $type
	 * @return void
	 */
	public static function oldest($type = null){
		if($type == null) return;
		 
		$formsFormatted = self::getForms($type); 

		if(!$formsFormatted) return false;

		$formIds = array();

		foreach($formsFormatted as $values){
			$formIds[$values['id']] = $values['title'];
		}
		
		ksort($formIds, SORT_NUMERIC);

		$firstKey = '';

		if (function_exists('array_key_first')) {

			$firstKey = array_key_first($formIds);

		} else {
	
			foreach ($formIds as $key => $formId) {

				$firstKey = $key;

				break;

			}
		}
	
		return intval($firstKey);
	}
}