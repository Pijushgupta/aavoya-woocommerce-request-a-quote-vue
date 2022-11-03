<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Plugin Name:  Request a Quote Pro by Aavoya
 * Plugin URI: https://www.aavoya.co/request-a-quote-pro-by-aavoya
 * Description: Add Request a quote button on single products or on Product Categories or Product tags. Comes with Drag and Drop Form builder.
 * Version: 2022.11
 * Requires PHP: 7.3.0
 * Author: Pijush Gupta
 * Author URI: https://www.linkedin.com/in/pijush-gupta-php/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: request-a-quote-pro-by-aavoya
 */

if (file_exists(__DIR__) . '/vendor/autoload.php') {
	require_once __DIR__ . '/vendor/autoload.php';
}

if (file_exists(__DIR__) . '/config.php') {
	require_once __DIR__ . '/config.php';
}

use Awraq\Init\Init;
use Awraq\Base\Notice;
use Awraq\Page\Ui;
use Awraq\Base\Enqueue;
use Awraq\Base\Button;
use Awraq\Thirdparty\Woho;
use Awraq\Base\Forms;
use Awraq\Base\Entries;
use Awraq\Base\Ip;
use Awraq\Base\Gcaptcha;
use Awraq\Frontend\Shortcode;
use Awraq\Frontend\Woocommerce\Woo;




/**
 * Initialize the plugin.
 */
function awraq_init_plugin() {
	Init::activate();
	Ui::activate();
	Enqueue::do();
	Button::enable();
	if (class_exists('WooCommerce')) {
		Woho::enable();
	}
	Forms::activate();
	Entries::enable();
	Ip::enable();
	Gcaptcha::enable();
	Shortcode::activate();
	Woo::activate();
}
add_action('plugins_loaded', 'awraq_init_plugin');
