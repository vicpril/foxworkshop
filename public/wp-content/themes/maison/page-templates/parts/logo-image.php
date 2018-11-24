<?php
    $logo = maison_get_config('media-logo');
?>

<?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
    <div class="logo logo-image">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php else: ?>
    <div class="logo logo-image logo-theme">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo-image.jpg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php endif; ?>