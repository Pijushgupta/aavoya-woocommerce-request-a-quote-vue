<?php

namespace Awraq\Base;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;

class Ip {
	public static $globalScopeName = 'Awraq\Base\Ip';
	public static function enable() {
		add_action('wp_ajax_awraqBlockIp', array(self::$globalScopeName, 'block'));
		add_action('wp_ajax_awraqGetBlockedIps', array(self::$globalScopeName, 'getBlockedIps'));
		add_action('wp_ajax_awraqUpdateBlockedIps', array(self::$globalScopeName, 'updateBlockedIps'));
	}
	public static function block() {
		if (!Officer::check($_POST)) wp_die();
		if (!$_POST['ip']) wp_die();
		$ip = Officer::sanitize($_POST['ip'], 'text');
		$blockedIp = get_option('awraq_blocked_ips', null);
		$ipToBlock = array();
		if ($blockedIp != null) {
			$ipToBlock = unserialize($blockedIp);
		}
		if (in_array((string)$ip, $ipToBlock)) {
			echo json_encode(0);
			wp_die();
		}
		array_push($ipToBlock, (string)$ip);
		echo json_encode(update_option('awraq_blocked_ips', serialize($ipToBlock)));
		wp_die();
	}
	public static function getBlockedIps() {
		if (!Officer::check($_POST)) wp_die();
		$blockedIp = get_option('awraq_blocked_ips', false);
		if ($blockedIp != false) {
			$blockedIp = unserialize($blockedIp);
			echo json_encode($blockedIp);
		}
		wp_die();
	}
	public static function updateBlockedIps() {
		if (!Officer::check($_POST)) wp_die();
		$ipList = $_POST['ipList'];
		$ipList = Officer::sanitize($_POST['ipList'], 'text');
		$ipList = Officer::jsonToArray($ipList);
		echo json_encode(update_option('awraq_blocked_ips', serialize($ipList)));
		wp_die();
	}
}
