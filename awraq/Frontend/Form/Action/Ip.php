<?php

namespace Awraq\Frontend\Form\Action;

if (!defined('ABSPATH')) exit;

class Ip {
	/**
	 * is_blocked
	 * Check if IP blocked or not 
	 * @param  string $add
	 * @return bool
	 */
	public static function is_blocked($add = null): bool {
		if ($add == null) return false;

		//TODO: get block list and remove the dummy code 
		$blockedIp = array();

		if (in_array($add, $blockedIp)) return true;

		return false;
	}
}
