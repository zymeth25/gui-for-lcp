<?php

/**
 * @package   gui_for_lcp
 * @author    Fundacja "Pro Novitate"
 * @license   GPL-2.0+
 * @link      [github URI here]
 * @copyright 2018 Fundacja "Pro Novitate"
 *
 * @wordpress-plugin
 * Plugin Name:       GUI for List Category Posts
 * Plugin URI:        [github URI here]
 * Description:       This plugin adds an "Add LCP" button to post edit screen which opens a modal with a convenient GUI for creating List Category Posts shortcodes.
 * Version:           1.0.0
 * Author:            Fundacja "Pro Novitate"
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gui-for-lcp
 * Domain Path:       /languages
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see https://www.gnu.org/licenses/gpl-2.0.txt.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'GUI_FOR_LCP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gflcp-activator.php
 */
function activate_gflcp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gflcp-activator.php';
	Gflcp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gflcp-deactivator.php
 */
function deactivate_gflcp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gflcp-deactivator.php';
	Gflcp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gflcp' );
register_deactivation_hook( __FILE__, 'deactivate_gflcp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gflcp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gflcp() {

	$plugin = new Gflcp();
	$plugin->run();

}
run_gflcp();
