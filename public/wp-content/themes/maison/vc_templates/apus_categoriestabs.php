<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = maison_random_key();

if (isset($categoriestabs) && !empty($categoriestabs)):
    $categoriestabs = (array) vc_param_group_parse_atts( $categoriestabs );
    $i = 0;
?>

    <div class="widget widget-categoriestabs <?php echo esc_attr($el_class); ?>">
        <div class="widget-content woocommerce tab-selector">
            <ul role="tablist" class="nav nav-tabs" data-load="ajax">
                <?php foreach ($categoriestabs as $tab) : ?>
                    <?php $category = get_term_by( 'slug', $tab['category'], 'product_cat' ); ?>
                    <li<?php echo ($i == 0 ? ' class="active"' : ''); ?>>
                        <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab['category']); ?>">
                            <?php if ( !empty($tab['title']) ) { ?>
                                <?php echo trim($tab['title']); ?>
                            <?php } else { ?>
                                <?php echo trim($category->name); ?>
                            <?php } ?>
                            
                            <?php if ( $show_number_products ) { ?>
                                <span class="product-count"><?php echo trim($category->count); ?></span>
                            <?php } ?>
                        </a>
                    </li>
                <?php $i++; endforeach; ?>
            </ul>
            <div class="widget-inner">
                <div class="tab-content">
                    <?php $i = 0; foreach ($categoriestabs as $tab) : ?>
                        <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab['category']); ?>" class="tab-pane <?php echo ($i == 0 ? 'active' : ''); ?>" data-loaded="<?php echo ($i == 0 ? 'true' : 'false'); ?>" data-number="<?php echo esc_attr($number); ?>" data-categories="<?php echo esc_attr($tab['category']); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-product_type="<?php echo esc_attr($type); ?>" data-page="1" data-view_more="<?php echo esc_attr($load_more); ?>" data-layout_type="<?php echo esc_attr($layout_type); ?>">

                            <div class="tab-content-products">
                                <?php if ( $i == 0 ): ?>
                                    <?php $loop = maison_get_products( array($tab['category']), $type, 1, $number ); $max_pages = $loop->max_num_pages; ?>
                                    <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) ); ?>

                                    <!-- paging -->
                                    <?php if ($load_more): ?>
                                        <div class="clearfix load-product text-center space-tb-30">
                                            <a class="viewmore-products-btn<?php echo esc_attr($max_pages <= 1 ? ' hidden' : ''); ?>" href="#" data-max-page="<?php echo esc_attr($max_pages); ?>"><?php esc_html_e('Load More', 'maison'); ?></a>
                                            <p class="all-products-loaded<?php echo esc_attr($max_pages > 1 ? ' hidden' : ''); ?>"><?php esc_html_e('All Products Loaded', 'maison'); ?></p>
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
            </div>
            
        </div>
    </div>
<?php endif; ?>