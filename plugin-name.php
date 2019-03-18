<?php
/**
 * Plugin Name: Plugin Name
 * Plugin URI: https://pluginurl.com
 * Description: DESCRIPTION
 * Version: 0.0.1
 * Author: QuantumWP
 * Author URI: https://quantumwp.com
 * Text Domain: pluginname
 * Domain Path: /languages/
 *
 * @package Plugin_Name
 */

defined( 'ABSPATH' ) || exit;

// Define PLUGIN_NAME_PLUGIN_FILE.
if ( ! defined( 'PLUGIN_NAME_PLUGIN_FILE' ) ) {
	define( 'PLUGIN_NAME_PLUGIN_FILE', __FILE__ );
}

// Include the main PluginName class.
if ( ! class_exists( 'PluginName' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-plugin-name.php';
}

//-- If Main function exist
if ( ! function_exists( 'pn' ) ) {
	/**
	 * Main instance of PluginName.
	 *
	 * @since  0.0.1
	 * @return PluginName
	 */
	function pn() {
		return PluginName::instance();
	}
}

pn();
