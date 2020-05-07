<?php
/*
Plugin Name: AIT-Conflict-Of-Interest
Plugin URI: 
Description: A required plugin for conflict of interest
Author: Antonio
Author URI: 
Text Domain: ait-presentation
Domain Path: 
Version: 1.0.0
*/

define( 'AIT_PLUGIN_CONFL', __FILE__ );

define( 'AIT_PLUGIN_DIR_CONFL', untrailingslashit( dirname( AIT_PLUGIN_CONFL) ) );

// Deprecated, not used in the plugin core. Use AIT_plugin_url() instead.
define( 'AIT_PLUGIN_URL_CONFL',
	untrailingslashit( plugins_url( '', AIT_PLUGIN_CONFL) ) );

require_once plugin_dir_path( __FILE__ ) . '/inc/conflict_interest.php';


/**
 * Enqueue scripts and styles.
 */
function ait_conflict_scripts() {
	wp_enqueue_style( 'ait-conflict-style','/wp-content/plugins/ait-conflict/inc/assets/css/style.css' , array(), rand(111,9999), 'all');
	wp_enqueue_script( 'ait-conflict-js','/wp-content/plugins/ait-conflict/inc/assets/js/submission.js' , array(), rand(111,9999), 'all');
	wp_localize_script('ait-conflict-js', 'absScript', array(
	    'pluginsUrl' => plugins_url(),
	));
}
add_action( 'wp_head', 'ait_conflict_scripts' );