<?php
/*
 * Plugin Name: Simple Load More
 * Version: 1.0
 * Plugin URI: http://www.webgensis.com/
 * Description: Add an ajax load more button to any of your archive pages without editing your templates.
 * Author: Webgensis
 * Author URI: http://www.webgensis.com/
 * Requires at least: 4.0
 * Tested up to: 4.9.4
 *
 * Text Domain: simple-load-more
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Webgensis
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-simple-load-more.php' );
require_once( 'includes/class-simple-load-more-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-simple-load-more-admin-api.php' );

/**
 * Returns the main instance of Simple_Load_More to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Simple_Load_More
 */
function Simple_Load_More () {
	$instance = Simple_Load_More::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = Simple_Load_More_Settings::instance( $instance );
	}

	return $instance;
}

Simple_Load_More();

function load_more_button() {
	$button_text = get_option('elm_button_text');
	$loading_icon = get_option('elm_animation_icon');
	$loading_text = get_option('elm_loading_text');
	$animation_open = get_option('elm_animation_open');
	Simple_Load_More()->build_load_more_button($loading_icon,$button_text,$loading_text,$animation_open);
	
}


function load_more_shortcode($atts) {
	$button_text = get_option('elm_button_text');
	$btn_atts = shortcode_atts( array(
        'button_text' => $button_text
    ), $atts );
	
	    $loading_icon = get_option('elm_animation_icon');
		$loading_text = get_option('elm_loading_text');
		$animation_open = get_option('elm_animation_open');
	Simple_Load_More()->build_load_more_button($loading_icon,$btn_atts['button_text'],$loading_text,$animation_open);
	
}


add_shortcode( 'load_more', 'load_more_shortcode' );