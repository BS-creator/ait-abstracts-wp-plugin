<?php
/*
Plugin Name: A-IT Abstracts 
Plugin URI: 
Description: A required plugin for Abstracts Form
Author: Antonio
Author URI: 
Text Domain: ait-abstracts
Domain Path: 
Version: 1.0.0
*/

define( 'AIT_PLUGIN', __FILE__ );

define( 'AIT_PLUGIN_DIR', untrailingslashit( dirname( AIT_PLUGIN ) ) );

// Deprecated, not used in the plugin core. Use AIT_plugin_url() instead.
define( 'AIT_PLUGIN_URL',
	untrailingslashit( plugins_url( '', AIT_PLUGIN ) ) );

require_once AIT_PLUGIN_DIR . '/inc/settings.php';


/**
 * Enqueue scripts and styles.
 */
function ait_abstracts_scripts() {
	wp_enqueue_style( 'ait-abstracts-style','/wp-content/plugins/ait-abstracts/inc/assets/css/style.css' , array(), rand(111,9999), 'all');
	wp_enqueue_style( 'ait-abstracts-style2','/wp-content/plugins/ait-abstracts/inc/assets/css/toastr.css' , array(), null);
	wp_enqueue_script( 'ait-abstracts-js2','/wp-content/plugins/ait-abstracts/inc/assets/js/toastr.js' , array(), null);
	wp_enqueue_script( 'ait-abstracts-smtp','https://smtpjs.com/v3/smtp.js' , array(), null);
	wp_enqueue_script( 'ait-abstracts-js','/wp-content/plugins/ait-abstracts/inc/assets/js/submission.js' , array(), rand(111,9999), 'all');
	wp_localize_script('ait-abstracts-js', 'absScript', array(
	    'pluginsUrl' => plugins_url(),
	));
}
add_action( 'wp_head', 'ait_abstracts_scripts' );