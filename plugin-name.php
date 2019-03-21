<?php
/**
 * Plugin Name: Plugin Name
 * Plugin URI: https://pluginurl.com
 * Description: DESCRIPTION
 * Version: 0.0.1
 * Author: QuantumWP (Arleys Resco)
 * Author URI: https://quantumwp.com
 * Text Domain: plugin-name
 * Domain Path: /languages/
 *
 * @package Plugin_Name
 */

defined( 'ABSPATH' ) || exit;

// Define PN_PLUGIN_FILE.
if ( ! defined( 'PN_PLUGIN_FILE' ) ) {
	define( 'PN_PLUGIN_FILE', __FILE__ );
}

//-- IF WOOCOMMERCE IS NEEDED OTHERWISE ERASE
// Required functions
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	require_once( plugin_dir_path( HWG_PLUGIN_FILE ) . 'woo-includes/woo-functions.php' );
}

// WC active check
if ( ! is_woocommerce_active() ) {
	return;
}

// Include the main PluginName class.
if ( ! class_exists( 'PluginName' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-plugin-name.php';
}

//-- If Main function exist
if ( ! function_exists( 'PN' ) ) {
	/**
	 * Main instance of PluginName.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return PluginName | Object
	 */
	function PN() {
		return PluginName::instance();
	}
}

// Let's roll!
PN();
