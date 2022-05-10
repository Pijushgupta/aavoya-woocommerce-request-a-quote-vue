<?php 

namespace Awraq\Base;

if(!defined('ABSPATH')) exit;

use Awraq\Thirdparty\Forms;

class Meta {
	
	public static function addDefault($id = false){
		
		if($id == false) return;
		$id = intval($id);

		$metastyle = unserialize(get_option('aavoya_wraq_global_settings',null));

		if($metastyle != null){


			if(Forms::oldest('wpcf7_contact_form')){

				$fs = Forms::oldest('wpcf7_contact_form');

			}elseif(Forms::oldest('wpforms')){

				$fs = Forms::oldest('wpforms');

			}elseif(Forms::oldest('forminator_forms')){

				$fs = Forms::oldest('forminator_forms');

			}elseif(Forms::oldest('forminator_polls')){

				$fs = Forms::oldest('forminator_polls');

			}elseif(Forms::oldest('forminator_quizzes')){

				$fs = Forms::oldest('forminator_quizzes');

			}else{
				
				$fs = 0;
			}

			$meta = serialize(array(
				'sc'		=> '[awraq id="'.$id.'"]',
				'fs'		=> $fs,
				'drawer'	=> $metastyle['drawer'],
				'formDrawer'=> $metastyle['formDrawer']

			));
			update_post_meta($id, 'aavoya_wraq_meta_key', $meta);
		}
	}

	public static function get($posts){

		/* For simple ID to meta instead of POST(array of object) */
		if(gettype($posts) != 'array'){

			/* return will terminate the flow */
			return unserialize(get_post_meta($posts, 'aavoya_wraq_meta_key', true));
		}
		/* ends */

		$options = array();
		foreach(AWRAQ_SUPPORTED_PLUGINS as $supportedPlugin){
			$options = array_merge($options,Forms::getForms($supportedPlugin['post_type']));
		}
		

		$row = array();
		foreach ($posts as $key => $post) {

			$postMeta = unserialize(get_post_meta($post->ID, 'aavoya_wraq_meta_key', true));

			$row[$key] = array(
				'id'				=> intval($post->ID),
				'title'			=> esc_html($post->post_title),
				'sc'				=> $postMeta['sc'],
				'fso'				=> array('selected' => $postMeta['fs'],'options'  => $options),
				'drawer'		=> $postMeta['drawer'],
				'formDrawer'=> $postMeta['formDrawer'],
			);
		
		}
		return $row;
	}

	public static function getProduct($id = null){
		if($id === null) return false;
		$id = intval($id);
		return unserialize(get_post_meta($id, '_awraq_button_data', true));
	}

	public static function getForm($id = null){
		if($id === null) return false;
		$id = intval($id);
		return unserialize(get_post_meta($id, '_awraq_form_data', true));
	}

	public static function delete($id){
		
		delete_post_meta($id, 'aavoya_wraq_meta_key');
	}

	public static function deleteForm($id){
		
		delete_post_meta($id, '_awraq_form_data');
	}

	public static function update($id = null, $title = '',$sc,$fso,$drawer,$formDrawer){
		if($id == null) return false;
		$postMeta = array(
			'sc'		=> $sc,
			'fs'		=> $fso,
			'drawer'	=> $drawer,
			'formDrawer'=> $formDrawer
		);

		
		return update_post_meta($id , 'aavoya_wraq_meta_key', serialize($postMeta));
	}

	public static function updateProduct($id = null, $data){
		if($id == null) return false;
		$id = intval($id);
		return update_post_meta($id , '_awraq_button_data', serialize($data));
	}

	public static function updateForm($id = null, $data){
		if($id == null) return false;
		$id = intval($id);
		return update_post_meta($id , '_awraq_form_data', serialize($data));
	}
}