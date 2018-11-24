<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id() ), 'blog-thumbnails' );

?>
<div class="product-block list" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="row">
		<div class="col-lg-4 col-md-4">
		    <figure class="image">
		        <?php woocommerce_show_product_loop_sale_flash(); ?>
		        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
		            <?php
		                /**
		                * woocommerce_before_shop_loop_item_title hook
		                *
		                * @hooked woocommerce_show_product_loop_sale_flash - 10
		                * @hooked woocommerce_template_loop_product_thumbnail - 10
		                */
		                remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
		                do_action( 'woocommerce_before_shop_loop_item_title' );
		            ?>
		        </a>

		    </figure>
		</div>    
	    <div class="col-lg-8 col-md-8">
		    <div class="caption-list">
		        
		        <div class="meta">

		         <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		            <?php
		                /**
		                * woocommerce_after_shop_loop_item_title hook
		                *
		                * @hooked woocommerce_template_loop_rating - 5
		                * @hooked woocommerce_template_loop_price - 10
		                */
		                do_action( 'woocommerce_after_shop_loop_item_title');

		            ?>
		            <div class="desc">
		            	<?php echo  the_excerpt();  ?>
		            </div>
		            <div class="action-bottom clearfix">  
		            	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                        <?php
                            $action_add = 'yith-woocompare-add-product';
                            $url_args = array(
                                'action' => $action_add,
                                'id' => $product->get_id()
                            );
                        ?>              
		                <?php
		                if( class_exists( 'YITH_WCWL' ) ) {
		                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		                }
		            	?>   
			            <?php if (maison_get_config('show_quickview', true)) { ?>
			                <div class="quick-view">
			                    <a href="#" class="quickview" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-toggle="modal" data-target="#apus-quickview-modal">	
			                       <span><?php esc_html_e('Quick view','maison'); ?></span>
			                    </a>
			                </div>
			            <?php } ?>    
		            </div>

		        </div>    
		        
		    </div>
		</div>    
	</div>	    
</div>
