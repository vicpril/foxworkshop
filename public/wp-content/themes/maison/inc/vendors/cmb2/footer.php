<?php

if ( !function_exists( 'maison_footer_metaboxes' ) ) {
	function maison_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'maison' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'lighting' => esc_html__('Lighting', 'maison'),
					'dark' => esc_html__('Dark', 'maison'),
					'boxed' => esc_html__('Boxed Light', 'maison')
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'maison' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'maison_footer_metaboxes' );
