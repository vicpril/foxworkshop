<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	}

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('details-product'); ?>>
	<div class="row top-content">
		<div class="breadcrumb-nav-wrapper clearfix">
			<?php do_action( 'maison_woo_template_main_before' ); ?>
			<?php if ( maison_get_config('show_product_nav') ) { ?>
				<div class="product-navs">
					<?php the_post_navigation(); ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-md-7 col-xs-12">
			<div class="image-mains">
				<?php
					/**
					 * woocommerce_before_single_product_summary hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
					do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
		</div>
		<div class="col-md-5 col-xs-12">
			<div class="information">
				<div class="summary entry-summary ">

					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						//remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
						remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
						remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
						remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
						remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
						remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
						//remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);


						add_action('woocommerce_single_product_summary','woocommerce_template_single_price', 31);
						add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt', 35);
						add_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 40);
						add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',45);

						add_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 47);
						
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div><!-- .summary -->
			</div>
		</div>
			
	</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>