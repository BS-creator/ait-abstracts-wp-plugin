<?php
/*
Plugin Name: A-IT Presentation Upload
Plugin URI: 
Description: A required plugin for uploading presentation
Author: Antonio
Author URI: 
Text Domain: ait-presentation
Domain Path: 
Version: 1.0.0
*/

define( 'AIT_PLUGIN_PRES', __FILE__ );

define( 'AIT_PLUGIN_DIR_PRES', untrailingslashit( dirname( AIT_PLUGIN_PRES ) ) );

// Deprecated, not used in the plugin core. Use AIT_plugin_url() instead.
define( 'AIT_PLUGIN_URL_PRES',
	untrailingslashit( plugins_url( '', AIT_PLUGIN_PRES ) ) );

require_once plugin_dir_path( __FILE__ ) . '/inc/presentation_upload_page.php';


/**
 * Enqueue scripts and styles.
 */
function ait_presentation_scripts() {
	wp_enqueue_style( 'ait-presentation-style','/wp-content/plugins/ait-presentation-upload/inc/assets/css/style.css' , array(), rand(111,9999), 'all');
	wp_enqueue_script( 'ait-presentation-js','/wp-content/plugins/ait-presentation-upload/inc/assets/js/submission.js' , array(), rand(111,9999), 'all');
	wp_localize_script('ait-presentation-js', 'absScript', array(
	    'pluginsUrl' => plugins_url(),
	));
}
add_action( 'wp_head', 'ait_presentation_scripts' );