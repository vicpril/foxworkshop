<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Maison
 * @since Maison 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	if ( !function_exists( 'wp_site_icon' ) ) {
		$favicon = maison_get_config('media-favicon');
		if ( (isset($favicon['url'])) && (trim($favicon['url']) != "" ) ) {
	        if (is_ssl()) {
	            $favicon_image_img = str_replace("http://", "https://", $favicon['url']);		
	        } else {
	            $favicon_image_img = $favicon['url'];
	        }
		?>
	    	<link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
	    <?php } ?>
    <?php } ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( maison_get_config('preload', true) ) { ?>
	<div class="apus-page-loading">
	  	<div id="loader"></div>
	  	<div class="loader-section section-left"></div>
	  	<div class="loader-section section-right"></div>
	</div>
<?php } ?>
<div id="wrapper-container" class="wrapper-container">

	<?php get_template_part( 'headers/mobile/offcanvas-menu' ); ?>

	<?php get_template_part( 'headers/mobile/header-mobile' ); ?>

	<?php $header = apply_filters( 'maison_get_header_layout', maison_get_config('header_type') );
		if ( empty($header) ) {
			$header = 'v4';
		}
	?>
	<?php get_template_part( 'headers/'.$header ); ?>

	<?php if ( has_nav_menu( 'top-menu' ) || is_active_sidebar( 'sidebar-socials' )) : ?>   
        <div class="main-menu-top">
            <div class="clearfix top-header text-right">
                <span class="hidden-menu"><?php echo esc_html__('Close','maison') ?></span>
            </div>
            <nav data-duration="400" class="hidden-xs hidden-sm slide animate navbar" role="navigation">
            <?php
                $args = array(
                    'theme_location'  => 'top-menu',
                    'menu_class'      => 'nav navbar-nav top-menu',
                    'fallback_cb'     => '',
                    'menu_id'         => 'top-menu'
                );
                wp_nav_menu($args);
            ?>
            </nav>
            <?php if ( is_active_sidebar( 'sidebar-socials' ) ) { ?>
                <?php dynamic_sidebar( 'sidebar-socials' ); ?>
            <?php } ?>
        </div>
    <?php endif; ?>
    <div class="full-search">
        <div class="container">
            <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
        </div>
    </div>
    <div class="over-dark"></div>

	<div id="apus-main-content">