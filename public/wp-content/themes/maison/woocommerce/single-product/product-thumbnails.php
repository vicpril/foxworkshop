<?php
/**
 * Single Product Thumbnails
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$id = rand();
global $post, $product, $woocommerce;

$images = $product->get_gallery_image_ids();

if ( in_array(get_post_thumbnail_id(), $images) ) {
    $attachment_ids = $images;
} else {
    $attachment_ids =  array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
}
$columns = 4;
if ( $attachment_ids ) {
    ?>
    
    <div class="thumbnails-image">
        <div class="lite-carousel-play">
            <?php if (count($attachment_ids) > $columns): ?>
                <a class="prev carousel-md" href="#">
                    <span class="fa fa-angle-up"></span>
                </a>
            <?php endif; ?>
            <div data-carousel="lite" data-visible="<?php echo esc_attr($columns); ?>">
                <ul>
                <?php

                foreach ( $attachment_ids as $attachment_id ) {
                    $classes = array( 'thumb-link' );

                    $image_full_link = wp_get_attachment_url( $attachment_id );
                    $image_src = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                    $image_link = isset($image_src[0]) ? $image_src[0] : '';
                    if ( ! $image_link )
                        continue;

                    $image_title    = esc_attr( get_the_title( $attachment_id ) );
                    $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

                    if (maison_get_config('image_lazy_loading')) {
                        $placeholder_image = maison_create_placeholder(array($image_src[1],$image_src[2]));
                        $image = '<img src="'.esc_url($placeholder_image).'" data-src="'.esc_url($image_link).'" class="attachment-shop_thumbnail size-shop_thumbnail unveil-image" title="'.esc_attr($image_title).'" alt="'.esc_attr($image_title).'">';
                    } else {
                        $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                            'title' => $image_title,
                            'alt'   => $image_title,
                            'data-zoom-image'=> $image_link
                        ) );
                    }


                    $image_class = esc_attr( implode( ' ', $classes ) );
                    echo '<li><div class="image-wrapper">';
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-image="%s" class="%s" title="%s">%s</a>', $image_link, $image_full_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
                    echo '</div></li>';
                }

                ?>
                </ul>
            </div>
            <?php if (count($attachment_ids) > $columns): ?>
                <a class="next carousel-md" href="#">
                    <span class="fa fa-angle-down"></span>
                </a>
            <?php endif; ?>
        </div>
        
    </div>
    
    <?php
}
