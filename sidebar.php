<?php
/**
 * The sidebar containing the main widget area
 * Implement your custom sidebar to this file.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dobby-the-storekeeper
 */
?>

<aside id="widget-area">
	<div class="wc-widgets">
		<ul>
			<li>
				<?php dobbyts_get_uacs(); //User account controls ?>
			</li>
			<li>
				<a 	class="cart-customlocation" 
				href="<?php echo wc_get_cart_url(); ?>" 
				title="<?php _e( 'View your shopping cart' ); ?>">
				<?php echo sprintf ( _n( '%d '.__('item'), '%d '.__('items'), WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>&nbsp;/&nbsp;<?php echo WC()->cart->get_cart_total(); ?>		
				</a>
			</li>
		</ul>
	</div>
</aside> <!-- #widget-area -->