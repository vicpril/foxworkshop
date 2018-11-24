<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $_REQUEST['load_type'] ) && maison_is_ajax_request() ) {
	if ( $_REQUEST['load_type'] !== 'products' ) {
        wc_get_template_part( 'archive', 'product-ajax-full' );
	} else {
        wc_get_template_part( 'archive', 'product-ajax-products' );
	}
} else {
    wc_get_template_part( 'archive', 'product-full' );
}