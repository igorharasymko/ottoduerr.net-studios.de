<?php
function twitter_widgets() {
	register_widget('twitter_widget');
}
class twitter_widget extends WP_Widget {
function twitter_widget() {
global $themename;
		
		$widget_ops = array( 'classname' => 'twitter_widget', 'description' => __('Display Your Recent Tweets', 'Apogee') );

		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'twitter_widget' );

		
		$this->WP_Widget('twitter_widget',$themename.'-Twitter', $widget_ops, $control_ops );
	}

	
function widget($args,$instance ) {
		extract( $args );
$twitter_username = $instance['twitter_username'];
$twitter_title = $instance['twitter_title'];
$twitter_limits = $instance['twitter_limits'];

	echo $before_widget;
	echo $before_title;
	echo $twitter_title;		
	echo $after_title;
	echo parse_cache_feed($twitter_username, $twitter_limits);
	echo $after_widget;
	
}
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

/* Strip tags for title and name to remove HTML (important for text inputs). */

$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
$instance['twitter_limits'] = strip_tags( $new_instance['twitter_limits'] );
$instance['twitter_title'] = strip_tags( $new_instance['twitter_title'] );
	return $instance;
}

function form( $instance ) {
$instance = wp_parse_args((array)$instance, array( 'twitter_title' => '', 'twitter_username' =>'', 'twitter_limits' => '3'));
/*  dispaly form. */
?>

<p>
<label for="<?php echo $this->get_field_id( 'twitte-_title' ); ?>"><?php _e('Title:', 'Apogee'); ?></label>
<input id="<?php echo $this->get_field_id( 'twitter_title' ); ?>" name="<?php echo $this->get_field_name( 'twitter_title' ); ?>" value="<?php echo $instance['twitter_title']; ?>" type="text" style="width:100%;" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e('User Name:', 'Apogee'); ?></label>
<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" type="text" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $instance['twitter_username']; ?>" style="width:100%;" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'twitter_limits' ); ?>"><?php _e('Number Of Links:', 'Apogee'); ?></label>
<input id="<?php echo $this->get_field_id( 'twitter_limits' ); ?>" type="text" name="<?php echo $this->get_field_name( 'twitter_limits' ); ?>" value="<?php echo $instance['twitter_limits']; ?>" style="width:100%;" />
</p>

<?php } } 
add_action( 'widgets_init', 'twitter_widgets' );
?>