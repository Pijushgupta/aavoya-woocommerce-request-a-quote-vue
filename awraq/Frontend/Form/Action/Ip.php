<?php

namespace Awraq\Frontend\Form\Action;

if (!defined('ABSPATH')) exit;

class Ip {
	/**
	 * is_blocked
	 * Check if IP blocked or not 
	 * @param  string $ip
	 * @return bool
	 */
	public static function is_blocked($ip = null): bool {
		if ($ip == null) return false;

		$blockedIp = get_option('awraq_blocked_ips', null);
		if ($blockedIp == null) return false;
		$blockedIp = unserialize($blockedIp);

		if (in_array($ip, $blockedIp)) return true;
		return false;
	}

	/**
	 * block
	 * This method to block IP
	 * @param string $ip
	 * @return bool
	 */
	public static function block($ip = null): bool {
		if ($ip == null) return false;

		$blockedIp = get_option('awraq_blocked_ips', null);
		$ipToBlock = array();
		if ($blockedIp != null) {
			$ipToBlock = unserialize($blockedIp);
		}
		array_push($ipToBlock, (string)$ip);

		return update_option('awraq_blocked_ips', serialize($ipToBlock));
	}
}
