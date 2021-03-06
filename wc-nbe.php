<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/DevWael
 * @since             1.0.0
 * @package           Wc_Nbe
 *
 * @wordpress-plugin
 * Plugin Name:       WC NBE Payment Gateway
 * Plugin URI:        https://github.com/DevWael/wc-nbe-payment-gateway
 * Description:       Payment gateway for national bank of egypt built on woocommerce.
 * Version:           1.0.0
 * Author:            Ahmad Wael
 * Author URI:        https://github.com/DevWael
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-nbe
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WC_NBE_VERSION', '1.0.0' );
define( 'NBE_DIR', plugin_dir_path( __FILE__ ) );
/**
 * Classes autoloader
 */
spl_autoload_register( function ( $class_name ) {
	$classes_dir = NBE_DIR . DIRECTORY_SEPARATOR . 'NBE' . DIRECTORY_SEPARATOR;
	$class_file  = str_replace( 'NBE', '', $class_name ) . '.php';
	$class       = $classes_dir . str_replace( '\\', '/', $class_file );
	if ( file_exists( $class ) ) {
		require_once $class;
	}

	return false;
} );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-nbe-activator.php
 */
function activate_wc_nbe() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-nbe-activator.php';
	Wc_Nbe_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-nbe-deactivator.php
 */
function deactivate_wc_nbe() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-nbe-deactivator.php';
	Wc_Nbe_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_nbe' );
register_deactivation_hook( __FILE__, 'deactivate_wc_nbe' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-nbe.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_nbe() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$plugin = new Wc_Nbe();
		$plugin->run();
	}
}
run_wc_nbe();
