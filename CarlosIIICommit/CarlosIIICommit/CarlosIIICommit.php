<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://cifpcarlos3.es
 * @since             1.0.0
 * @package           CarlosIIICommit
 *
 * @wordpress-plugin
 * Plugin Name:       CIFP Carlos III Commit
 * Plugin URI:        https://cifpcarlos3.es/CarlosIIICommit-uri/
 * Description:       Asociado al proyecto europeo "JuezLTI", aprobado recientemente por la Unión Europea, un plugin para la gestión de los avances que se vayan produciendo en el desarrollo.
 * Version:           1.0.0
 * Author:            C.I.F.P. Carlos III
 * Author URI:        https://cifpcarlos3.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       CarlosIIICommit
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
define( 'CarlosIIICommit_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-CarlosIIICommit-activator.php
 */
function activate_CarlosIIICommit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-CarlosIIICommit-activator.php';
	CarlosIIICommit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-CarlosIIICommit-deactivator.php
 */
function deactivate_CarlosIIICommit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-CarlosIIICommit-deactivator.php';
	CarlosIIICommit_Deactivator::deactivate();
}

function Commit_options_callback() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/Commit-options-form.php';
}

register_activation_hook( __FILE__, 'activate_CarlosIIICommit' );
register_deactivation_hook( __FILE__, 'deactivate_CarlosIIICommit' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-CarlosIIICommit.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_CarlosIIICommit() {

	$plugin = new CarlosIIICommit();
	$plugin->run();

}
run_CarlosIIICommit();
