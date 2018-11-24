<?php $thumbsize = !isset($thumbsize) ? maison_get_blog_thumbsize() : $thumbsize;?>

<article <?php post_class('post post-grid'); ?>>
    <?php
        $thumb = maison_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <div class="post-grid entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="entry-meta">
            <div class="info">
                <div class="date"><?php the_time( get_option('date_format', 'd M, Y') ); ?></div>
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
            </div>
        </div>
        <?php if (! has_excerpt()) { ?>
            <div class="entry-description"><?php echo maison_substring( get_the_content(), 18, '...' ); ?>
                <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'maison'); ?></a>
            </div>
        <?php } else { ?>
            <div class="entry-description"><?php echo maison_substring( get_the_excerpt(), 18, '...' ); ?>
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'maison'); ?></a></div>
        <?php } ?>
    </div>
</article>