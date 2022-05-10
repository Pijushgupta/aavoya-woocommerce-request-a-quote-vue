<?php

namespace Awraq\Frontend;
if(!defined('ABSPATH')) exit;
class Form {
	public static function create($formInputs,$id){
		$form ='<div>';
		$form .= '<form id="awraq-form-'.$id.'" class="awraq-form" action="'.admin_url('admin-post.php').'" method="post">';
		$form .= self::createAction();
		$form .= self::createCsfrProtection();
		$form .= self::createFormId($id);
		$form .= self::createBasicCssReset();
		foreach($formInputs as $key => $formInput ){
			
			switch($formInput['type']){
				case 'radio':
					$form .= self::createRadio($formInput,$key,$id);
					break;
				case 'checkbox':
					$form .= self::createCheckbox($formInput,$key,$id);
					break;
				case 'text':
					$form .= self::createText($formInput,$key,$id);
					break;
				case 'textarea':
					$form .= self::createTextArea($formInput,$key,$id);
					break;
				case 'email':
					$form .= self::createEmail($formInput,$key,$id);
					break;
				case 'file':
					$form .= self::createFile($formInput,$key,$id);
					break;
				
				default:
					break;
			}
		}
		$form .= self::createSubmit();
		$form .= '</form> </div>';

		return $form;
	}

	public static function createText($formInput,$key,$id){
		$form = '<div class="'.$formInput['data']['cssClass'].'"><div class="text">';
	 
		$form .= $formInput['data']['label'] ? '<label>' .$formInput['data']['label'].'</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="text" name="'.$id.$formInput['name'].$key.'"  placeholder="'.$formInput['data']['placeholder'].'" '.$required.'/><br>';
		$form .= '</div></div>';
		return $form;
	}

	public static function createTextArea($formInput,$key,$id){
		$form = '<div class="'.$formInput['data']['cssClass'].'"><div class="textarea">';
	 
		$form .= $formInput['data']['label'] ? '<label>' .$formInput['data']['label'].'</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<textarea  type="text" name="'.$id.$formInput['name'].$key.'"  placeholder="'.$formInput['data']['placeholder'].'" '.$required.'/></textarea><br>';
		$form .= '</div></div>';
		return $form;
	}

	public static function createRadio($formInput,$key,$id){
		$form = '<div class="'.$formInput['data']['cssClass'].'"><div class="radio">';
		$form .= '<label>'.$formInput['data']['label'].'</label>';
		foreach($formInput['data']['Options'] as $k => $v){
			$form .= '<input type="radio" id="'.$id.$formInput['name'].$k.'" name="'.$id.$formInput['name'].$key.'" value="'.$v['value'].'" style="margin-right:10px;"/>'.'<label for="'.$id.$formInput['name'].$k.'">'.$v['name'].'</label><br>';
		}
		$form .= '</div></div>';
		return $form;
	}

	public static function createCheckbox($formInput,$key,$id){
		$form = '<div class="'.$formInput['data']['cssClass'].'"><div class="checkbox">';
		$form .= '<label style="display:block;">'.$formInput['data']['label'].'</label>';
		foreach($formInput['data']['Options'] as $k => $v){
			$form .= '<input type="checkbox" id="'.$id.$formInput['name'].$k.'" name="'.$id.$formInput['name'].$k.'" value="'.$v['value'].'" style="margin-right:10px;"/>'.'<label for="'.$id.$formInput['name'].$k.'">'.$v['name'].'</label><br>';
		}
		$form .= '</div></div>';
		return $form;
	}

	public static function createEmail($formInput,$key,$id){
		$form = '<div class="'.$formInput['data']['cssClass'].'"><div class="email">';
	 
		$form .= $formInput['data']['label'] ? '<label for="'.$id.$formInput['name'].$key.'">' .$formInput['data']['label'].'</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="email" id="'.$id.$formInput['name'].$key.'" name="'.$id.$formInput['name'].$key.'"  placeholder="'.$formInput['data']['placeholder'].'" '.$required.'/><br>';
		$form .= '</div></div>';
		return $form;
	}

	public static function createFile($formInput,$key,$id){
		$form = '<div class="'.$formInput['data']['cssClass'].'"><div class="file">';
	 $acceptType = array();
	 foreach($formInput['data']['selectedFileType'] as $type){
		switch($type){
			case 'Image':
				array_push($acceptType,'.jpg','.png','.gif');
				break;
			case 'video':
				array_push($acceptType,'.mp4','.avi','.mov');
				break;
			case 'audio':
				array_push($acceptType,'.mp3','.wav','.ogg');
				break;
			case 'document':
				array_push($acceptType,'.pdf','.doc','.docx','.xls','.xlsx'.'.ppt','.pptx');
				break;
			case 'archive':
				array_push($acceptType,'.zip','.rar','.tar','.gz','.7z');
				break;
			case 'all':
				array_push($acceptType,'.jpg','.png','.gif','.mp4','.avi','.mov','.mp3','.wav','.ogg','.pdf','.doc','.docx','.xls','.xlsx'.'.ppt','.pptx','.zip','.rar','.tar','.gz','.7z');
				break;

			default:
				break;
			
		} 
		
	 }
	 	$acceptType = implode(",", array_unique($acceptType));
	 	/* Setting accept type with fallback accept type */
	  $acceptType = $acceptType == '' ? 'accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"' :'accept="'.$acceptType.'"';

		$form .= $formInput['data']['label'] ? '<label for="'.$id.$formInput['type'].$key.'">' .$formInput['data']['label'].'</label>' : '';

		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="file" id="'.$id.$formInput['type'].$key.'" name="'.$id.$formInput['type'].$key.'" '.$required.' '.$acceptType.' />';
		$form .= '</div></div>';
		return $form;
	}

	public static function createDate(){}

	public static function createCsfrProtection(){
	
		$csrf_input = '<input type="hidden" name="awraqf_nonce" value="'.	wp_create_nonce('awraqf_nonce').'"/>';
		return $csrf_input;

	}

	public static function createSubmit(){
		$form = '<div class="submit">';
		$form .= '<input type="submit" name="submit" value="Submit"/>';
		$form .= '</div>';
		return $form;
	}

	public static function createBasicCssReset(){
		$css 	= '<style>';
		$css .= '.file>label:first-child, .email>label:first-child, .textarea>label:first-child, .text>label:first-child, .radio>label:first-child, .checkbox>label:first-child{display:block; margin-top:10px;}';
		
		$css .= '</style>';
		return $css;
	}

	public static function createFormId($id){
		return '<input type="hidden" name="formPostId" value="'.$id.'">';
	}

	public static function createAction(){
		return '<input type="hidden" name="action" value="awraqfSubmit" />';
	}

}


