<?php
/**
 * @package   KWPborgs_gallery
 * @author    KWProductions Co.
 * @license   GPL-2.0+
 * @link      https://extensions.kwproductions121.ir
 * @copyright All rights reserved
 *
 * @wordpress-plugin
 * Plugin Name:       Kwpborgs Gallery
 * Plugin URI:        https://extensions.kwproductions121.ir/wordpress/kwpborgsgallery.html
 * Description:       A 3 dimensional gallery in the shape of a cube with controllable speed 
 * Version:           1.0.0
 * Author:            KWProductions Co.
 * Author URI:        https://extensions.kwproductions121.ir
 * Text Domain:       Kwpborgs_gallery
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

/**
 *-----------------------------------------
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/

/*----------------------------------------------------------------------------*
 * * * ATTENTION! * * *
 * FOR DEVELOPMENT ONLY
 * SHOULD BE DISABLED ON PRODUCTION
 *----------------------------------------------------------------------------*/
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*
 * Plugin Settings
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Settings ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-kwpborgs-gallery-settings.php';

register_activation_hook(__FILE__, array('Kwpborgs_Gallery_Settings', 'activate'));
add_action('plugins_loaded', array('Kwpborgs_Gallery_Settings', 'get_instance'));
/* ----- Module End: Settings ----- */

/*----------------------------------------------------------------------------*
 * Include extensions, CPT and widget
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: CPT ----- */
//require_once plugin_dir_path(__FILE__) . 'includes/cpt/class-kwpborgs-gallery-cpt.php';
//add_action('plugins_loaded', array('Kwpborgs_Gallery_CPT', 'get_instance'));
/* ----- Module End: CPT ----- */

/* ----- Plugin Module: Widget ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-kwpborgs-gallery-widget.php';
/* ----- Module End: Widget ----- */

/*----------------------------------------------------------------------------*
 * Custom DB Tables
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Database ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-kwpborgs-gallery-db.php';

register_activation_hook(__FILE__, array('Kwpborgs_Gallery_DB', 'activate'));
add_action('plugins_loaded', array('Kwpborgs_Gallery_DB', 'db_check'));
/* ----- Module End: Database ----- */

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once plugin_dir_path(__FILE__) . 'includes/class-kwpborgs-gallery.php';
//new Kwpborgs_Gallery();

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook(__FILE__, array('Kwpborgs_Gallery', 'activate'));
register_deactivation_hook(__FILE__, array('Kwpborgs_Gallery', 'deactivate'));

add_action('plugins_loaded', array('Kwpborgs_Gallery', 'get_instance'));

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {

    /* ----- Plugin Module: CRUD ----- */
    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-kwpborgs-gallery-admin-crud-list.php';
    /* ----- Module End: CRUD ----- */

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-kwpborgs-gallery-admin.php';
    add_action('plugins_loaded', array('Kwpborgs_Gallery_Admin', 'get_instance'));
	
	require_once plugin_dir_path(__FILE__) . 'includes/admin/class-kwpborgs-gallery-admin-metaboxes.php';
    add_action('plugins_loaded', array('Kwpborgs_Gallery_Admin_Metaboxes', 'get_instance'));

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-kwpborgs-gallery-admin-pages.php';
    add_action('plugins_loaded', array('Kwpborgs_Gallery_Admin_Pages', 'get_instance'));

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-kwpborgs-gallery-admin-pages-crud.php';
    add_action('plugins_loaded', array('Kwpborgs_Gallery_Admin_Pages_CRUD', 'get_instance'));

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-kwpborgs-gallery-admin-pages-settings.php';
    add_action('plugins_loaded', array('Kwpborgs_Gallery_Admin_Pages_Settings', 'get_instance'));

}

/*----------------------------------------------------------------------------*
 * Register Plugin Shortcode
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Shortcode ----- */
// Admin Side
require_once plugin_dir_path(__FILE__) . 'includes/shortcode/class-kwpborgs-gallery-shortcode-admin.php';
add_action('plugins_loaded', array('Kwpborgs_Gallery_Shortcode_Admin', 'get_instance'));

// Public Side
require_once plugin_dir_path(__FILE__) . 'includes/shortcode/class-kwpborgs-gallery-shortcode-public.php';
add_action('plugins_loaded', array('Kwpborgs_Gallery_Shortcode_Public', 'get_instance'));
/* ----- Module End: Shortcode ----- */

/*----------------------------------------------------------------------------*
 * Handle AJAX Calls
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: AJAX ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-kwpborgs-gallery-ajax.php';
add_action('plugins_loaded', array('Kwpborgs_Gallery_AJAX', 'get_instance'));
/* ----- Module End: AJAX ----- */

require_once plugin_dir_path(__FILE__) . 'includes/class-kwpborgs-gallery-widget.php';
new  Kwpborgs_gallery_Widget_Init();


