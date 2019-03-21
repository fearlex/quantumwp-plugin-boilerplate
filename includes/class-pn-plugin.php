<?php
/**
 * Plugin related functions and actions.
 *
 * @package PluginName/Classes
 * @version 0.0.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * PN_Plugin Class.
 */
class PN_Plugin {


	/**
	 * Hook in plugin screen.
	 *
	 * @static
	 * @access public
	 */
	public static function init() {

		add_filter( 'plugin_action_links_' . PN_PLUGIN_BASENAME, array( __CLASS__, 'plugin_action_links' ) );
		add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @param mixed $links Plugin Action links.
	 *
	 * @static
	 * @access public
	 * @return array
	 */
	public static function plugin_action_links( $links ) {
		$action_links = array(
			'settings' => '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=products&section=plugin-name' ) . '" aria-label="' . esc_attr__( 'View Plugin Name settings', 'plugin-name' ) . '">' . esc_html__( 'Settings', 'plugin-name' ) . '</a>',
		);

		return array_merge( $action_links, $links );
	}

	/**
	 * Show row meta on the plugin screen.
	 *
	 * @param mixed $links Plugin Row Meta.
	 * @param mixed $file  Plugin Base file.
	 *
	 * @static
	 * @access public
	 * @return array
	 */
	public static function plugin_row_meta( $links, $file ) {

		if ( PN_PLUGIN_BASENAME === $file ) {
			$row_meta = array(
				'docs'    => '<a href="' . esc_url( apply_filters( 'pluginname_docs_url', 'https://docs.pluginname.com/documentation/plugins/pluginname/' ) ) . '" aria-label="' . esc_attr__( 'View Plugin Name documentation', 'plugin-name' ) . '">' . esc_html__( 'Docs', 'plugin-name' ) . '</a>',
				'apidocs' => '<a href="' . esc_url( apply_filters( 'pluginname_apidocs_url', 'https://docs.pluginname.com/apidocs/' ) ) . '" aria-label="' . esc_attr__( 'View Plugin Name API docs', 'plugin-name' ) . '">' . esc_html__( 'API docs', 'plugin-name' ) . '</a>',
				'support' => '<a href="' . esc_url( apply_filters( 'pluginname_support_url', 'https://pluginname.com/my-account/tickets/' ) ) . '" aria-label="' . esc_attr__( 'Visit premium customer support', 'plugin-name' ) . '">' . esc_html__( 'Premium support', 'plugin-name' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}

		return (array) $links;
	}
}

PN_Plugin::init();
