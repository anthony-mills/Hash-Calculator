<?php
/*
Plugin Name: Hash calculator
Plugin URI: http://www.development-cycle.com
Description: Simple plugin to create either a MD5 or SHA1 hash of a string 
Version: 0.1
Author: Anthony Mills
Author URI: http://www.development-cycle.com
License: GPL2
*/

function hashCalc()
{
	if ((!empty($_POST['hash_string'])) && (($_POST['hash_type'] == 'SHA1') || ($_POST['hash_type'] == 'MD5'))) {
		$hashData = file_get_contents(WP_PLUGIN_DIR . '/hash_calculator/html/displayHash.phtml');
		$hashData = str_replace('%hashType%', $_POST['hash_type'], $hashData);
		switch ($_POST['hash_type']) {
			case 'SHA1':
				$hashedString = sha1($_POST['hash_string']);	
			break;

			case 'MD5':
				$hashedString = md5($_POST['hash_string']);					
			break;
		} 	
		$hashData = str_replace('%generatedHash%', $hashedString, $hashData);
		$hashData = str_replace('%hashString%', $_POST['hash_string'], $hashData);

		echo $hashData;
	}
	$formData = file_get_contents(WP_PLUGIN_DIR . '/hash_calculator/html/hashForm.phtml');
	echo $formData;

}

function hashCalcHead()
{
	$formHead = file_get_contents(WP_PLUGIN_DIR . '/hash_calculator/html/formHeader.phtml');
	$formHead = str_replace('%pluginUrl%', WP_PLUGIN_URL, $formHead);
	echo $formHead;
}

add_action('wp_head', 'hashCalcHead');

add_shortcode('hash_calculator', 'hashCalc');
