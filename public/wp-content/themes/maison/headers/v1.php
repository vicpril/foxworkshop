<header id="apus-header" class="apus-header header-v1 hidden-sm hidden-xs" role="banner">
    <div class="<?php echo (maison_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (maison_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="header-middle">
                <div class="container">
                    <div class="p-relative">
                        <div class="row table-visiable">
                            <div class="col-xs-12 col-md-2">
                                <div class="logo-in-theme ">
                                    <?php get_template_part( 'page-templates/parts/logo' ); ?>
                                </div>
                            </div>
                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="col-xs-12 col-md-8 p-static">
                                <div class="main-menu menu-center">
                                    <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar p-static" role="navigation">
                                    <?php   $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse no-padding',
                                            'menu_class' => 'nav navbar-nav megamenu',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Maison_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            
                            <div class="col-md-2 col-xs-12 hidden-xs">
                                <?php if ( maison_get_config('show_settingmenu') && has_nav_menu( 'top-menu' ) ): ?>
                                    <div class="pull-right menu-top">
                                        <span class="show-top-menu"><i class="ion-android-menu"></i></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ( defined('MAISON_WOOCOMMERCE_ACTIVED') && maison_get_config('show_cartbtn') ): ?>
                                    <div class="pull-right">
                                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( maison_get_config('show_searchform') ): ?>
                                    <div class="pull-right">
                                        <div class="apus-search-top dropdown clearfix">
                                            <button type="button" class="button-show-search dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-search"></i></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>