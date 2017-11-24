<?php
/**
 * The current version of the theme.
 *
 * @package dobby-the-storekeeper
 */
define( 'DOBBYTS_VERSION', '0.3.0' );


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
* WooCommerce
*/ 

//WooCommerce support
add_action( 'after_setup_theme', 'dobbyts_woocommerce_support' );

function dobbyts_woocommerce_support() {
  add_theme_support( 'woocommerce' );
}

// Load WooCommerce scripts and styles only if necessary
add_action( 'wp_enqueue_scripts', 'dobbyts_disable_woocommerce_loading_css_js' );
 
function dobbyts_disable_woocommerce_loading_css_js() {
 
	// Check if WooCommerce plugin is active
	if( function_exists( 'is_woocommerce' ) ){
 
		// Check if it's any of WooCommerce page
		if(! is_woocommerce() && ! is_cart() && ! is_checkout() ) { 		
			
			## Dequeue WooCommerce styles
			wp_dequeue_style('woocommerce-layout'); 
			wp_dequeue_style('woocommerce-general'); 
			wp_dequeue_style('woocommerce-smallscreen'); 	
 
			## Dequeue WooCommerce scripts
			wp_dequeue_script('wc-cart-fragments');
			wp_dequeue_script('woocommerce'); 
			wp_dequeue_script('wc-add-to-cart'); 
		
		}
	}	
}

// SIDEBAR WIDGET
function dobbyts_woocommerce_widgets() {

  register_sidebar( array(
    'name'          => 'woo_left_sidebar',
    'id'            => 'woo_left_1',
    'before_widget' => '<div class="sidebar-container">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="sidebar-header">',
    'after_title'   => '</h3>',
  ) );

}
add_action( 'widgets_init', 'dobbyts_woocommerce_widgets' );

// Cart widget
add_filter('woocommerce_add_to_cart_fragments', 'dobbyts_add_to_cart_fragment');
 
function dobbyts_add_to_cart_fragment( $fragments ) {
	
	global $woocommerce;
	ob_start();
	
	?>

	<a class="cart-customlocation" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'dobbyts'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'dobbyts'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	
	<?php
	
	$fragments['a.cart-customlocation'] = ob_get_clean();
	
	return $fragments;	
}

// User account controls (links)
function dobbyts_get_uacs(){
  if ( is_user_logged_in() ) { 
    echo '<a href="'.get_permalink(get_option('WooCommerce_myaccount_page_id')).'" title="'.__('My Account','woocommerce').'">'.__('My Account','woocommerce').'</a>'; 
    echo '<span>/</span>';
    echo '<a href="'.wp_logout_url(get_permalink()).'" title="'.__('logout','wordpress').'">'.__('logout','wordpress').'</a>';
  }else{
    echo '<a data-modal-target="login-form" href="#" title="'.__('Login','woocommerce').'">'.__('Login','woocommerce').'</a>';
    echo '&nbsp;/&nbsp;';
    echo '<a href="'.get_permalink(get_option('WooCommerce_myaccount_page_id')).'" title="'.__('Register','woocommerce').'">'.__('Register','woocommerce').'</a>';
  }
}

// Login widget (use maybe as modal)
function dobbyts_login_widget(){
  if (! is_user_logged_in() ) {  
  	?>
    
    <div class="modal" data-modal-name="login-form" aria-hidden="true" role="dialog" aria-labelby="loginTitle" aria-describedby="loginDescription">
			<div class="modal-container">
				<header>
					<h2 id="loginTitle"><?php _e('Login','dobbyts');?></h2>
					<button data-modal-target="login-form"><i class="fa fa-close"></i></button>
				</header>
				<p id="loginDescription"><?php _e('Please enter your credentials to login','dobbyts');?></p>
				<?php 
					echo woocommerce_login_form();
				?>
			</div>
		</div>

		<?php
  }
}
add_action('wp_footer','dobbyts_login_widget');

// Extra tab for woocommerce

add_filter( 'woocommerce_product_tabs', 'dobbyts_woocommerce_new_tab' );
function dobbyts_woocommerce_new_tab( $tabs ) {
  
  // Adds the new tab
  
  $tabs['cadditional_information_tab'] = array(
    'title'   => __( 'Additional information'),
    'priority'  => 11,
    'callback'  => 'dobbyts_woocommerce_new_tab_content'
  );

  return $tabs;

}
function dobbyts_woocommerce_new_tab_content() {

  // The new tab content
  echo '<h2>'.__('Additional information','dobbyts').'</h2>';
  $content = __('No additional information. Will be added later','dobbyts');
  echo $content;
  
}