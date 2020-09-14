<?php

/**
 * @author            Raney Day Design
 * @copyright         2020 Raney Day Design  Your Name or Company Name
 * @license           GPL-2.0-or-later
 *
 * Plugin Name:       RDD Care Plan
 * Plugin URI:        https://raneydaydesign.com/
 * Description:       RDD Care Plan Report
 * Version:           1.0.2
 * Requires at least: 5.2
 * Requires PHP:      5.1
 * Author:            Raney Day Design
 * Author URI:        https://raneydaydesign.com
 * Text Domain:       rdd-care-plan
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
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
define( 'SETTINGS_PAGE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-settings-page-activator.php
 */
// function activate_settings_page() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-settings-page-activator.php';
// 	Settings_Page_Activator::activate();
// }

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-settings-page-deactivator.php
 */
function deactivate_settings_page() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-settings-page-deactivator.php';
	Settings_Page_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_settings_page' );
register_deactivation_hook( __FILE__, 'deactivate_settings_page' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-settings-page.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_settings_page() {

	$plugin = new Settings_Page();
	$plugin->run();

}
run_settings_page();
