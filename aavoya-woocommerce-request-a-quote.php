<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Plugin Name: Request a Quote Prime by Aavoya
 * Plugin URI: https://www.aavoya.co/aavoya-request-a-quote
 * Description: Add Request a quote button on single products or on Product Categories or Product tags.
 * Version: 2021.12
 * Requires PHP: 7.3.0
 * Author: Pijush Gupta
 * Author URI: https://www.linkedin.com/in/pijush-gupta-php/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: request-a-quote-prime-by-aavoya
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
use Awraq\Frontend\Shortcode;




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
	Shortcode::activate();
}
add_action('plugins_loaded', 'awraq_init_plugin');
