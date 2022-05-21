<?php

namespace Awraq\Frontend;

if (!defined('ABSPATH')) exit;


use Awraq\Frontend\Essentials\Action;
use Awraq\Frontend\Essentials\Csrfp;
use Awraq\Frontend\Essentials\Id;
use Awraq\Frontend\Essentials\Css;
use Awraq\Frontend\Essentials\Submit;

use Awraq\Frontend\Inputs\Radio;
use Awraq\Frontend\Inputs\Checkbox;
use Awraq\Frontend\Inputs\Text;
use Awraq\Frontend\Inputs\Address;
use Awraq\Frontend\Inputs\Name;
use Awraq\Frontend\Inputs\Html;
use Awraq\Frontend\Inputs\Textarea;
use Awraq\Frontend\Inputs\Email;
use Awraq\Frontend\Inputs\File;
use Awraq\Frontend\Inputs\Date;

class Form
{
	public static function create($formInputs, $id)
	{
		$form = '<div><form id="awraq-form-' . $id . '" class="awraq-form" action="' . admin_url('admin-post.php') . '" method="post">';
		$form .= Action::create();
		$form .= Csrfp::create();
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
