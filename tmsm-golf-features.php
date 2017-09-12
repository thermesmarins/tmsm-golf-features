<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/nicomollet
 * @since             1.0.0
 * @package           Tmsm_Golf_Features
 *
 * @wordpress-plugin
 * Plugin Name:       TMSM Golf Features
 * Plugin URI:        https://github.com/thermesmarins/tmsm-golf-features
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.7
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet
 * Requires PHP:      5.6
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tmsm-golf-features
 * Domain Path:       /languages
 * Github Plugin URI: https://github.com/thermesmarins/tmsm-golf-features
 * Github Branch:     master
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tmsm-golf-features-activator.php
 */
function activate_tmsm_golf_features() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-golf-features-install.php';
	Tmsm_Golf_Features_Install::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tmsm-golf-features-deactivator.php
 */
function deactivate_tmsm_golf_features() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-golf-features-install.php';
	Tmsm_Golf_Features_Install::deactivate();
}

register_activation_hook( __FILE__, 'activate_tmsm_golf_features' );
register_deactivation_hook( __FILE__, 'deactivate_tmsm_golf_features' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-golf-features.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tmsm_golf_features() {

	$plugin = new Tmsm_Golf_Features();
	$plugin->run();

}
run_tmsm_golf_features();
