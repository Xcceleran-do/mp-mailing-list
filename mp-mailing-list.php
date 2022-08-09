<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/EsubalewAmenu/
 * @since             1.0.0
 * @package           Mp_Mailing_List
 *
 * @wordpress-plugin
 * Plugin Name:       MP Mailing List
 * Plugin URI:        https://mindplex.io
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Esubalew Amenu
 * Author URI:        https://github.com/EsubalewAmenu/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mp-mailing-list
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if(!defined("mp_mails"))
define("mp_mails","mp_mails");
if(!defined("mp_mails_PLAGIN_DIR"))
define("mp_mails_PLAGIN_DIR",plugin_dir_path( __FILE__ ));
if(!defined("mp_mails_PLAGIN_URL"))
define("mp_mails_PLAGIN_URL", plugin_dir_url(__FILE__));

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MP_MAILING_LIST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mp-mailing-list-activator.php
 */
function activate_mp_mailing_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mp-mailing-list-activator.php';
	Mp_Mailing_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mp-mailing-list-deactivator.php
 */
function deactivate_mp_mailing_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mp-mailing-list-deactivator.php';
	Mp_Mailing_List_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mp_mailing_list' );
register_deactivation_hook( __FILE__, 'deactivate_mp_mailing_list' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mp-mailing-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mp_mailing_list() {

	$plugin = new Mp_Mailing_List();
	$plugin->run();

}
run_mp_mailing_list();
