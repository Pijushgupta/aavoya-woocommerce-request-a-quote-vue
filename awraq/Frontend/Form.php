<?php

namespace Awraq\Frontend;

if (!defined('ABSPATH')) exit;


use Awraq\Frontend\Form\Essentials\Action;
use Awraq\Frontend\Form\Essentials\Csrfp;
use Awraq\Frontend\Form\Essentials\Token;
use Awraq\Frontend\Form\Essentials\Origin;
use Awraq\Frontend\Form\Essentials\Id;
use Awraq\Frontend\Form\Essentials\Css;
use Awraq\Frontend\Form\Essentials\Submit;
use Awraq\Frontend\Form\Essentials\Error;
use Awraq\Frontend\Form\Essentials\Gcaptcha;

use Awraq\Frontend\Form\Inputs\Radio;
use Awraq\Frontend\Form\Inputs\Checkbox;
use Awraq\Frontend\Form\Inputs\Text;
use Awraq\Frontend\Form\Inputs\Address;
use Awraq\Frontend\Form\Inputs\Name;
use Awraq\Frontend\Form\Inputs\Html;
use Awraq\Frontend\Form\Inputs\Phone;
use Awraq\Frontend\Form\Inputs\Textarea;
use Awraq\Frontend\Form\Inputs\Email;
use Awraq\Frontend\Form\Inputs\File;
use Awraq\Frontend\Form\Inputs\Date;

class Form {
	public static function create($formMeta, $id) {

		$oldValues = self::oldValues($id);

		$form = '<div>' . Error::show($id);
		$form .= '<form id="awraq-form-' . $id . '" class="awraq-form" action="' . admin_url('admin-post.php') . '" method="post" enctype="multipart/form-data">';
		$form .= Action::create();
		$form .= Csrfp::create();
		$form .= Token::create($id);
		$form .= Origin::create();
		$form .= Id::create($id);
		$form .= Gcaptcha::create($id);
		$form .= Css::create();

		foreach ($formMeta as $key => $inputMeta) {

			$oldValueAsParam = false;
			if ($oldValues != false) {

				foreach ($oldValues as $k => $oldvalue) {
					$uniqueKey = explode('_', $k);

					if ($inputMeta['uniqueName'] == $uniqueKey[0]) {
						$oldValueAsParam[$k] = $oldvalue;
						break;
					}
				}
			}

			switch ($inputMeta['type']) {
				case 'radio':
					$form .= Radio::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'checkbox':
					$form .= Checkbox::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'text':
					$form .= Text::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'name':
					$form .= Name::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'textarea':
					$form .= Textarea::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'email':
					$form .= Email::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'phone':
					$form .= Phone::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'file':
					$form .= File::create($inputMeta, $key, $id);
					break;
				case 'content':
					$form .= Html::create($inputMeta, $key, $id);
					break;
				case 'date':
					$form .= Date::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				case 'address':
					$form .= Address::create($inputMeta, $key, $id, $oldValueAsParam);
					break;
				default:
					break;
			}
		}
		$form .= count($formMeta) > 0 ? Submit::create($id) : '';
		$form .= '</form> </div>';
		return $form;
	}

	public static function oldValues($id) {
		$formOldValues = get_transient((string)($id . '-' . 'values-' . $_SERVER['REMOTE_ADDR']));
		if ($formOldValues != false) {
			delete_transient((string)($id . '-' . 'values-' . $_SERVER['REMOTE_ADDR']));
			return unserialize($formOldValues);
		}
		return false;
	}
}
