<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Date {

	public static $footerScript = '';
	public static $globalScopeName = 'Awraq\Frontend\Form\Inputs\Date';

	/**
	 * create
	 * creating datepicker field
	 * @param  mixed $formInput
	 * @param  mixed $key
	 * @param  mixed $id
	 * @return string
	 */
	public static function create($formInput, $key, $id, $oldValueAsParam): string {
		/**
		 *  $formInput['data']['dateType'] is either 1 or 0
		 *  $formInput['data']['dateData'] having two indexes, 0 or 1
		 *  index 0 for single date selector between dates
		 *  index 1 for range date selector between dates 
		 */
		$dateRange = (array)$formInput['data']['dateData'][$formInput['data']['dateType']];

		/**
		 * return empty string to php version < 8
		 * since mixed only supported in php 8 version >= 8 
		 */
		if (empty($dateRange['range'])) return '';



		$datepickerOptions = self::datepicker_options($dateRange);
		$formId = sanitize_text_field($formInput['uniqueName']);
		self::$footerScript = '<script>jQuery(\'input[name="' . $formId . '"]\').daterangepicker(' . $datepickerOptions . ')</script>';
		add_action('wp_footer', array(self::$globalScopeName, 'set_footer_script'), 9999);
		if(array_key_exists('cssClass',$formInput['data'])){
			$css = sanitize_html_class($formInput['data']['cssClass']);
		}else{
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="date mt-2">';
		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr($formId) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . '</label>' : '';
		$required = ($formInput['data']['required'] == true) ? 'required' : '';
		$form .= '<input type="text" id="' . esc_attr($formId) . '" name="' . esc_attr($formId) . '" ' . $required . '/>';
		$form .= '</div></div>';

		/**
		 * enqueuing scripts and style for datepicker's client side code 
		 */
		self::enqueue_assets();

		return $form;
	}


	/**
	 * enqueue_assets
	 * Enqueuing scripts for datepicker field(s) 
	 * @param void
	 * @return void
	 */
	public static function enqueue_assets(): void {

		/**
		 * checking if jQuery enqueued or not 
		 * if enqueued don't add it 
		 */
		global $wp_scripts, $wp_styles;

		/**
		 * adding jquery for not so edge cases 
		 */

		if (!in_array('jquery', $wp_scripts->queue)) {
			wp_enqueue_script('jquery', AWRAQ_REL . '/awraq/Frontend/client/jquery.min.css', array(), '3.2.1', true);
		}

		/**
		 * adding moment js
		 */
		if (!in_array('moment-js', $wp_scripts->queue)) {
			wp_enqueue_script('moment-js', AWRAQ_REL . '/awraq/Frontend/client/moment.min.js', array('jquery'), '1', true);
		}

		/**
		 * adding datepicker js
		 */
		if (!in_array('datepicker-js', $wp_scripts->queue)) {
			wp_enqueue_script('datepicker-js', AWRAQ_REL . '/awraq/Frontend/client/daterangepicker.min.js', array('jquery'), '1', true);
		}

		/**
		 * adding datepicker 
		 */
		if (!in_array('datepicker-css', $wp_styles->queue)) {
			wp_enqueue_style('datepicker-css', AWRAQ_REL . '/awraq/Frontend/client/daterangepicker.css', array(), '1', 'all');
		}
	}

	/**
	 * datepicker_options
	 * Creating options required for datepicker client-side code 
	 * @param  mixed $dateRange
	 * @return string
	 */
	public static function datepicker_options($dateRange): string {
		$singleDatePicker = '';
		$minDate = '';
		$maxDate = '';

		if ($dateRange['name'] == 'Simple') {
			$singleDatePicker = true;
		}
		if ($dateRange['name'] == 'Range') {
			$singleDatePicker = false;
		}

		if (gettype($singleDatePicker) == 'string') return '';

		/**
		 * Starting Date in Range
		 * removing the time (T)
		 * storing only first(0) index
		 */
		$minDate = (string)explode('T', $dateRange['range'][0])[0];
		$minDate = explode('-', $minDate);
		$minDate = implode('-', array($minDate[1], $minDate[2], $minDate[0]));


		/**
		 * Ending Date in Range
		 * removing the time (T)
		 * storing only first(0) index
		 */
		$maxDate = (string)explode('T', $dateRange['range'][1])[0];
		$maxDate = explode('-', $maxDate);
		$maxDate = implode('-', array($maxDate[1], $maxDate[2], $maxDate[0]));



		/**
		 * Creating the Options for Datepicker 
		 */
		$options = array(
			'singleDatePicker' => $singleDatePicker,
			'showDropdowns'	=> true,
			'minDate' => $minDate,
			'maxDate' => $maxDate
		);

		return json_encode($options);
	}

	public static function set_footer_script(): void {
		echo self::$footerScript; // do not sanitize it. Output is javaScript 
	}
}
