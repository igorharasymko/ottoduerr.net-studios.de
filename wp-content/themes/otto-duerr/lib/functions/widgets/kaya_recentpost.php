<?php
class CategoryPosts extends WP_Widget {
function CategoryPosts() {
global $themename;

		$widget_ops = array( 'classname' => 'widget_categoryposts', 'description' => __('The custom recent posts with thumbnail, date and comments', 'Apogee'));

		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'categorypost_widget' );

		
		$this->WP_Widget('categorypost_widget',$themename.'-Recent Posts', $widget_ops, $control_ops );
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
	}
	
	// Get array of post info.
	if($instance["cat"] != "-1"){ 
	$cat_posts = new WP_Query("showposts=" . $instance["num"] . "&cat=" . $instance["cat"]);
	}else{
	$cat_posts = new WP_Query("showposts=" . $instance["num"] . "");
	}
	// Excerpt length filter
	$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");

	if ( $instance["excerpt_length"] > 0 )
		add_filter('excerpt_length', $new_excerpt_length);
	
	echo $before_widget;
	
	// Widget title
	echo $before_title;
	echo $instance["title"];
	echo $after_title;

	// Post list
	echo "<ul>\n";
	
	while ( $cat_posts->have_posts() )
	{
		$cat_posts->the_post();
	?>
		<li>
			<?php the_post_thumbnail(array(46,46),array('class' =>'alignleft thumb')); ?>  
                 
          <strong><a href="<?php the_permalink() ?>"> <?php the_title(); ?></a></strong><br /> 
			<?php if ( !isset($instance['date']) ) : ?> 
			<span class="recentpost-date"><?php the_time("F d,  Y"); ?></span> 
			<?php endif; ?>
             <?php if ( !isset($instance['disablecomments']) ) : ?>
			  <span class="recentpost-comments"> <?php comments_popup_link( __( '0', 'Apogee' ), __( '1', 'Apogee' ), __( '%', 'Apogee' ) ); ?></span>
			<?php endif; ?>
			<?php if ( !isset($instance['excerpt']) ) : ?>
			<div class="recenpost-body-text"><?php the_excerpt(); ?> </div>
			<?php endif; ?>
		</li>
	<?php
	}
	
	echo "</ul>\n";
	
	echo $after_widget;

	remove_filter('excerpt_length', $new_excerpt_length);
	
	$post = $post_old; // Restore the post object.
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {

	return $new_instance;
}

/**
 *  form.
 */
function form($instance) {
$instance = wp_parse_args((array)$instance, array( 'cat' => '', 'title' => 'Recent posts', 'num' => 3, 'date'=>'', 'disablecomments'=>'','thumb'=>'', 'excerpt' => '','excerpt_length' => '20'));
		$title = strip_tags($instance['title']);
		$num = strip_tags($instance['num']);
        $excerpt_length = strip_tags($instance['excerpt_length']);
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title','Apogee' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php _e( 'Category','Apogee'); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ,'show_option_none' =>'All') ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of posts to show','Apogee'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($num); ?>" size='3' />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
				<?php _e( 'Disable Post Content','Apogee'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt_length"); ?>">
				<?php _e( 'Excerpt length (in words):','Apogee' ); ?>
			</label>
			<input style="text-align: center;" type="text" id="<?php echo $this->get_field_id("excerpt_length"); ?>" name="<?php echo $this->get_field_name("excerpt_length"); ?>" value="<?php echo $excerpt_length; ?>" size="3" />
		</p>
		
	
		
		<p>
			<label for="<?php echo $this->get_field_id("date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
				<?php _e( 'Disable post date','Apogee' ); ?>
			</label>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id("disablecomments"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disablecomments"); ?>" name="<?php echo $this->get_field_name("disablecomments"); ?>"<?php checked( (bool) $instance["disablecomments"], true ); ?> />
				<?php _e( 'Disable Comments','Apogee' ); ?>
			</label>
		</p>
		
		<?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
		<p>
			<label for="<?php echo $this->get_field_id("thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>"<?php checked( (bool) $instance["thumb"], true ); ?> />
				<?php _e( 'Disable post thumbnail' ,'Apogee'); ?>
			</label>
		</p>
	
		<?php endif; ?>

<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("CategoryPosts");') );
?>