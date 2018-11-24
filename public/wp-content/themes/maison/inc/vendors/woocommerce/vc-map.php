<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

	if ( !function_exists('maison_woocommerce_get_categories') ) {
	    function maison_woocommerce_get_categories() {
	        $return = array( esc_html__(' --- Choose a Category --- ', 'maison') );

	        $args = array(
	            'type' => 'post',
	            'child_of' => 0,
	            'orderby' => 'name',
	            'order' => 'ASC',
	            'hide_empty' => false,
	            'hierarchical' => 1,
	            'taxonomy' => 'product_cat'
	        );

	        $categories = get_categories( $args );
	        maison_get_category_childs( $categories, 0, 0, $return );

	        return $return;
	    }
	}

	if ( !function_exists('maison_get_category_childs') ) {
	    function maison_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
	        foreach ( $categories as $key => $category ) {
	            if ( $category->category_parent == $id_parent ) {
	                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
	                unset($categories[$key]);
	                maison_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
	            }
	        }
	    }
	}

	function maison_load_woocommerce_element() {
		$categories = maison_woocommerce_get_categories();
		$types = array(
			esc_html__('Recent Products', 'maison' ) => 'recent_product',
			esc_html__('Best Selling', 'maison' ) => 'best_selling',
			esc_html__('Featured Products', 'maison' ) => 'featured_product',
			esc_html__('Top Rate', 'maison' ) => 'top_rate',
			esc_html__('On Sale', 'maison' ) => 'on_sale',
			esc_html__('Recent Review', 'maison' ) => 'recent_review'
		);

		vc_map( array(
			'name' => esc_html__( 'Apus Products Categories Tabs ', 'maison' ),
			'base' => 'apus_categoriestabs',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'maison' ),
			'description' => esc_html__( 'Display products categories in Tabs', 'maison' ),
			'params' => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Categories Tabs', 'maison' ),
					'param_name' => 'categoriestabs',
					'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( 'Category', 'maison' ),
							"param_name" => "category",
							"value" => $categories
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'maison' ),
							'param_name' => 'title',
						),
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Get Products By",'maison'),
					"param_name" => "type",
					"value" => $types,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number Products', 'maison' ),
					'value' => 10,
					'param_name' => 'number',
					'description' => esc_html__( 'Number products per page to show', 'maison' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type",'maison'),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__('Grid', 'maison' ) =>'grid',
						esc_html__('Mansory', 'maison' ) =>'mansory',
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','maison'),
	                "param_name" => 'columns',
	                "value" => array(2,3,4,5,6),
	                'dependency' => array(
						'element' => 'layout_type',
						'value' => array('grid'),
					),
	            ),
	            array(
	                "type" => "checkbox",
	                "heading" => esc_html__('Show Load More','maison'),
	                "param_name" => 'load_more'
	            ),
	            array(
	                "type" => "checkbox",
	                "heading" => esc_html__('Show Number Products', 'maison'),
	                "param_name" => 'show_number_products'
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name",'maison'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'maison')
				)
			)
		) );

		vc_map( array(
			'name' => esc_html__( 'Apus Category Banners ', 'maison' ),
			'base' => 'apus_category_banner',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'maison' ),
			'description' => esc_html__( 'Display category banner', 'maison' ),
			'params' => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Banner', 'maison' ),
					'param_name' => 'categoriesbanners',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'maison' ),
							'param_name' => 'title',
						),
						array(
							"type" => "dropdown",
							"heading" => esc_html__( 'Category', 'maison' ),
							"param_name" => "category",
							"value" => $categories
						),
						array(
							"type" => "attach_image",
							"heading" => esc_html__("Category Image", 'maison'),
							"param_name" => "image"
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button text', 'maison' ),
							'param_name' => 'btn_text',
							'value' => 'Show Products'
						),
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns', 'maison'),
	                "param_name" => 'columns',
	                "value" => array(1,2,3,4,5,6),
	            ),
	            array(
	                "type" => "checkbox",
	                "heading" => esc_html__('Show Number Products', 'maison'),
	                "param_name" => 'show_number_products'
	            ),
	           	array(
					"type" => "dropdown",
					"heading" => esc_html__("Align",'maison'),
					"param_name" => "align",
					"value" => array(
						esc_html__('Left', 'maison' ) => 'left',
						esc_html__('Right', 'maison' ) => 'right',
					)
				),
	            array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type",'maison'),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__('Grid', 'maison' ) => 'grid',
						esc_html__('List', 'maison' ) => 'list',
						esc_html__('Carousel', 'maison' ) => 'carousel',
					)
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'maison'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
				)
			)
		) );
	}
	add_action( 'vc_after_set_mode', 'maison_load_woocommerce_element', 99 );

	class WPBakeryShortCode_apus_categoriestabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_category_banner extends WPBakeryShortCode {}
}