<?php

	add_action('init', 'create_slider');

	function create_slider() {

    	$slider_args = array(

        	'label' => __('Kaya Slider' , 'Apogee'),		

        	'singular_label' => __('slider' , 'Apogee'),

			'new_item' => __( 'Home Page Slider', 'Apogee' ),

        	'public' => true,

        	'show_ui' => true,

        	'capability_type' => 'post',

        	'hierarchical' => false,

        	'rewrite' => true,

			'menu_icon' => get_stylesheet_directory_uri() . '/lib/images/kaya_slider.png',

				
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments','custom-fields','page-attributes')

        );

    	register_post_type('slider',$slider_args);

	}
	?>