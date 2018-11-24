<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	// custom wp
	$attributes = array(
	    'type' => 'dropdown',
	    'heading' => "Style Element",
	    'param_name' => 'style',
	    'value' => array( "one", "two", "three" ),
	    'description' => esc_html__( "New style attribute", "maison" )
	);
	vc_add_param( 'vc_facebook', $attributes ); // Note: 'vc_message' was used as a base for "Message box" element

	if ( !function_exists('maison_load_load_theme_element')) {
		function maison_load_load_theme_element() {
			$columns = array(1,2,3,4,6);
			// Heading Text Block
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Heading','maison'),
				'base'        => 'apus_title_heading',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'maison'),
				'description' => esc_html__( 'Create title for one Widget', 'maison' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'maison' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter heading title.', 'maison' ),
						"admin_label" => true,
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'maison' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'maison' )
				    ),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'maison'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default Center', 'maison') => 'default', 
							esc_html__('Small Center', 'maison') => 'small', 
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'maison' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'maison' )
					)
				),
			));

			// calltoaction
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Call To Action','maison'),
				'base'        => 'apus_call_action',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'maison'),
				'description' => esc_html__( 'Create title for one Widget', 'maison' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'maison' ),
						'param_name' => 'title',
						'value'       => esc_html__( 'Title', 'maison' ),
						'description' => esc_html__( 'Enter heading title.', 'maison' ),
						"admin_label" => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Sub title', 'maison' ),
						'param_name' => 'subtitle',
						'description' => esc_html__( 'Enter Sub title.', 'maison' ),
						"admin_label" => true
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'maison' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'maison' )
				    ),

				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 1', 'maison' ),
						'param_name' => 'textbutton1',
						'description' => esc_html__( 'Text Button', 'maison' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 1', 'maison' ),
						'param_name' => 'linkbutton1',
						'description' => esc_html__( 'Link Button 1', 'maison' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'maison'),
						"param_name" => "buttons1",
						'value' 	=> array(
							esc_html__('Default ', 'maison') => 'btn-default ', 
							esc_html__('Primary ', 'maison') => 'btn-primary ', 
							esc_html__('Success ', 'maison') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'maison') => 'btn-info ', 
							esc_html__('Warning ', 'maison') => 'btn-warning ', 
							esc_html__('Theme Color ', 'maison') => 'btn-theme',
							esc_html__('Theme Gradient Color ', 'maison') => 'btn-theme btn-gradient',
							esc_html__('Second Color ', 'maison') => 'btn-theme-second',
							esc_html__('Danger ', 'maison') => 'btn-danger ', 
							esc_html__('Pink ', 'maison') => 'btn-pink ', 
							esc_html__('White Gradient ', 'maison') => 'btn-white btn-gradient', 
							esc_html__('Primary Outline', 'maison') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'maison') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'maison') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 2', 'maison' ),
						'param_name' => 'textbutton2',
						'description' => esc_html__( 'Text Button', 'maison' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 2', 'maison' ),
						'param_name' => 'linkbutton2',
						'description' => esc_html__( 'Link Button 2', 'maison' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'maison'),
						"param_name" => "buttons2",
						'value' 	=> array(
							esc_html__('Default ', 'maison') => 'btn-default ', 
							esc_html__('Primary ', 'maison') => 'btn-primary ', 
							esc_html__('Success ', 'maison') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'maison') => 'btn-info ', 
							esc_html__('Warning ', 'maison') => 'btn-warning ', 
							esc_html__('Theme Color ', 'maison') => 'btn-theme',
							esc_html__('Second Color ', 'maison') => 'btn-theme-second',
							esc_html__('Danger ', 'maison') => 'btn-danger ', 
							esc_html__('Pink ', 'maison') => 'btn-pink ', 
							esc_html__('White Gradient ', 'maison') => 'btn-white btn-gradient',
							esc_html__('Primary Outline', 'maison') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'maison') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'maison') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'maison'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'maison') => 'default',
							esc_html__('Center', 'maison') => 'default center',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'maison' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'maison' )
					)
				),
			));
			
			// Apus Counter
			vc_map( array(
			    "name" => esc_html__("Apus Counter",'maison'),
			    "base" => "apus_counter",
			    "class" => "",
			    "description"=> esc_html__('Counting number with your term', 'maison'),
			    "category" => esc_html__('Apus Elements', 'maison'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'maison'),
						"param_name" => "number",
						"value" => ''
					),
					array(
						"type" => "colorpicker",
						"heading" => esc_html__("Color Number", 'maison'),
						"param_name" => "text_color",
						'value' 	=> '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
			   	)
			));
			// Banner CountDown
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner CountDown','maison'),
				'base'        => 'apus_banner_countdown',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'maison'),
				'description' => esc_html__( 'Show CountDown with banner', 'maison' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'maison' ),
						'param_name' => 'title',
						'value'       => esc_html__( 'Title', 'maison' ),
						'description' => esc_html__( 'Enter heading title.', 'maison' ),
						"admin_label" => true
					),

					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'maison' ),
						"param_name" => "descript",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'maison' )
				    ),
					array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'Date Expired', 'maison' ),
					    'param_name' => 'input_datetime'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'maison' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'maison' )
					),
				),
			));
			// Apus Brands
			vc_map( array(
			    "name" => esc_html__("Apus Brands",'maison'),
			    "base" => "apus_brands",
			    "class" => "",
			    "description"=> esc_html__('Display brands on front end', 'maison'),
			    "category" => esc_html__('Apus Elements', 'maison'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'maison'),
						"param_name" => "number",
						"value" => ''
					),
				 	array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'maison'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Carousel', 'maison') => 'carousel', 
							esc_html__('Grid', 'maison') => 'grid'
						),
						'std' => ''
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','maison'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
			   	)
			));
			
			vc_map( array(
			    "name" => esc_html__("Apus Socials link",'maison'),
			    "base" => "apus_socials_link",
			    "description"=> esc_html__('Show socials link', 'maison'),
			    "category" => esc_html__('Apus Elements', 'maison'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'maison'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Facebook Page URL", 'maison'),
						"param_name" => "facebook_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Twitter Page URL", 'maison'),
						"param_name" => "twitter_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Youtube Page URL", 'maison'),
						"param_name" => "youtube_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Pinterest Page URL", 'maison'),
						"param_name" => "pinterest_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Google Plus Page URL", 'maison'),
						"param_name" => "google-plus_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Instagram Page URL", 'maison'),
						"param_name" => "instagram_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Align", 'maison'),
						"param_name" => "align",
						'value' 	=> array(
							esc_html__('Left', 'maison') => '', 
							esc_html__('Right', 'maison') => 'right'
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
			   	)
			));
			// newsletter
			vc_map( array(
			    "name" => esc_html__("Apus Newsletter",'maison'),
			    "base" => "apus_newsletter",
			    "class" => "",
			    "description"=> esc_html__('Show newsletter form', 'maison'),
			    "category" => esc_html__('Apus Elements', 'maison'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'maison'),
						"param_name" => "description",
						"value" => '',
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Style', 'maison' ),
		                'param_name' => 'style',
		                'value' => array(
		                    esc_html__( 'Style 1', 'maison' ) 	=> 'style1',
		                    esc_html__( 'Style 2', 'maison' ) 	=> 'style2',
		                    esc_html__( 'Style 3', 'maison' ) 	=> 'style3',
		                )
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
			   	)
			));
			// google map
			$map_styles = array( esc_html__('Choose a map style', 'maison') => '' );
			if ( is_admin() && class_exists('Maison_Google_Maps_Styles') ) {
				$styles = Maison_Google_Maps_Styles::styles();
				foreach ($styles as $style) {
					$map_styles[$style['title']] = $style['slug'];
				}
			}
			vc_map( array(
			    "name" => esc_html__("Apus Google Map",'maison'),
			    "base" => "apus_googlemap",
			    "description" => esc_html__('Diplay Google Map', 'maison'),
			    "category" => esc_html__('Apus Elements', 'maison'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		                "type" => "textarea",
		                "class" => "",
		                "heading" => esc_html__('Description','maison'),
		                "param_name" => "des",
		            ),
		            array(
		                'type' => 'googlemap',
		                'heading' => esc_html__( 'Location', 'maison' ),
		                'param_name' => 'location',
		                'value' => ''
		            ),
		            array(
		                'type' => 'hidden',
		                'heading' => esc_html__( 'Latitude Longitude', 'maison' ),
		                'param_name' => 'lat_lng',
		                'value' => '21.0173222,105.78405279999993'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Map height", 'maison'),
						"param_name" => "height",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Map Zoom", 'maison'),
						"param_name" => "zoom",
						"value" => '13',
					),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Map Type', 'maison' ),
		                'param_name' => 'type',
		                'value' => array(
		                    esc_html__( 'roadmap', 'maison' ) 		=> 'ROADMAP',
		                    esc_html__( 'hybrid', 'maison' ) 	=> 'HYBRID',
		                    esc_html__( 'satellite', 'maison' ) 	=> 'SATELLITE',
		                    esc_html__( 'terrain', 'maison' ) 	=> 'TERRAIN',
		                )
		            ),
		            array(
						"type" => "attach_image",
						"heading" => esc_html__("Custom Marker Icon", 'maison'),
						"param_name" => "marker_icon"
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Custom Map Style', 'maison' ),
		                'param_name' => 'map_style',
		                'value' => $map_styles
		            ),
		            array(
						'type' => 'param_group',
						'heading' => esc_html__('Contact Infomations', 'maison' ),
						'param_name' => 'info',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'maison'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'maison' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'maison' ) . '</a>'
							),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Short Description','maison'),
				                "param_name" => "des",
				            ),
						),
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Socials Settings', 'maison' ),
						'param_name' => 'socials',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'maison'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'maison' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'maison' ) . '</a>'
							),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Url','maison'),
				                "param_name" => "url",
				            ),
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
			   	)
			));
			// Testimonial
			vc_map( array(
	            "name" => esc_html__("Apus Testimonials",'maison'),
	            "base" => "apus_testimonials",
	            'description'=> esc_html__('Display Testimonials In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'maison'),
		              	"param_name" => "number",
		              	"value" => '4',
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','maison'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
		                	esc_html__('Layout 1 ', 'maison') => 'layout1', 
		                	esc_html__('Layout 2', 'maison') => 'layout2',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));
	        // Our Team
			vc_map( array(
	            "name" => esc_html__("Apus Our Team",'maison'),
	            "base" => "apus_ourteam",
	            'description'=> esc_html__('Display Our Team In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Sub Title", 'maison'),
						"param_name" => "subtitle",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'maison' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Name','maison'),
				                "param_name" => "name",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Short Description','maison'),
				                "param_name" => "des",
				            ),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image", 'maison'),
								"param_name" => "image"
							),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Facebook','maison'),
				                "param_name" => "facebook",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Twitter Link','maison'),
				                "param_name" => "twitter",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Google plus Link','maison'),
				                "param_name" => "google",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Linkin Link','maison'),
				                "param_name" => "linkin",
				            ),

						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','maison'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));

	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Gallery",'maison'),
	            "base" => "apus_gallery",
	            'description'=> esc_html__('Display Gallery In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						"type" => "attach_images",
						"heading" => esc_html__("Images", 'maison'),
						"param_name" => "images"
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','maison'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Row','maison'),
		                "param_name" => 'rows',
		                "value" => array(1,2),
		            ),
		            array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'maison' ),
						"param_name" => "description",
						"value" => '',
						'description' => esc_html__( 'This field is used for Style 2.', 'maison' )
				    ),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout','maison'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default ', 'maison') => 'default', 
							esc_html__('Small ', 'maison') => 'small',
						),
						'std' => ''
		            ),
		            array(
						"type" => "dropdown",
						"heading" => esc_html__("Style Next and Preview", 'maison'),
						"param_name" => "style_border",
						'value' 	=> array(
							esc_html__('Border Dasher', 'maison') => '', 
							esc_html__('Border Solid', 'maison') => 'solid'
						),
						'std' => ''
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));
	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Video",'maison'),
	            "base" => "apus_video",
	            'description'=> esc_html__('Display Video In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'maison' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'maison' )
				    ),
	              	array(
						"type" => "attach_image",
						"heading" => esc_html__("Icon Play Image", 'maison'),
						"param_name" => "image"
					),
					array(
		                "type" => "textfield",
		                "heading" => esc_html__('Youtube Video Link','maison'),
		                "param_name" => 'video_link'
		            ),
		           	array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Link Button', 'maison' ),
						'param_name' => 'linkbutton',
						'description' => esc_html__( 'Link Button Join Us!', 'maison' ),
						"admin_label" => true
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));
	        // Features Box
			vc_map( array(
	            "name" => esc_html__("Apus Features Box",'maison'),
	            "base" => "apus_features_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'maison' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'maison'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'maison' )
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','maison'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','maison'),
				                "param_name" => "description",
				            ),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'maison'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'maison' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'maison' ) . '</a>'
							),
						),
					),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style Layout','maison'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default', 'maison') => '', 
							esc_html__('Right ', 'maison') => 'right',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));

			// information
			vc_map( array(
	            "name" => esc_html__("Apus Information Box",'maison'),
	            "base" => "apus_information_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'maison' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'maison'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'maison' )
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'maison'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Ionicons and Awesome Icon, Please click', 'maison' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://ionicons.com/" target="_blank">'
												. esc_html__( 'here to see the list', 'maison' ) . '</a>'
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','maison'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','maison'),
				                "param_name" => "description",
				            ),
						),
					),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'maison'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style','maison'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default Box', 'maison') => '', 
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));


			// FAQ
			vc_map( array(
	            "name" => esc_html__("Apus FAQ Box",'maison'),
	            "base" => "apus_faq_box",
	            'description'=> esc_html__('Display FAQ In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'maison' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','maison'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','maison'),
				                "param_name" => "description",
				            ),
						),
					),

		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));



			$custom_menus = array();
			if ( is_admin() ) {
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
				if ( is_array( $menus ) && ! empty( $menus ) ) {
					foreach ( $menus as $single_menu ) {
						if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
							$custom_menus[ $single_menu->name ] = $single_menu->slug;
						}
					}
				}
			}
			// Menu
			vc_map( array(
			    "name" => esc_html__("Apus Custom Menu",'maison'),
			    "base" => "apus_custom_menu",
			    "class" => "",
			    "description"=> esc_html__('Show Custom Menu', 'maison'),
			    "category" => esc_html__('Apus Elements', 'maison'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Menu', 'maison' ),
						'param_name' => 'nav_menu',
						'value' => $custom_menus,
						'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'maison' ) : esc_html__( 'Select menu to display.', 'maison' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Align','maison'),
		                "param_name" => 'align',
		                'value' 	=> array(
							esc_html__('Inherit', 'maison') => '', 
							esc_html__('Left', 'maison') => 'left', 
							esc_html__('Right', 'maison') => 'right', 
							esc_html__('Center', 'maison') => 'center', 
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
			   	)
			));

			vc_map( array(
	            "name" => esc_html__("Apus Instagram",'maison'),
	            "base" => "apus_instagram",
	            'description'=> esc_html__('Display Instagram In FrontEnd', 'maison'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'maison'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'maison'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Instagram Username", 'maison'),
		              	"param_name" => "username",
		            ),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'maison'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'maison'),
		              	"param_name" => "columns",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','maison'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
							esc_html__('Grid', 'maison') => 'grid', 
							esc_html__('Carousel', 'maison') => 'carousel', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Photo size','maison'),
		                "param_name" => 'size',
		                'value' 	=> array(
							esc_html__('Thumbnail', 'maison') => 'thumbnail', 
							esc_html__('Small', 'maison') => 'small', 
							esc_html__('Large', 'maison') => 'large', 
							esc_html__('Original', 'maison') => 'original', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Open links in','maison'),
		                "param_name" => 'target',
		                'value' 	=> array(
							esc_html__('Current window (_self)', 'maison') => '_self', 
							esc_html__('New window (_blank)', 'maison') => '_blank',
						)
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'maison'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'maison')
					)
	            )
	        ));
		}
	}
	add_action( 'vc_after_set_mode', 'maison_load_load_theme_element', 99 );

	class WPBakeryShortCode_apus_title_heading extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_call_action extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_brands extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_socials_link extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_newsletter extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_googlemap extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_testimonials extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner_countdown extends WPBakeryShortCode {}

	class WPBakeryShortCode_apus_counter extends WPBakeryShortCode {
		public function __construct( $settings ) {
			parent::__construct( $settings );
			$this->load_scripts();
		}

		public function load_scripts() {
			wp_register_script('jquery-counterup', get_template_directory_uri().'/js/jquery.counterup.min.js', array('jquery'), false, true);
		}
	}
	class WPBakeryShortCode_apus_ourteam extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_gallery extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_video extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_features_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_faq_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_information_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_custom_menu extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_instagram extends WPBakeryShortCode {}
}