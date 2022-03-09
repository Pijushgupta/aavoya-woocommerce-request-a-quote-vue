<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Plugin Name: Aavoya Request a Quote
 * Plugin URI: https://www.aavoya.co/aavoya-request-a-quote
 * Description: Add Request a quote button on single products or on Product Categories or Product tags.
 * Version: 2021.12
 * Requires PHP: 7.3.0
 * Author: Pijush Gupta
 * Author URI: https://www.linkedin.com/in/pijush-gupta-php/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: aavoya-woocommerce-request-a-quote
 */

if (file_exists(__DIR__) . '/vendor/autoload.php') {
	require_once __DIR__ . '/vendor/autoload.php';
}

define('AWRAQ_TEXT_DOMAIN', 'aavoya-woocommerce-request-a-quote');
define('AWRAQ_ABS', plugin_dir_path(__FILE__));
define('AWRAQ_REL', plugins_url('', __FILE__));
define('AWRAQ_ADMIN_MENU_TITLE', 'Aavoya Request a Quote');
define('AWRAQ_ADMIN_MENU_NAME', 'Aavoya RAQ');
define('AWRAQ_SPA_SLUG', 'aavoya_woocommerce_request_a_quote_setting');
define('AWRAQ_VUE_ROOT_ID', 'awraq-root');

define('AWRAQ_SUPPORTED_PLUGINS',array(
	array(
		'name'=>'Contact Form 7',
		'post_type'=>'wpcf7_contact_form',
		'plugin_dir'=>'contact-form-7/wp-contact-form-7.php'
	),
	array(
		'name'=>'WPForms',
		'post_type'=>'wpforms',
		'plugin_dir'=>'wpforms-lite/wpforms.php'
	),
	array(
		'name'=>'Forminator Form',
		'post_type'=>'forminator_forms',
		'plugin_dir'=>'forminator/forminator.php'
	),
	array(
		'name'=>'Forminator Poll',
		'post_type'=>'forminator_polls',
		'plugin_dir'=>'forminator/forminator.php'
	),
	array(
		'name'=>'Forminator Quiz',
		'post_type'=>'forminator_quizzes',
		'plugin_dir'=>'forminator/forminator.php'
	)
));


use Awraq\Init\Init;
use Awraq\Base\Notice;
use Awraq\Page\Ui;
use Awraq\Base\Enqueue;
use Awraq\Base\Ajax;




/**
 * Initialize the plugin.
 */
function awraq_init_plugin()
{

	if (Init::activate() != TRUE) {

		deactivate_plugins(plugin_basename(__FILE__));
		Notice::error('Plugin got Deactivated. Please Activate woocommerce and contact form 7', true);
	} else {

		Ui::activate();
		Enqueue::do();
		Ajax::enable();
	}
}
add_action('plugins_loaded', 'awraq_init_plugin');


