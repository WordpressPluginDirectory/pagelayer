<?php
/*
Plugin Name: PageLayer
Plugin URI: http://wordpress.org/plugins/pagelayer/
Description: PageLayer is a WordPress page builder plugin. Its very easy to use and very light on the browser.
Version: 1.8.7
Author: Pagelayer Team
Author URI: https://pagelayer.com/
License: LGPL v2.1
License URI: http://www.gnu.org/licenses/lgpl-2.1.html
*/

// We need the ABSPATH
if (!defined('ABSPATH')) exit;

if(!function_exists('add_action')){
	echo 'You are not allowed to access this page directly.';
	exit;
}

$_tmp_plugins = get_option('active_plugins');


// Is the premium plugin loaded ?
if(!defined('SITEPAD') && in_array('pagelayer-pro/pagelayer-pro.php', $_tmp_plugins) ){
	
	if(!function_exists( 'get_plugins' )){
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$pro_info = get_plugins('/pagelayer-pro');
	
	if(
		!empty($pro_info) && 
		!empty($pro_info['pagelayer-pro.php']) && 
		version_compare($pro_info['pagelayer-pro.php']['Version'], '1.8.6', '<')
	){
		return;
	}
}

// If PAGELAYER_VERSION exists then the plugin is loaded already !
if(defined('PAGELAYER_VERSION')) {
	return;
}

define('PAGELAYER_FILE', __FILE__);

include_once(dirname(__FILE__).'/init.php');
