<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.tukutoi.com/
 * @since             1.0.10
 * @package           Tkt_Maintenance
 *
 * @wordpress-plugin
 * Plugin Name:       TukuToi Maintenance
 * Plugin URI:        https://www.tukutoi.com/program/tukutoi-maintenance
 * Description:       Enable and Control a Custom Maintenance Mode for your WordPress Website.
 * Version:           2.0.4
 * Author:            TukuToi
 * Author URI:        https://www.tukutoi.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tkt-maintenance
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'TKT_MAINTENANCE_VERSION', '2.0.4' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tkt-maintenance.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tkt_maintenance() {

	$plugin = new Tkt_Maintenance();
	$plugin->run();

}
run_tkt_maintenance();
