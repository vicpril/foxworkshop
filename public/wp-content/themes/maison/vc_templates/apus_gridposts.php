<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty($loop) ) return;

$this->getLoop($loop);
$args = $this->loop_args;
$posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : 4;
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}
$args['paged'] = $paged;
$loop = new WP_Query($args);

set_query_var( 'thumbsize', $thumbsize );
?>

<div class="widget-blogs no-margin clearfix <?php echo esc_attr($layout_type.' '.$style); ?> <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
        <?php $columns = $grid_columns; ?>
        <?php $post_item = '_single'; ?>
        <?php if ( $layout_type == 'carousel' ): ?>
            <div class="owl-carousel posts owl-carousel-bottom" data-smallmedium="2" data-extrasmall="1" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="true" data-nav="false">
                <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
                    <div class="item">
                        <?php get_template_part( 'post-formats/loop/grid/_item'); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php elseif ( $layout_type == 'grid' ): ?>
            <?php $bcol = 12/$columns; ?>
            <div class="layout-blog style-grid">
                <div class="row">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12">
                            <?php get_template_part( 'post-formats/loop/grid/_item' ); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php elseif ( $layout_type == 'grid-v2' ): ?>
            <?php $bcol = 12/$columns; ?>
            <div class="layout-blog style-grid">
                <div class="row">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12">
                            <?php get_template_part( 'post-formats/loop/grid-v2/_item' ); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <ul class="posts-list">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <li>
                        <?php get_template_part( 'post-formats/loop/list/_item' ); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            
        <?php endif; ?>
    </div>
    <?php if ( isset($show_pagination) && $show_pagination && $layout_type != 'carousel' ): ?>
        <?php maison_pagination( $posts_per_page, $loop->found_posts, $loop->max_num_pages ); ?>
    <?php endif ; ?>
</div>
<?php wp_reset_postdata(); ?>