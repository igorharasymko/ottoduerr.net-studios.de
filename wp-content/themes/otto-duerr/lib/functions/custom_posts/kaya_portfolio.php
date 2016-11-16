<?php
function create_portfolio(){

	register_post_type('portfolio', array(

		'labels' => array(

			'name' => __('Portfolios', 'Apogee'),

			'singular_name' => __('portfolio', 'Apogee' ),

			'add_new' => __('Add New', 'Apogee'),

			'add_new_item' => __('Add New portfolio', 'Apogee' ),

			'edit_item' => __('Edit portfolio' , 'Apogee'),

			'new_item' => __('New portfolio' , 'Apogee'),

			'view_item' => __('View portfolio' , 'Apogee'),

			'search_items' => __('Search portfolios', 'Apogee' ),

			'not_found' =>  __('No portfolios found' , 'Apogee'),

			'not_found_in_trash' => __('No portfolios found in Trash' , 'Apogee'), 

			'parent_item_colon' => '',

		),

		
		'singular_label' => __('portfolio' , 'Apogee'),

		'public' => true,

		'exclude_from_search' => false,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array( 'with_front' => false ),

		'query_var' => false,

		'menu_icon' => get_stylesheet_directory_uri() . '/lib/images/kaya_portfolios.png',

		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments','custom-fields','page-attributes')

	));

	//register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(

		'hierarchical' => true,

		'labels' => array(

			'name' => __( 'portfolio Categories', 'taxonomy general name', 'Apogee' ),

			'singular_name' => __( 'Portfolio Category', 'Apogee'),

			'search_items' =>  __( 'Search Categories' , 'Apogee'),

			'popular_items' => __( 'Popular Categories' , 'Apogee'),

			'all_items' => __( 'All Categories' , 'Apogee'),

			'parent_item' => null,

			'parent_item_colon' => null,

			'edit_item' => __( 'Edit portfolio Category', 'Apogee'), 

			'update_item' => __( 'Update portfolio Category', 'Apogee' ),

			'add_new_item' => __( 'Add New portfolio Category' , 'Apogee'),

			'new_item_name' => __( 'New portfolio Category Name', 'Apogee' ),

			'separate_items_with_commas' => __( 'Separate Portfolio category with commas' , 'Apogee'),

			'add_or_remove_items' => __( 'Add or remove portfolio category' , 'Apogee'),

			'choose_from_most_used' => __( 'Choose from the most used portfolio category' , 'Apogee')

		),

		'show_ui' => true,

		'query_var' => true,

		'rewrite' => false,

	));

}

add_action('init','create_portfolio');

function edit_portfolio_columns() {

	$columns = array(

		"cb" => "<input type=\"checkbox\" />",

		"title" => __('Portfolio Name', 'Apogee'),

		//"thumbnail" => __('Thumbnail', 'Apogee'),

		"portfolio_category" => __('Categories' , 'Apogee'),

		"date" =>  __('Date' , 'Apogee')		

	);

	return $columns;

}

add_filter('manage_edit-portfolio_columns', 'edit_portfolio_columns');

function manage_portfolio_columns($column) {

	global $post;

	if ($post->post_type == "portfolio") {

		switch($column){

			case "portfolio_category":

				$sub_portfolio = get_the_terms($post->ID, 'portfolio_category');				

				if (! empty($sub_portfolio)) {

					foreach($sub_portfolio as $sub_cat)

						$return[] = "<a href='edit.php?post_type=portfolio&portfolio_tag=$sub_cat->slug'> " . esc_html(sanitize_term_field('name', $sub_cat->name, $sub_cat->term_id, 'portfolio_tag', 'display')) . "</a>";

					$return = implode(', ', $return);

				} else {

					$sub_cat = get_taxonomy('portfolio_category');

					$return = "No $sub_cat->label";

				}

				echo $return;

				break;

			
			/* case 'thumbnail':

				echo the_post_thumbnail('thumbnail');

				break;

				*/

		}

	}

}

add_action('manage_posts_custom_column', 'manage_portfolio_columns', 10, 2);
?>