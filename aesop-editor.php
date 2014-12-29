<?php
/**
 *
 * @package   Aesop Editor
 * @author    Nick Haskins <nick@aesopinteractive.com>
 * @license   GPL-2.0+
 * @link      http://aesopinteractive.com
 * @copyright 2015 Aesopinteractive LLC
 *
 * Plugin Name:       Aesop Editor
 * Plugin URI:        http://aesopinteractive.com
 * Description:       Aesop Story Engine - Front End Editor
 * Version:           alpha0.11
 * GitLab Plugin URI: https://gitlab.com/aesop/aesop-editor
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Set some constants
define('AESOP_EDITOR_VERSION', '0.11');
define('AESOP_EDITOR_DIR', plugin_dir_path( __FILE__ ));
define('AESOP_EDITOR_URL', plugins_url( '', __FILE__ ));

// define the parent container class for the post
if ( !defined('AESOP_EDITOR_TARGET') ) {
	define('AESOP_EDITOR_TARGET', '.aesop-entry-content');
}

// define the class holding the featured image
// note - currently only works with images set as background images
if ( !defined('AESOP_EDITOR_FEATIMG_CLASS') ) {
	define('AESOP_EDITOR_FEATIMG_CLASS', '.ast-entry-mast-img');
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/
require_once( plugin_dir_path( __FILE__ ) . 'public/class-aesop-editor.php' );


register_activation_hook( __FILE__, array( 'Aesop_Editor', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Aesop_Editor', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Aesop_Editor', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-aesop-editor-admin.php' );
	add_action( 'plugins_loaded', array( 'Aesop_Editor_Admin', 'get_instance' ) );

}
