<?php
/**
 * maison functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Maison
 * @since Maison 1.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since maison 1.1
 */
define( 'MAISON_THEME_VERSION', '1.1' );
define( 'MAISON_DEMO_MODE', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'maison_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Maison 1.0
 */
function maison_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on maison, use a find and replace
	 * to change 'maison' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'maison', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 750, true );
	add_image_size( 'maison-shop-horizontal', 770, 370, true );
	add_image_size( 'maison-shop-vertical', 585, 792, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'maison' ),
		'top-menu' => esc_html__( 'Top Menu', 'maison' ),
		'primary-left' => esc_html__( 'Primary Menu Left', 'maison' ),
		'primary-right' => esc_html__( 'Primary Menu Right', 'maison' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = maison_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'maison_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	add_editor_style( array( 'css/template.css' ) );

	maison_get_load_plugins();
}
endif; // maison_setup
add_action( 'after_setup_theme', 'maison_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @since Maison 1.0
 */
function maison_scripts() {
	// Load our main stylesheet.

	//load font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.5.0' );
	
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.css', array(), '2.0.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.5.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.css', array(), '3.2.0' );
	} else {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.2.0' );
	}
	
	wp_enqueue_style( 'maison-template', get_template_directory_uri() . '/css/template.css', array(), '3.2' );
	$footer_style = maison_print_style_footer();
	if ( !empty($footer_style) ) {
		wp_add_inline_style( 'maison-template', $footer_style );
	}
	$custom_style = maison_custom_styles();
	if ( !empty($custom_style) ) {
		wp_add_inline_style( 'maison-template', $custom_style );
	}
	wp_enqueue_style( 'maison-style', get_template_directory_uri() . '/style.css', array(), '3.2' );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.0.0', true );
	
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/magnific/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/js/magnific/magnific-popup.css', array(), '1.1.0' );

	wp_enqueue_script( 'jquery-unveil', get_template_directory_uri() . '/js/jquery.unveil.js', array( 'jquery' ), '1.1.0', true );
	
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '0.6.12', true );
	wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/css/perfect-scrollbar.css', array(), '0.6.12' );
	
	wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri() . '/js/mmenu/jquery.mmenu.js', array( 'jquery' ), '0.6.12', true );
	wp_enqueue_style( 'jquery-mmenu', get_template_directory_uri() . '/js/mmenu/jquery.mmenu.css', array(), '0.6.12' );

	wp_register_script( 'maison-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'maison-script', 'maison_ajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
	wp_enqueue_script( 'maison-script' );

	if ( maison_get_config('custom_js') != "" ) {
		wp_add_inline_script( 'maison-script', maison_get_config('custom_js') );
	}
	wp_add_inline_script( 'maison-script', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'maison_scripts', 100 );

/**
 * Display descriptions in main navigation.
 *
 * @since Maison 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function maison_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'maison_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Maison 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function maison_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'maison_search_form_modify' );

/**
 * Function get opt_name
 *
 */
function maison_get_opt_name() {
	return 'maison_theme_options';
}
add_filter( 'apus_framework_get_opt_name', 'maison_get_opt_name' );


function maison_register_demo_mode() {
	if ( defined('MAISON_DEMO_MODE') && MAISON_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_framework_register_demo_mode', 'maison_register_demo_mode' );

function maison_get_demo_preset() {
	$preset = '';
    if ( defined('MAISON_DEMO_MODE') && MAISON_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_framework_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_framework_preset_default' );
        }
    }
    return $preset;
}

function maison_register_post_types($post_types) {
	foreach ($post_types as $key => $post_type) {
		if ( $post_type == 'brand' ) {
			unset($post_types[$key]);
		}
	}
	return $post_types;
}
add_filter( 'apus_framework_register_post_types', 'maison_register_post_types' );

function maison_get_config($name, $default = '') {
	global $apus_options;
    if ( isset($apus_options[$name]) ) {
        return $apus_options[$name];
    }
    return $default;
}

function maison_get_global_config($name, $default = '') {
	$options = get_option( 'maison_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function maison_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'maison' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'maison' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Socials', 'maison' ),
		'id'            => 'sidebar-socials',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'maison' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog left sidebar', 'maison' ),
		'id'            => 'blog-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'maison' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'maison' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'maison' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Sidebar', 'maison' ),
		'id' 				=> 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'maison' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Top Filter Sidebar', 'maison' ),
		'id' 				=> 'shop-top-filter-sidebar',
		'before_widget'		=> '<div class="col-md-cus-5 perfect-scroll  %2$s">',
		'after_widget' 		=> '</div></div></div>',
		'before_title' 		=> '<h3 class="apus-widget-title">',
		'after_title' 		=> '</h3><div class="apus-widget-content"><div class="apus-widget-scroll">'
	));
}
add_action( 'widgets_init', 'maison_widgets_init' );

function maison_get_load_plugins() {

	$plugins[] = array(
		'name'                     => esc_html__( 'Apus Framework For Themes', 'maison' ),
        'slug'                     => 'apus-framework',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/apus-framework.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'WPBakery Visual Composer', 'maison' ),
	    'slug'                     => 'js_composer',
	    'required'                 => true,
	    'source'				   => get_template_directory() . '/inc/plugins/js_composer.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Revolution Slider', 'maison' ),
        'slug'                     => 'revslider',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Cmb2', 'maison' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'maison' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Contact Form 7', 'maison' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Woocommerce', 'maison' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	);

	$plugins[] =(array(
		'name'                     => esc_html__( 'YITH WooCommerce Wishlist', 'maison' ),
	    'slug'                     => 'yith-woocommerce-wishlist',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'WooCommerce Quantity Increment', 'maison' ),
	    'slug'                     => 'woocommerce-quantity-increment',
	    'required'                 =>  true
	));

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';

if ( defined( 'APUS_FRAMEWORK_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'MAISON_REDUX_FRAMEWORK_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	define( 'MAISON_CMB2_ACTIVED', true );
}
if( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/visualcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/google-maps-styles.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-theme.php';
	define( 'MAISON_VISUALCOMPOSER_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-search.php';
	require get_template_directory() . '/inc/vendors/woocommerce/vc-map.php';
	require get_template_directory() . '/inc/vendors/woocommerce/walk-category.php';
	require get_template_directory() . '/inc/vendors/woocommerce/woo-custom.php';
	define( 'MAISON_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'apus-framework/apus-framework.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/widgets/contact-info.php';
	require get_template_directory() . '/inc/widgets/custom_menu.php';
	require get_template_directory() . '/inc/widgets/posts.php';
	require get_template_directory() . '/inc/widgets/recent_comment.php';
	require get_template_directory() . '/inc/widgets/recent_post.php';
	require get_template_directory() . '/inc/widgets/search.php';
	require get_template_directory() . '/inc/widgets/single_image.php';
	require get_template_directory() . '/inc/widgets/socials.php';
	require get_template_directory() . '/inc/widgets/top_rate.php';
	require get_template_directory() . '/inc/widgets/video.php';
	require get_template_directory() . '/inc/widgets/woo-price-filter.php';
	require get_template_directory() . '/inc/widgets/woo-product-sorting.php';
	define( 'MAISON_FRAMEWORK_ACTIVED', true );
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';