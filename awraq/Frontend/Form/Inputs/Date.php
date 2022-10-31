<?php

namespace Awraq\Frontend\Form\Inputs;

if (!defined('ABSPATH')) exit;

class Date {
	public static $formID = '';
	public static $dateRange = '';

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


		self::$dateRange = $dateRange;

		self::$formID = sanitize_text_field($formInput['uniqueName']);

		add_action('wp_footer', function(){
			$singleDatePicker = '';
			$minDate = '';
			$maxDate = '';

			if (self::$dateRange['name'] == 'Simple') {
				$singleDatePicker = true;
			}
			if (self::$dateRange['name'] == 'Range') {
				$singleDatePicker = false;
			}

			if (gettype($singleDatePicker) == 'string') return '';

			/**
			 * Starting Date in Range
			 * removing the time (T)
			 * storing only first(0) index
			 */
			$minDate = (string)explode('T', self::$dateRange['range'][0])[0];
			$minDate = explode('-', $minDate);
			$minDate = implode('-', array($minDate[1], $minDate[2], $minDate[0]));


			/**
			 * Ending Date in Range
			 * removing the time (T)
			 * storing only first(0) index
			 */
			$maxDate = (string)explode('T', self::$dateRange['range'][1])[0];
			$maxDate = explode('-', $maxDate);
			$maxDate = implode('-', array($maxDate[1], $maxDate[2], $maxDate[0]));

			?>
			<script>
				jQuery('input[name="<?php echo esc_attr(self::$formID); ?>"]').daterangepicker({
                    'singleDatePicker': <?php echo $singleDatePicker == true ? 'true' : 'false';  ?>,
                    'showDropdowns': true,
                    'minDate': '<?php echo esc_attr($minDate); ?>',
                    'maxDate': '<?php echo esc_attr($maxDate); ?>',
                    'timePicker': false,
                    'locale':{
                        'format':'M/DD/YYYY'
                    }
                });
			</script>
			<?php

		}, 9999);
		if (array_key_exists('cssClass', $formInput['data'])) {
			$css = sanitize_html_class($formInput['data']['cssClass']);
		} else {
			$css = '';
		}
		$form = '<div class="' . $css . '"><div class="aavoyadate aavoyamt-2">';
		$required = $formInput['data']['required'] == true ? 'required' : '';

		$form .= $formInput['data']['label'] ? '<label for="' . esc_attr(self::$formID) . '">' . __(sanitize_text_field($formInput['data']['label']), AWRAQ_TEXT_DOMAIN) . ($required != "" ? " (*)" : "") . '</label>' : '';
		$form .= '<input type="text" id="' . esc_attr(self::$formID) . '" name="' . esc_attr(self::$formID) . '" ' . $required . '/>';
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
		 * adding Date Picker
		 */


		/**
		 * adding datepicker js depends on moment and jquery
		 * By default WordPress include them in core, so need to provide them.
		 * we just need declare them as dependency
		 */
		if (!in_array('datepicker-js', $wp_scripts->queue)) {
			wp_enqueue_script('datepicker-js', AWRAQ_REL . '/awraq/Frontend/client/daterangepicker.min.js', array('jquery','moment'), '1', true);
		}

		/**
		 * adding datepicker 
		 */
		if (!in_array('datepicker-css', $wp_styles->queue)) {
			wp_enqueue_style('datepicker-css', AWRAQ_REL . '/awraq/Frontend/client/daterangepicker.css', array(), '1', 'all');
		}
	}
}
