<?php
/**
 * The current version of the theme.
 *
 * @package dobby-the-storekeeper
 */
define( 'DOBBYTS_VERSION', '0.1.5' );

/**
 * Enqueue scripts and styles.
 */
function dobbyts_scripts() {

	// Styles.
	wp_enqueue_style( 'styles', get_theme_file_uri( "css/global.css" ), array(), filemtime( get_theme_file_path( "css/global.css" ) ) );
	// Scripts.
	wp_enqueue_script( 'jquery-core' );
	wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );

}
add_action( 'wp_enqueue_scripts', 'dobbyts_scripts' );

/**
* WooCommerce
*/ 

//WooCommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
  add_theme_support( 'woocommerce' );
}

