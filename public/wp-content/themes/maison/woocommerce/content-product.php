<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
	
$woo_display = maison_woocommerce_get_display_mode();
if ( $woo_display == 'list' ) { 	
$classes[] = 'list-products col-xs-12';
?>
	<div <?php wc_product_class( $classes ); ?>>
	 	<?php wc_get_template_part( 'item-product/inner-list' ); ?>
	</div>
<?php
} elseif ( $woo_display == 'mansory1' ){
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
		$nb_per_page = maison_get_config('number_products_per_page', 12);
		if ( isset($current_page) ) {
			$woocommerce_loop['loop'] = ((int)$current_page - 1) * $nb_per_page;
		}
	}
	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) {
		return;
	}
	$args = array();
	if ( $woocommerce_loop['loop']%7 == 0 || $woocommerce_loop['loop']%7 == 6 ) {
		$classes[] = 'col-md-8 col-sm-6 col-xs-6 isotope-item '.esc_attr(maison_get_config('product_item_style', 'grid2'));
		$args = array('image_size' => 'maison-shop-horizontal');
	} else {
		$classes[] = 'col-md-4 col-sm-6 col-xs-6 isotope-item '.esc_attr(maison_get_config('product_item_style', 'grid2'));
	}
	?>
	<div <?php wc_product_class( $classes ); ?>>
	 	<?php wc_get_template( 'item-product/inner.php', $args ); ?>
	</div>

<?php
} elseif ( $woo_display == 'mansory2' ){
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
		$nb_per_page = maison_get_config('number_products_per_page', 12);
		if ( isset($current_page) ) {
			$woocommerce_loop['loop'] = ((int)$current_page - 1) * $nb_per_page;
		}
	}
	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) {
		return;
	}
	$args = array();
	if ( in_array($woocommerce_loop['loop']%10, array(0,5,8,9)) ) {
		$classes[] = 'col-md-6 col-xs-6 isotope-item '.esc_attr(maison_get_config('product_item_style', 'grid2'));
		$args = array('image_size' => 'maison-shop-horizontal');
	} elseif ( in_array($woocommerce_loop['loop']%10, array(1,4)) ) {
		$classes[] = 'col-md-6 isotope-item '.esc_attr(maison_get_config('product_item_style', 'grid2'));
		$args = array('image_size' => 'maison-shop-vertical');
	} elseif ( in_array($woocommerce_loop['loop']%10, array(2,3,6,7)) ) {
		$classes[] = 'col-md-3 isotope-item '.esc_attr(maison_get_config('product_item_style', 'grid2'));
	}
	?>
	<div <?php wc_product_class( $classes ); ?>>
	 	<?php wc_get_template( 'item-product/inner.php', $args ); ?>
	</div>

<?php
} else {

	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}
	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) {
		return;
	}

	$columns = 12/$woocommerce_loop['columns'];

	$classes[] = 'col-md-'.$columns.' col-sm-6 col-xs-6 '.esc_attr(maison_get_config('product_item_style', 'grid2'));
	?>
	<div <?php wc_product_class( $classes ); ?>>
		<?php wc_get_template_part( 'item-product/inner' ); ?>
	</div>
<?php } ?>