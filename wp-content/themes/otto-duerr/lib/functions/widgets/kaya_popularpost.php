<?php
class PopularPosts extends WP_Widget {
function PopularPosts() {
global $themename;
$widget_ops = array( 'classname' => 'widget_popularposts', 'description' => __('The most popular posts on your site', 'Apogee'));
	parent::WP_Widget(false, $name=$themename.'-Popular Posts',$widget_ops);
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");

	if ( $instance["excerpt_length"] > 0 )
		add_filter('excerpt_length', $new_excerpt_length);
	$post_old = $post; // Save the post object.
	
	extract( $args );
	echo $before_widget;
	echo $before_title;
	echo $instance["title"];
	echo $after_title;
		// Excerpt length filter
	
	echo "<ul>\n";
	?>
<?php
	
		$pop_posts = $instance["num"]; global $wpdb,$post;
			$post_old = $post; // Save the post object.
			$popularposts = "SELECT $wpdb->posts.ID, $wpdb->posts.post_title,$wpdb->posts.post_date, $wpdb->posts.post_excerpt,$wpdb->posts.post_content,  COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT ".$pop_posts;
			$posts = $wpdb->get_results($popularposts);
			
			if($posts){
				foreach($posts as $post){
					$post_title = stripslashes($post->post_title);
					 $popularpost_content = wp_html_excerpt($post->post_content,$instance["excerpt_length"]).'...';

					$guid = get_permalink($post->ID);
					?>

<li>
 
   <a href="<?php echo $guid; ?>">
            <?php the_post_thumbnail(array(46,46),array('class' =>'alignleft thumb')); ?>
            </a> 

    <strong><a href="<?php echo $guid; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></strong><br />
    <?php if ( !isset($instance['date']) ) : ?>
    <span class="recentpost-date">
    <?php the_time("F d,  Y"); ?>
    </span>
    <?php endif; ?>
    <?php if ( !isset($instance['disablecomments']) ) : ?>
    <span class="recentpost-comments">
    <?php comments_popup_link( __( '0', 'Apogee' ), __( '1', 'Apogee' ), __( '%', 'Apogee' ) ); ?>
    </span>
    <?php endif; ?>
    <?php if ( !isset($instance['excerpt']) ) : ?>
    <div class="recenpost-body-text"><?php echo $popularpost_content; ?> </div>
    <?php endif; ?>
    <div class="clear"></div>
</li>
<?php
					}
			}
			echo "</ul>\n";
			?>
<?php

	
	remove_filter('excerpt_length', $new_excerpt_length);
	echo $after_widget;
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
$instance = wp_parse_args((array)$instance, array( 'cat' => '', 'title' => 'Popular  posts', 'num' => 3, 'date'=>'', 'disablecomments'=>'','thumb'=>'', 'excerpt' => '','excerpt_length' => '20'));
//$instance = wp_parse_args((array)$instance, array('title' => 'Popular  posts', 'num' => 3, 'excerpt' => '','excerpt_length' => '100'));
		$title = strip_tags($instance['title']);
		$num = strip_tags($instance['num']);
        $excerpt_length = strip_tags($instance['excerpt_length']);
?>
<p>
    <label for="<?php echo $this->get_field_id("title"); ?>">
    <?php _e( 'Title','Apogee' ); ?>
    :
    <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("num"); ?>">
    <?php _e('Number of posts to show','Apogee'); ?>
    :
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

add_action( 'widgets_init', create_function('', 'return register_widget("PopularPosts");') );
?>