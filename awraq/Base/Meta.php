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

			$fs = (Forms::oldest('wpcf7_contact_form')) ? Forms::oldest('wpcf7_contact_form') : (Forms::oldest('wpforms')) ?  Forms::oldest('wpforms') : (Forms::oldest('forminator_forms'))? Forms::oldest('forminator_forms') : (Forms::oldest('forminator_polls'))? Forms::oldest('forminator_polls') : (Forms::oldest('forminator_quizzes'))? Forms::oldest('forminator_quizzes') : 0;

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

		$options = array();
		foreach(AWRAQ_SUPPORTED_PLUGINS as $supportedPlugin){
			$options = array_merge($options,Forms::getForms($supportedPlugin['post_type']));
		}

		$row = array();
		foreach ($posts as $key => $post) {

			$postMeta = unserialize(get_post_meta($post->ID, 'aavoya_wraq_meta_key', true));

			$row[$key] = array(
				'id'		=> intval($post->ID),
				'title'		=> esc_html($post->post_title),
				'sc'		=> $postMeta['sc'],
				'fso'		=> array('selected' => $postMeta['fs'],'options'  => $options),
				'drawer'	=> $postMeta['drawer'],
				'formDrawer'=> $postMeta['formDrawer'],
			);
		
		}
		return $row;
	}

	public static function delete($id){
		
		delete_post_meta($id, 'aavoya_wraq_meta_key');
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
}