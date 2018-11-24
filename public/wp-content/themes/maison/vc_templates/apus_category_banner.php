<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (isset($categoriesbanners) && !empty($categoriesbanners)):
    $categoriesbanners = (array) vc_param_group_parse_atts( $categoriesbanners );
	?>
	<div class="widget-categorybanner <?php echo esc_attr($el_class.' '.$layout_type.' '.$align); ?>">
		<?php if ( $layout_type == 'carousel' ) { ?>
			<div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-medium="3" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
			    <?php foreach ($categoriesbanners as $item) { ?>
			    	<?php
		    		$category = get_term_by( 'slug', $item['category'], 'product_cat' );
		    		if ( !empty($category) ) {
			    	?>	
			    		<div class="grid-banner-category grid-banner-category-large ">
					        <div class="item category-wrapper">
				                <?php
					                if ( isset($item['image']) && $item['image'] ) {
					                	$image = wp_get_attachment_image_src($item['image'],'full');
					                	maison_display_image($image);
					                }
				                ?>
				                <div class="category-meta">
				                	<h2 class="title">
				                		<?php if ( !empty($title) ) { ?>
			                                <?php echo trim($title); ?>
			                            <?php } else { ?>
			                                <?php echo trim($category->name); ?>
			                            <?php } ?>
			                            <?php if ( $show_number_products ) { ?>
			                            	<span class="product-count"><?php echo trim($category->count); ?></span>
			                            <?php } ?>
			                        </h2>
			                        <?php if ( !empty($item['btn_text']) ) { ?>
				                        	<a href="<?php echo esc_url(get_term_link($category)); ?>" class="readmore"> <span data-hover="<?php echo trim($item['btn_text']); ?>"> <?php echo trim($item['btn_text']); ?></span></a>
				                        <?php } ?>
				                </div>
					        </div>
				        </div>
		    	<?php } ?>
			    <?php } ?>
			</div>
		<?php } elseif ( $layout_type == 'grid' ) { ?>
			<div class="row grid-style-2 grid-banner-category ">
			    <?php $i=0; foreach ($categoriesbanners as $item) { ?>
			    	<?php
		    		$category = get_term_by( 'slug', $item['category'], 'product_cat' );
		    		if ( !empty($category) ) {
			    	?>
				        <div class="col-md-<?php echo ($i%4 == 0 || $i%4 == 3 ? '8' : '4'); ?>">
					        <div class="item category-wrapper">
				                <?php
					                if ( isset($item['image']) && $item['image'] ) {
					                	$image = wp_get_attachment_image_src($item['image'],'full');
					                	maison_display_image($image);
					                }
				                ?>
				                <div class="category-meta">
				                	<h2 class="title">
				                		<?php if ( !empty($title) ) { ?>
			                                <?php echo trim($title); ?>
			                            <?php } else { ?>
			                                <?php echo trim($category->name); ?>
			                            <?php } ?>
			                            <?php if ( $show_number_products ) { ?>
			                            	<span class="product-count"><?php echo trim($category->count); ?></span>
			                            <?php } ?>
			                        </h2>
			                        <?php if ( !empty($item['btn_text']) ) { ?>
			                        	<a href="<?php echo esc_url(get_term_link($category)); ?>" class="readmore"> <span data-hover="<?php echo trim($item['btn_text']); ?>"> <?php echo trim($item['btn_text']); ?></span></a>
			                        <?php } ?>
				                </div>
					        </div>
				        </div>
		    	<?php $i++; } ?>
			    <?php } ?>
			</div>
		<?php } else { ?>
			<div class="list-banner-category">
				<?php foreach ($categoriesbanners as $item) { ?>
			    	<?php
		    		$category = get_term_by( 'slug', $item['category'], 'product_cat' );
		    		if ( !empty($category) ) {
			    	?>

			    	<div class="item category-wrapper">
		                <?php
			                if ( isset($item['image']) && $item['image'] ) {
			                	$image = wp_get_attachment_image_src($item['image'],'full');
			                	maison_display_image($image);
			                }
		                ?>
		                <div class="category-meta">
		                	<h2 class="title">
		                		<a href="<?php echo esc_url(get_term_link($category)); ?>">
			                		<?php if ( !empty($title) ) { ?>
		                                <?php echo trim($title); ?>
		                            <?php } else { ?>
		                                <?php echo trim($category->name); ?>
		                            <?php } ?>
	                            </a>
	                            <?php if ( $show_number_products ) { ?>
	                            	<span class="product-count"><?php echo trim($category->count); ?></span>
	                            <?php } ?>
	                        </h2>
	                        <?php if ( !empty($item['btn_text']) ) { ?>
	                        	<a href="<?php echo esc_url(get_term_link($category)); ?>" class="readmore"><?php echo trim($item['btn_text']); ?></a>
	                        <?php } ?>
		                </div>
			        </div>

			    	<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php
endif;