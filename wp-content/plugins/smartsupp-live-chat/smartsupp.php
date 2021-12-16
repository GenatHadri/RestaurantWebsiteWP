<?php
/**
 *
 * @package   Smartsupp
 * @author    Smartsupp <vladimir@smartsupp.com>
 * @license   GPL-2.0+
 * @link      http://www.smartsupp.com
 * @copyright 2016 Smartsupp.com
 *
 * Plugin Name:       Smartsupp Live Chat
 * Plugin URI:        http://www.smartsupp.com
 * Description:       Smartsupp live chat - official plugin. Smartsupp is free live chat with visitor recording. The plugin enables you to create a free account or sign in with existing one. Pre-integrated customer info with WooCommerce (you will see names and emails of signed in webshop visitors). Optional API for advanced chat box modifications.
 * Version:           3.6
 * Author:            Smartsupp
 * Author URI:        http://www.smartsupp.com
 * Text Domain:       smartsupp-live-chat
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-smartsupp.php' );



add_action( 'plugins_loaded', array( 'Smartsupp', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-smartsupp-admin.php' );
	add_action( 'plugins_loaded', array( 'Smartsupp_Admin', 'get_instance' ) );
	register_activation_hook( __FILE__, array( 'Smartsupp_Admin', 'install' ) );
}
