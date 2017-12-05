<?php
/**
 * The current version of the theme.
 *
 * @package dobby-the-storekeeper
 */
define( 'DOBBYTS_VERSION', '0.4.0' );


/**
* Navigation
*/
function dobbyts_navigation() {
  register_nav_menu('main-menu',__( 'Main Menu', 'dobbyts'));
}
add_action( 'init', 'dobbyts_navigation' );


/**
 * Enqueue scripts and styles.
 */
function dobbyts_scripts() {

	// Styles.
	wp_enqueue_style( 'styles', get_theme_file_uri( "css/global.min.css" ), array() );
	// Scripts.
	wp_enqueue_script( 'jquery-core' );
	wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.min.js' ), array(), true );

}
add_action( 'wp_enqueue_scripts', 'dobbyts_scripts' );



/**
* WooCommerce --> (./lib/dts-woocommerce-rules.php)
*/
include_once(__DIR__.'/lib/dts-woocommerce-rules.php');