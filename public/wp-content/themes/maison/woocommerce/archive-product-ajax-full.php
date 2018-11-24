<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// page title
?>

<div id="apus-wp-title"><?php echo wp_title( '&ndash;', false, 'right' ); ?></div>

<?php
	// shop header
	if ( maison_get_config('product_archive_top_sidebar', true) ) {
		get_template_part( 'woocommerce/content-shop_header' );
	}
	$display_mode = maison_woocommerce_get_display_mode();
?>

<div id="apus-shop-products-wrapper" class="apus-shop-products-wrapper" data-layout_type="<?php echo esc_attr($display_mode); ?>">
<?php
	// results 
	get_template_part( 'woocommerce/content-shop_results_bar' );
	
	// description
	if ( is_product_taxonomy() ) {
		/**
		 * woocommerce_archive_description hook
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	}
	
	if ( have_posts() ) {

		global $woocommerce_loop;
		
		woocommerce_product_loop_start();
            ?>
            <?php woocommerce_product_subcategories( array( 'before' => '<div class="row subcategories-wrapper">', 'after' => '</div>' ) ); ?>
            
            <?php
				$display_mode = maison_woocommerce_get_display_mode();
				$attr = 'class="products-wrapper-'.esc_attr($display_mode).'"';
				if ( $display_mode == 'mansory1' ) {
					$attr = 'class="products-wrapper-mansory isotope-items" data-isotope-duration="400" data-columnwidth=".col-md-4"';
				} elseif ( $display_mode == 'mansory2' ) {
					$attr = 'class="products-wrapper-mansory grid-style-1 row isotope-items" data-isotope-duration="400" data-columnwidth=".col-md-3"';
				}
			?>
			<div <?php echo trim($attr); ?>>
				<?php if ( $display_mode !== 'mansory1' && $display_mode !== 'mansory2' ) { ?>
					<div class="row">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>
						<?php endwhile; // end of the loop. ?>
					</div>
				<?php } else { ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
				<?php } ?>
			</div>
            <?php
		woocommerce_product_loop_end();
		
		do_action( 'woocommerce_after_shop_loop' );
		do_action( 'woocommerce_after_main_content' );
		
	} elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {

		wc_get_template( 'loop/no-products-found.php' );

	}
?>
</div>
