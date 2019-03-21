<?php
/**
 * PluginName setup
 *
 * @package PluginName
 * @since   0.0.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main PluginName Class.
 *
 * @class PluginName
 */
final class PluginName {

	/**
	 * Plugin name.
	 *
	 * @access public
	 * @var string
	 */
	public $plugin_name = 'Plugin Name';

	/**
	 * Plugin version.
	 *
	 * @access public
	 * @var string
	 */
	public $version = '0.0.1';

	/**
	 * The single instance of the class.
	 *
	 * @static
	 * @access protected
	 * @var PluginName
	 * @since 0.0.1
	 */
	protected static $_instance = null;

	/**
	 * Main PluginName Instance.
	 *
	 * Ensures only one instance of PluginName is loaded or can be loaded.
	 *
	 * @since 0.0.1
	 * @static
	 * @see PN()
	 * @return PluginName - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * PluginName Constructor.
	 *
	 * @access public
	 */
	public function __construct() {

		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'plugin_name_loaded' );
	}
	
	/**
	 * Define PluginName Constants.
	 *
	 * @access private
	 */
	private function define_constants() {

		$upload_dir = wp_upload_dir( null, true );

		$this->define( 'PN_ABSPATH', dirname( PN_PLUGIN_FILE ) . '/' );
		$this->define( 'PN_PLUGIN_BASENAME', plugin_basename( PN_PLUGIN_FILE ) );
		$this->define( 'PN_VERSION', $this->version );
		$this->define( 'PN_LOG_DIR', $upload_dir['basedir'] . '/pn-logs/' );
	}
	
	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @access public
	 */
	public function includes() {

		/**
		 * Core Classes.
		 */
		include_once PN_ABSPATH . 'includes/class-pn-FILENAME.php';

		//-- If WP-CLI Functionality
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			include_once PN_ABSPATH . 'includes/class-pn-cli.php';
		}

		//-- If is Admin
		if ( $this->is_request( 'admin' ) ) {

			//-- Add Plugin Screen Hooks
			include_once HWG_ABSPATH . 'includes/class-pn-plugin.php';

			//-- Add Admin Settings
			include_once PN_ABSPATH . 'includes/admin/class-pn-admin.php';
		}

		//-- If is Front End
		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @access private
	 * @since 0.0.1
	 */
	private function init_hooks() {

		//register_activation_hook( PN_PLUGIN_FILE, array( 'PN_Install', 'install' ) );
		//register_shutdown_function( array( $this, 'log_errors' ) );

		add_action( 'init', array( $this, 'init' ), 0 );

	}

	/**
	 * Include required frontend files.
	 *
	 * @access public
	 */
	public function frontend_includes() {

		//include_once PN_ABSPATH . 'includes/class-pn-frontend-scripts.php';
		//include_once PN_ABSPATH . 'includes/class-pn-shortcodes.php';
	}

	/**
	 * Init PluginName when WordPress Initialises.
	 *
	 * @access public
	 */
	public function init() {

		// Before init action.
		do_action( 'before_pluginname_init' );

		// Set up localization.
		$this->load_plugin_textdomain();

		// Init action.
		do_action( 'pluginname_init' );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 *
	 * @access private
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 *
	 * @access private
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}
	
	/**
	 * Get Ajax URL.
	 *
	 * @access public
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', PN_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( PN_PLUGIN_FILE ) );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @access public
	 * @since 0.0.1
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.', 'plugin-name' ), '0.0.1' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @access public
	 * @since 0.0.1
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'plugin-name' ), '0.0.1' );
	}
}
