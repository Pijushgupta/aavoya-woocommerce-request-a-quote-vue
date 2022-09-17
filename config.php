<?php 

define('AWRAQ_TEXT_DOMAIN', 'aavoya-woocommerce-request-a-quote');
define('AWRAQ_ABS', plugin_dir_path(__FILE__));
define('AWRAQ_REL', plugins_url('', __FILE__));
define('AWRAQ_ADMIN_MENU_TITLE', 'Aavoya Request a Quote');
define('AWRAQ_ADMIN_MENU_NAME', 'Aavoya RAQ');
define('AWRAQ_SPA_SLUG', 'aavoya_woocommerce_request_a_quote_setting');
define('AWRAQ_VUE_ROOT_ID', 'awraq-root');

define('AWRAQ_SUPPORTED_PLUGINS',array(
	array('name'=>'Contact Form 7', 'post_type'=>'wpcf7_contact_form','plugin_dir'=>'contact-form-7/wp-contact-form-7.php'),
	array('name'=>'WPForms','post_type'=>'wpforms','plugin_dir'=>'wpforms-lite/wpforms.php'),
	array('name'=>'Forminator Form','post_type'=>'forminator_forms','plugin_dir'=>'forminator/forminator.php'),
	array('name'=>'Forminator Poll','post_type'=>'forminator_polls','plugin_dir'=>'forminator/forminator.php'),
	array('name'=>'Forminator Quiz','post_type'=>'forminator_quizzes','plugin_dir'=>'forminator/forminator.php'),
	array('name'=>'Aavoya Froms','post_type'=>'aavoya_wraq_form','plugin_dir'=>'aavoya-woocommerce-request-a-quote-vue/aavoya-woocommerce-request-a-quote.php'),
));