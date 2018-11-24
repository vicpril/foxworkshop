<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
$pagination_type = maison_get_config('product_pagination', 'default');
if ( $pagination_type == 'loadmore' || $pagination_type == 'infinite' ) {
?>
	<div class="ajax-pagination <?php echo trim($pagination_type == 'loadmore' ? 'loadmore-action' : 'infinite-action'); ?>">
		<div class="apus-pagination-next-link hidden"><?php next_posts_link( '&nbsp;' ); ?></div>
		<a href="#" class="apus-loadmore-btn"><?php esc_html_e( 'Load More', 'maison' ); ?></a>
		<a href="#" class="apus-allproducts"><?php esc_html_e( 'All products loaded.', 'maison' ); ?></a>
	</div>
<?php
} else {
	$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
	$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
	$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
	$format  = isset( $format ) ? $format : '';

	if ( $total <= 1 ) {
		return;
	}
	?>
	<div class="apus-pagination">
		<?php
			echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
				'base'         => $base,
				'format'       => $format,
				'add_args'     => false,
				'current'      => max( 1, $current ),
				'total'        => $total,
				'prev_text'    => '&larr;',
				'next_text'    => '&rarr;',
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3,
			) ) );
		?>
	</div>
<?php }