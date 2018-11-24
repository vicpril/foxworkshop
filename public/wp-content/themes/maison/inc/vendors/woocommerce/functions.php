<?php

function maison_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '500',   // px
            'height'    => '500',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '1200',   // px
            'height'    => '1200',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '170',    // px
            'height'    => '170',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

add_action( 'init', 'maison_woocommerce_setup');


// cart modal
if ( !function_exists('maison_woocommerce_cart_modal') ) {
    function maison_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_maison_add_to_cart_product', 'maison_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_maison_add_to_cart_product', 'maison_woocommerce_cart_modal' );


if ( !function_exists('maison_get_products') ) {
    function maison_get_products($categories = array(), $product_type = 'featured_product', $paged = 1, $post_per_page = -1, $orderby = '', $order = '') {
        global $woocommerce, $wp_query;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $args['orderby'] ) ) {
            if ( 'price' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }

        switch ($product_type) {
            case 'best_selling':
                $args['meta_key']='total_sales';
                $args['orderby']='meta_value_num';
                $args['ignore_sticky_posts']   = 1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'top_rate':
                add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recent_product':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'deals':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['meta_query'][] =  array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => time(),
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
                break;     
            case 'on_sale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $args['post__in'] = $product_ids_on_sale;
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c
                        WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0
                        ORDER BY c.comment_date ASC";
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }

                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = $_pids;

                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $args['tax_query']    = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field'         => 'slug',
                    'terms'         => implode(",", $categories ),
                    'operator'      => 'IN'
                )
            );
        }
        
        return new WP_Query($args);
    }
}

// hooks
if ( !function_exists('maison_woocommerce_enqueue_styles') ) {
    function maison_woocommerce_enqueue_styles() {
        wp_enqueue_style( 'maison-woocommerce', get_template_directory_uri() .'/css/woocommerce.css' , 'maison-woocommerce-front' , MAISON_THEME_VERSION, 'all' );
        if ( is_singular('product') ) {
            // photoswipe
            wp_enqueue_script( 'photoswipe-js', get_template_directory_uri() . '/js/photoswipe/photoswipe.min.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-ui-js', get_template_directory_uri() . '/js/photoswipe/photoswipe-ui-default.min.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-init', get_template_directory_uri() . '/js/photoswipe/photoswipe.init.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_style( 'photoswipe-style', get_template_directory_uri() . '/js/photoswipe/photoswipe.css', array(), '3.2.0' );
            wp_enqueue_style( 'photoswipe-skin-style', get_template_directory_uri() . '/js/photoswipe/default-skin/default-skin.css', array(), '3.2.0' );

            // carousel lite
            wp_enqueue_script( 'carousel-lite-js', get_template_directory_uri() . '/js/jquery.jcarousellite.js', array( 'jquery' ), '20150315', true );
        }
        wp_register_script( 'maison-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'jquery-unveil' ), '20150330', true );
        $options = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'enable_search' => (maison_get_config('enable_autocompleate_search', true) ? '1' : '0'),
            'template' => apply_filters( 'maison_autocompleate_search_template', '<a href="{{url}}" class="media autocompleate-media"><div class="media-left"><img src="{{image}}" class="media-object" height="60" width="60"></div><div class="media-body"><h4>{{{title}}}</h4><p class="price">{{{price}}}</p></div></a>' ),
            'empty_msg' => apply_filters( 'maison_autocompleate_search_empty_msg', esc_html__( 'Unable to find any products that match the currenty query', 'maison' ) ),
            'image_display' => maison_get_config('product_image_display', 'mainimage'),
        );
        wp_localize_script( 'maison-woocommerce', 'maison_woo_options', $options );
        wp_enqueue_script( 'maison-woocommerce' );
        
        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'maison_woocommerce_enqueue_styles', 99 );

// cart
if ( !function_exists('maison_woocommerce_header_add_to_cart_fragment') ) {
    function maison_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['.cart .count'] =  sprintf(_n(' <span class="count"> %d  </span> ', ' <span class="count"> %d </span> ', $woocommerce->cart->cart_contents_count, 'maison'), $woocommerce->cart->cart_contents_count);
        $fragments['.cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'maison_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('maison_woocommerce_breadcrumb_defaults') ) {
    function maison_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = maison_get_config('woo_breadcrumb_image');
        $breadcrumb_color = maison_get_config('woo_breadcrumb_color');
        $style = array();
        $show_breadcrumbs = maison_get_config('show_product_breadcrumbs');
        if (!is_single()) {
            $show_breadcrumbs = maison_get_config('show_products_breadcrumbs');
        }
        if ( !$show_breadcrumbs ) {
            $style[] = 'display:none';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner"><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'maison_woocommerce_breadcrumb_defaults' );
add_action( 'maison_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('maison_woocommerce_display_modes') ) {
    function maison_woocommerce_display_modes(){
        global $wp;
        $current_url = maison_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_mansory  = add_query_arg( 'display_mode', 'mansory', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = maison_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="fa fa-th"></i>'.esc_html__('Grid','maison').'</a>';
        echo '<a href="'.  $url_mansory  .'" class=" change-view '.($woo_mode == 'mansory' ? 'active' : '').'"><i class="fa fa-th"></i>'.esc_html__('Mansory','maison').'</a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="fa fa-th-list"></i>'.esc_html__('List','maison').'</a>';
        echo '</div>'; 
    }
}


if ( !function_exists('maison_woocommerce_get_display_mode') ) {
    function maison_woocommerce_get_display_mode() {
        $woo_mode = maison_get_config('product_display_mode', 'grid');
        $args = array( 'grid', 'grid2','mansory', 'list' );
        if ( isset($_COOKIE['maison_woo_mode']) && in_array($_COOKIE['maison_woo_mode'], $args) ) {
            $woo_mode = $_COOKIE['maison_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('maison_shop_page_link')) {
    function maison_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


if(!function_exists('maison_filter_before')){
    function maison_filter_before(){
        echo '<div class="apus-filter clearfix">';
    }
}
if(!function_exists('maison_filter_after')){
    function maison_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'maison_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'maison_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('maison_before_woocommerce_init') ) {
    function maison_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'maison_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['maison_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'maison_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('maison_woocommerce_shop_per_page') ) {
    function maison_woocommerce_shop_per_page($number) {
        $value = maison_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'maison_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('maison_woocommerce_shop_columns') ) {
    function maison_woocommerce_shop_columns($number) {
        $value = maison_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'maison_woocommerce_shop_columns' );

// share box
if ( !function_exists('maison_woocommerce_share_box') ) {
    function maison_woocommerce_share_box() {
        if ( maison_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'maison_woocommerce_share_box', 100 );


// quickview
if ( !function_exists('maison_woocommerce_quickview') ) {
    function maison_woocommerce_quickview() {
        if ( !empty($_GET['product_id']) ) {
            $args = array(
                'post_type' => 'product',
                'post__in' => array($_GET['product_id'])
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
                while ($query->have_posts()): $query->the_post(); global $product;
                    wc_get_template_part( 'content', 'product-quickview' );
                endwhile;
            }
            wp_reset_postdata();
        }
        die;
    }
}

if ( maison_get_global_config('show_quickview') ) {
    add_action( 'wp_ajax_maison_quickview_product', 'maison_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_maison_quickview_product', 'maison_woocommerce_quickview' );
}

// swap effect
if ( !function_exists('maison_swap_images') ) {
    function maison_swap_images() {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect unveil-image';
        if (has_post_thumbnail()) {
            if ( maison_get_config('product_image_display') == 'swap' ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail = wp_get_attachment_image_src( $attachment_ids[0], 'shop_catalog' );
                    $placeholder_image = maison_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));
                    if ( maison_get_config('image_lazy_loading') ) {
                        $output .= '<img src="' . esc_url( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        $output .= '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, 'shop_catalog' );
            $placeholder_image = maison_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( maison_get_config('image_lazy_loading') ) {
                $output .= '<img src="' . esc_url( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                $output .= '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'maison').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'maison_swap_images', 10);

if ( !function_exists('maison_product_image') ) {
    function maison_product_image($thumb = 'shop_thumbnail') {
        $mode = maison_get_config('product_image_display', 'mainimage');
        switch ($mode) {
            case 'swap':
                ?>
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
                    <?php maison_product_get_image($thumb); ?>
                </a>
                <?php
                break;
            case 'gallery':
                maison_product_images_carousel($thumb);
                break;
            default:
                ?>
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
                    <?php maison_product_get_image($thumb, false); ?>
                </a>
                <?php
                break;
        }
    }
}
// get image
if ( !function_exists('maison_product_get_image') ) {
    function maison_product_get_image($thumb = 'shop_thumbnail', $swap = true) {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect';
        if (has_post_thumbnail()) {
            if ( $swap ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail = wp_get_attachment_image_src( $attachment_ids[0], $thumb );
                    $placeholder_image = maison_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));
                    if ( maison_get_config('image_lazy_loading') ) {
                        $output .= '<img src="' . esc_url( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        $output .= '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $thumb );
            $placeholder_image = maison_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( maison_get_config('image_lazy_loading') ) {
                $output .= '<img src="' . esc_url( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                $output .= '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'maison').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}

// get image
if ( !function_exists('maison_product_images_carousel') ) {
    function maison_product_images_carousel($thumb = 'shop_catalog') {
        global $product;
        
        $output = '';
        $class = 'image-no-effect';

        $images = $product->get_gallery_image_ids();
        $attachment_ids = array();
        if ( has_post_thumbnail() ) {
            $attachment_ids = array( get_post_thumbnail_id() );
        }
        if ( !empty($images) ) {
            $attachment_ids =  array_merge_recursive( $attachment_ids , $images ) ;
        }
        if ( !empty($attachment_ids) ) {
            $output .= '<div class="owl-carousel product-images-gallery" data-items="1" data-carousel="owl" data-medium="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="true"'.(count($attachment_ids) > 1 ? ' data-loop="true"' : '').'>';
            foreach ( $attachment_ids as $attachment_id ) {
                $product_thumbnail_title = get_the_title( $attachment_id );
                $product_thumbnail = wp_get_attachment_image_src( $attachment_id, $thumb );
                $placeholder_image = maison_create_placeholder(array($product_thumbnail[1], $product_thumbnail[2]));

                $output .= '<a title="'.get_the_title().'" href="'.get_the_permalink().'" class="product-image">';
                if ( maison_get_config('image_lazy_loading') ) {
                    $output .= '<img src="' . esc_url( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
                } else {
                    $output .= '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
                }
                $output .= '</a>';
            }
            $output .= '</div>';
        } else {
            $image_sizes = get_option($thumb.'_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];
            $output = '<a title="'.get_the_title().'" href="'.get_the_permalink.'" class="product-image">';
            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'maison').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
            $output .= '</a>';
        }

        echo trim($output);
    }
}

// layout class for woo page
if ( !function_exists('maison_woocommerce_content_class') ) {
    function maison_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( maison_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'maison_woocommerce_content_class', 'maison_woocommerce_content_class' );

// get layout configs
if ( !function_exists('maison_get_woocommerce_layout_configs') ) {
    function maison_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = maison_get_config('product_'.$page.'_left_sidebar');
        $right = maison_get_config('product_'.$page.'_right_sidebar');

        switch ( maison_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs'  );
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs' ); 
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('maison_woocommerce_related_upsells_products') ) {
    function maison_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = maison_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = maison_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'maison_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'maison_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'maison_product_review_tab' ) ) {
    function maison_product_review_tab($tabs) {
        if ( !maison_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'maison_product_review_tab', 100 );

if ( !function_exists( 'maison_minicart') ) {
    function maison_minicart() {
        $template = apply_filters( 'maison_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'maison_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'maison_woocomerce_icon_wishlist_add' );
function maison_woocomerce_icon_wishlist( $value='' ){
    return '<i class="ion-android-favorite-outline"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','maison').'</span>';
}

function maison_woocomerce_icon_wishlist_add(){
    return '<i class="ion-heart"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','maison').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

function maison_woocommerce_get_ajax_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';
    $columns = isset($_POST['columns']) ? $_POST['columns'] : 4;
    $number = isset($_POST['number']) ? $_POST['number'] : 4;
    $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $load_type = isset($_POST['load_type']) ? $_POST['load_type'] : '';
    $view_more = isset($_POST['view_more']) ? $_POST['view_more'] : '';
    $layout_type = isset($_POST['layout_type']) ? $_POST['layout_type'] : 'grid';

    $categories_id = !empty($categories) ? array($categories) : array();
    $loop = maison_get_products( $categories_id, $product_type, $page, $number );
    if ( $loop->have_posts()) {
        if ($load_type == 'products') {
            if ( $layout_type == 'mansory' ) {
                 wc_get_template( 'layout-products/mansory.php' , array( 'loop' => $loop, 'ajax' => true ) );
            } else {
                global $woocommerce_loop; 
                $woocommerce_loop['columns'] = $columns;
                while ( $loop->have_posts() ) : $loop->the_post(); global $product;
                    wc_get_template( 'content-products.php', array('product_item' => 'inner') );
                endwhile;
                wp_reset_postdata();
            }
        } else {
            $max_pages = $loop->max_num_pages;
            wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
            if ($view_more) {
            ?>
            <div class="clearfix load-product text-center space-tb-30">
                <a class="viewmore-products-btn<?php echo esc_attr($max_pages <= 1 ? ' hidden' : ''); ?>" href="#" data-max-page="<?php echo esc_attr($max_pages); ?>"><?php esc_html_e('View More', 'maison'); ?></a>
                <p class="all-products-loaded<?php echo esc_attr($max_pages > 1 ? ' hidden' : ''); ?>"><?php esc_html_e('All Products Loaded', 'maison'); ?></p>
            </div>
            <?php
            }
        }
    }
    exit();
}
add_action( 'wp_ajax_apus_get_products', 'maison_woocommerce_get_ajax_products' );
add_action( 'wp_ajax_nopriv_apus_get_products', 'maison_woocommerce_get_ajax_products' );

function maison_woocommerce_photoswipe() {
    if ( !is_singular('product') ) {
        return;
    }
    ?>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>

        <div class="pswp__scroll-wrap">

          <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
          </div>

          <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="<?php echo esc_html__('Close (Esc)', 'maison'); ?>"></button>
                <button class="pswp__button pswp__button--share" title="<?php echo esc_html__('Share', 'maison'); ?>"></button>
                <button class="pswp__button pswp__button--fs" title="<?php echo esc_html__('Toggle fullscreen', 'maison'); ?>"></button>
                <button class="pswp__button pswp__button--zoom" title="<?php echo esc_html__('Zoom in/out', 'maison'); ?>"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="<?php echo esc_html__('Previous (arrow left)', 'maison'); ?>"></button>
            <button class="pswp__button pswp__button--arrow--right" title="<?php echo esc_html__('Next (arrow right)', 'maison'); ?>"></button>
            <div class="pswp__caption">
              <div class="pswp__caption__center">
              </div>
            </div>
          </div>

        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'maison_woocommerce_photoswipe' );

function maison_next_post_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    return '<div class="next-product product-nav">
        <a href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'" title="'.esc_html__('Next','maison').'" >
            <i class="ion-ios-arrow-right" aria-hidden="true"></i>
        </a>
        </div>';
}

add_filter( 'next_post_link', 'maison_next_post_link', 100, 5 );

function maison_previous_post_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    return '<div class="previous-product product-nav">
        <a href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'"  title="'.esc_html__('Prev','maison').'" >
            <i class="ion-ios-arrow-left" aria-hidden="true"></i>
        </a>
        </div>';
}
add_filter( 'previous_post_link', 'maison_previous_post_link', 100, 5 );


/*
 * Start for only Maison theme
 */
function maison_is_ajax_request() {
    if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

function maison_wc_product_dropdown_categories( $args = array() ) {
    global $wp_query;

    $current_product_cat = isset( $wp_query->query_vars['product_cat'] ) ? $wp_query->query_vars['product_cat'] : '';
    $defaults            = array(
        'pad_counts'         => 1,
        'show_count'         => 1,
        'hierarchical'       => 1,
        'hide_empty'         => 1,
        'show_uncategorized' => 1,
        'orderby'            => 'name',
        'selected'           => $current_product_cat,
        'menu_order'         => false,
        'option_select_text' => esc_html__( 'All', 'maison' ),
    );

    $args = wp_parse_args( $args, $defaults );

    if ( 'order' === $args['orderby'] ) {
        $args['menu_order'] = 'asc';
        $args['orderby']    = 'name';
    }

    $terms = get_terms( 'product_cat', apply_filters( 'wc_product_dropdown_categories_get_terms_args', $args ) );

    if ( empty( $terms ) ) {
        return;
    }
    $shop_page_id = wc_get_page_id( 'shop' );
    $shopurl = esc_url ( get_permalink( $shop_page_id ) );

    $count_products = wp_count_posts('product');
    
    $count = 0;
    if ( !empty($count_products) ) {
        $count = (int)$count_products->publish;
    }

    $output  = "<ul>";
    $output .= '<li ' . ( $current_product_cat == '' ? 'class="active"' : '' ) . '>'
            . '<a href="'.esc_url($shopurl).'">'
            . esc_html( $args['option_select_text'] ) . ' ('.$count.')' 
            . '</a>'
            . '</li>';
    $output .= maison_wc_walk_category_dropdown_tree( $terms, 0, $args );
    $output .= "</ul>";

    echo trim($output);
}

function maison_wc_walk_category_dropdown_tree() {
    $args = func_get_args();

    // the user's options are the third parameter
    if ( empty( $args[2]['walker'] ) || ! is_a( $args[2]['walker'], 'Walker' ) ) {
        $walker = new Maison_WC_Product_Cat_Dropdown_Walker;
    } else {
        $walker = $args[2]['walker'];
    }

    return call_user_func_array( array( &$walker, 'walk' ), $args );
}

function maison_category_menu_create_list( $term, $active_id ) {
    $class = '';
    if ( $active_id == $term->term_id ) {
        $class = ' class="current-cat"';
    }
    return '<li'. $class .'><a href="' . esc_url( get_term_link( (int) $term->term_id, 'product_cat' ) ) . '">' . esc_attr( $term->name ) . '<span class="product-count">'. $term->count .'<span>' . '</a></li>';
}

/*
 *  Product category menu
 */
if ( ! function_exists( 'maison_category_menu' ) ) {
    function maison_category_menu() {
        global $wp_query;

        $active_id = is_tax( 'product_cat' ) ? $wp_query->queried_object->term_id : '';
        $is_category = (int)$active_id > 0 ? true : false;
        $shop_categories_top_level = apply_filters( 'shop_categories_top_level', true );

        if ( !$shop_categories_top_level && $is_category ) {
            maison_sub_category_menu_output( $active_id );
        } else {
            maison_category_menu_output( $is_category, $active_id );
        }
    }
}


/*
 *  Product category menu: Output
 */
function maison_category_menu_output( $is_category, $active_id, $hide_empty = true ) {
    global $wp_query;
    
    $shop_page_id = wc_get_page_id( 'shop' );
    $hide_sub = true;
    $shop_class = '';
                                                               
    if ( $is_category ) {
        $hide_sub = false;
        $args = array(
            'fields'        => 'ids',
            'parent'        => $active_id,
            'hierarchical'  => true,
            'hide_empty'    => $hide_empty
        );
        $children_term = get_terms( 'product_cat', $args );
        $category_has_children = empty( $children_term ) ? false : true;
    } else {
        if ( !is_product_tag() && !isset( $_REQUEST['s'] ) ) {
            $shop_class = ' class="current-cat"';
        }
    }
    
    $count = 0;
    $count_products = wp_count_posts('product');
    if ( !empty($count_products) ) {
        $count = (int)$count_products->publish;
    }

    $output = '<li' . $shop_class . '><a href="' . esc_url ( get_permalink( $shop_page_id ) ) . '">' . esc_html__( 'All', 'maison' ) . '<span class="product-count">'.$count.'</span>' . '</a></li>';
    $sub_output = '';
    
    $categories = get_categories( array(
        'type'          => 'post',
        'orderby'       => 'slug',
        'order'         => 'asc',
        'hide_empty'    => $hide_empty,
        'hierarchical'  => 1,
        'taxonomy'      => 'product_cat'
    ) );

    foreach( $categories as $category ) {
        if ( $category->parent != '0' ) {
            if ( !$hide_sub ) {
                if ( $category->term_id == $active_id || $category->parent == $active_id || !$category_has_children && $category->parent == $wp_query->queried_object->parent ) {
                    $sub_output .= maison_category_menu_create_list( $category, $active_id );
                }
            }
        } else {
            $output .= maison_category_menu_create_list( $category, $active_id );
        }
    }
    
    if ( strlen( $sub_output ) > 0 ) {
        $sub_output = '<ul class="apus-shop-sub-categories">' . $sub_output . '</ul>';
    }
    
    echo trim($output . $sub_output);
}

// display sub categories
function maison_sub_category_menu_output( $active_id, $hide_empty = true ) {
    global $wp_query;
    
    $output_sub_terms = '';
    
    $sub_terms = get_categories( array(
        'type'          => 'post',
        'parent'        => $active_id,
        'orderby'       => 'slug',
        'order'         => 'asc',
        'hide_empty'    => $hide_empty,
        'hierarchical'  => 1,
        'taxonomy'      => 'product_cat'
    ) );
    
    $has_sub_terms = ( empty( $sub_terms ) ) ? false : true;
    
    if ( $has_sub_terms ) {
        $current_cat_name = apply_filters( 'maison_shop_parent_category_title', $wp_query->queried_object->name );
        
        foreach ( $sub_terms as $term ) {
            $output_sub_terms .= maison_category_menu_create_list( $term, $active_id );
        }
    } else {
        $current_cat_name = $wp_query->queried_object->name;
    }
    
    $output_current_cat = '<li class="current-cat"><a href="' . esc_url( get_term_link( (int)$active_id, 'product_cat' ) ) . '">' . esc_html( $current_cat_name ) . '</a></li>';
    
    echo trim($output_current_cat . $output_sub_terms);
}

function maison_count_filtered() {
    $return = 0;
    if ( isset($_GET['min_price']) && isset($_GET['max_price']) ) {
        $return++;
    }
    // filter by attributes
    $attribute_taxonomies = wc_get_attribute_taxonomies();

    if ( ! empty( $attribute_taxonomies ) ) {
        foreach ( $attribute_taxonomies as $tax ) {
            if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
                if ( isset($_GET['filter_'.$tax->attribute_name]) ) {
                    $return++;
                }
            }
        }
    }
    return $return;
}

// disable shop title
function maison_woo_disable_shop_title($return) {
    return false;
}
add_filter( 'woocommerce_show_page_title', 'maison_woo_disable_shop_title' );
// remove shop and archive descripton
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

// add to maison
add_action( 'maison_woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'maison_woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );