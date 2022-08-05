<?php

namespace Awraq\Frontend;

if (!defined('ABSPATH')) exit;


use Awraq\Frontend\Form\Essentials\Action;
use Awraq\Frontend\Form\Essentials\Csrfp;
use Awraq\Frontend\Form\Essentials\Token;
use Awraq\Frontend\Form\Essentials\Id;
use Awraq\Frontend\Form\Essentials\Css;
use Awraq\Frontend\Form\Essentials\Submit;

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
	public static function create($formInputs, $id) {
		$form = '<div><form id="awraq-form-' . $id . '" class="awraq-form" action="' . admin_url('admin-post.php') . '" method="post">';
		$form .= Action::create();
		$form .= Csrfp::create();
		$form .= Token::create($id);
		$form .= Id::create($id);
		$form .= Css::create();
		foreach ($formInputs as $key => $formInput) {

			switch ($formInput['type']) {
				case 'radio':
					$form .= Radio::create($formInput, $key, $id);
					break;
				case 'checkbox':
					$form .= Checkbox::create($formInput, $key, $id);
					break;
				case 'text':
					$form .= Text::create($formInput, $key, $id);
					break;
				case 'name':
					$form .= Name::create($formInput, $key, $id);
					break;
				case 'textarea':
					$form .= Textarea::create($formInput, $key, $id);
					break;
				case 'email':
					$form .= Email::create($formInput, $key, $id);
					break;
				case 'phone':
					$form .= Phone::create($formInput, $key, $id);
					break;
				case 'file':
					$form .= File::create($formInput, $key, $id);
					break;
				case 'content':
					$form .= Html::create($formInput, $key, $id);
					break;
				case 'date':
					$form .= Date::create($formInput, $key, $id);
					break;
				case 'address':
					$form .= Address::create($formInput, $key, $id);
					break;
				default:
					break;
			}
		}
		$form .= count($formInputs) > 0 ? Submit::create() : '';
		$form .= '</form> </div>';

		return $form;
	}
}
