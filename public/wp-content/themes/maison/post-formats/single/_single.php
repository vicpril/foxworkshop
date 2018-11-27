<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top-info">
        <div class="entry-meta">
            <div class="meta">
                <span class="author"><?php echo esc_html__('By: ','maison'); 
                // the_author_posts_link(); ?>
                    
                </span>
                <span class="date">
                    <?php 
                    // echo esc_html__('on ','maison'); 
                    ?> <?php the_time( get_option('date_format', 'M d, Y') ); ?></span> 
            </div>
        </div>
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <?php the_title(); ?>
            </h4>
        <?php } ?>
        
        <?php if ( $post_format == 'gallery' ) {
            $gallery = maison_post_gallery( get_the_content(), array( 'size' => 'full' ) );
        ?>
            <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
                <?php echo trim($gallery); ?>
            </div>
        <?php } elseif( $post_format == 'link' ) {
                $format = maison_post_format_link_helper( get_the_content(), get_the_title() );
                $title = $format['title'];
                $link = maison_get_link_attributes( $title );
                $thumb = maison_post_thumbnail('', $link);
                echo trim($thumb);
            } else { ?>
            <div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
                <?php
                    $thumb = maison_post_thumbnail();
                    echo trim($thumb);
                ?>
            </div>
        <?php } ?>
    </div>
	<div class="entry-content-detail">
    	<div class="single-info info-bottom">
            <div class="entry-description">
                <?php
                    if ( $post_format == 'gallery' ) {
                        $gallery_filter = maison_gallery_from_content( get_the_content() );
                        echo trim($gallery_filter['filtered_content']);
                    } else {
                        the_content();
                    }
                ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'maison' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'maison' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
    		<div class="tag-social clearfix">
    			<?php maison_post_tags(); ?>
    			<?php if( maison_get_config('show_blog_social_share', false) ) {
    					get_template_part( 'page-templates/parts/sharebox' );
    				} ?>
    		</div>
    	</div>
    </div>
</article>