<?php

namespace Awraq\Init;

if (!defined('ABSPATH')) exit;

class Random {

	/**
	 * add
	 * adds random key to option table to be used as JWT passphrase 
	 * @param void 
	 * @return void
	 */
	public static function add(): void {
		if (get_option('aavoya_wraq_random_key', null) != null) return;
		add_option('aavoya_wraq_random_key', self::generate(20));
	}

	/**
	 * generate
	 * Generate Random Character
	 * @param  int $length
	 * @return string
	 */
	public static function generate(int $length = 16): string {

		$characters = (string)'ABCDEFGHIJKLMNOPQRSTUVWXabcdefghijklmnopqrstuvwxyz';
		$numbers = (string)'0123456789';
		$symbols = (string)'~!@#$%^&*()_+';
		$output = '';

		for ($i = 0; $i < $length; $i++) {
			$type = rand(0, 2);
			if ($type == 0) {
				$output .= $characters[rand(0, strlen($characters) - 1)];
			}
			if ($type == 1) {
				$output .= $numbers[rand(0, strlen($numbers) - 1)];
			}
			if ($type == 2) {
				$output .= $symbols[rand(0, strlen($symbols) - 1)];
			}
		}
		return $output;
	}
}
