<?php

namespace Awraq\Frontend\Form\Essentials;

if (!defined('ABSPATH')) exit;

class Gcaptcha {

	public static $globalScopeName = 'Awraq\Frontend\Form\Essentials\Gcaptcha';
	private static $gCaptchaCredentials = '';
	public static $formID;
	public static $siteKey;

	public static function create($id) {
		//check if this from with the id has enabled the captch or not 
		if(self::verify($id) != true) return;
		self::$formID = $id;
		self::$gCaptchaCredentials = get_option('awraq_getGoogleCaptchaKeys', null);
		if (self::$gCaptchaCredentials == null) return;

		self::enqueueGScript();
		return self::createInput();
	}

	/**
	 * verify
	 * This method to verify, if a Form has captcha enabled or not
	 * @param $id
	 * @return boolean
	 */
	public static function verify($id){
		return get_post_meta($id,'googleCaptchaMeta',true);
	}

	/**
	 * This to enqueue google captcha client side script
	 * @return void
	 */
	public static function enqueueGScript() {
		$gCaptchaCredentials = unserialize(self::$gCaptchaCredentials);
		if (!$gCaptchaCredentials['siteKey'] || !$gCaptchaCredentials['secretKey']) return;
		self::$siteKey = $gCaptchaCredentials['siteKey'];
		wp_enqueue_script('google-captcha-cdn', 'https://www.google.com/recaptcha/api.js?render='. $gCaptchaCredentials['siteKey'], array(), false, false);
		add_action('wp_footer',function(){
			?>
			<script>
			grecaptcha.ready(function () {
				try {
					grecaptcha.execute("<?php echo esc_attr(self::$siteKey); ?>", {action: 'submit'}).then(function(token) {
					if(token){
						var google_token = document.querySelector('input[name="<?php echo esc_attr('google-captcha-'.self::$formID); ?>"]');
						google_token.setAttribute('value',token);
					}
				});
				}
				catch (err) {
					console.log(err);
					
				}
				
			});
            </script>
			<?php

		},9999);
	}

	/**
	 * This to create hidden input to have google captcha token
	 *
	 * @return string
	 */
	public static function createInput(){
		return '<input type="hidden" name="google-captcha-'.self::$formID.'">';
	}
}
