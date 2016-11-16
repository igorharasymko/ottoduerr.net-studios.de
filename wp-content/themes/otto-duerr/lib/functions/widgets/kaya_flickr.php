<?php
class flickr_widgets extends WP_Widget {
function flickr_widgets() {
global $themename;
$widget_ops = array( 'classname' => 'flickr_widget', 'description' => __('Use this widget to display Flicker Photos', 'Apogee'));
parent::WP_Widget(false, $name=$themename.'-Flickr Widget',$widget_ops);
}

function widget($args, $instance) {
$flickr_title = $instance['flickr_title'];
$flickr_display = $instance['flickr_display'];
$flickr_limits = $instance['flickr_limits'];
$flickr_user_id = $instance['flickr_user_id'];


	extract( $args );
	$before_title='<h3>';
	$after_title='</h3>';
	//$before_widget='<div  class="widget-container flickr_widget">';
	//$after_widget='</div>';
	echo $before_widget;
	echo $before_title;
	echo $instance["flickr_title"];
	echo $after_title;

?>
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_limits;?>&amp;display=<?php echo $flickr_display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_user_id;?>"></script>
<?php
	echo $after_widget;
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {
$instance = $old_instance;

/* Strip tags for title and name to remove HTML (important for text inputs). */

$instance['flickr_title'] = strip_tags( $new_instance['flickr_title'] );
$instance['flickr_display'] = strip_tags( $new_instance['flickr_display'] );
$instance['flickr_limits'] = strip_tags( $new_instance['flickr_limits'] );
$instance['flickr_user_id'] = strip_tags( $new_instance['flickr_user_id'] );

	return $instance;
}

/**
 *  form.
 */
function form($instance) {
$instance = wp_parse_args((array)$instance, array( 'flickr_title' => '', 'flickr_user_id' =>'', 'flickr_display'=>'', 'flickr_limits'=>'9'));		
?>

<p>
    <label for="<?php echo $this->get_field_id( 'flickr_title' ); ?>">
    <?php _e('Title:', 'Apogee'); ?>
    </label>
    <input id="<?php echo $this->get_field_id( 'flickr_title' ); ?>" name="<?php echo $this->get_field_name( 'flickr_title' ); ?>" value="<?php echo $instance['flickr_title']; ?>" type="text" style="width:100%;" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'flickr_user_id' ); ?>">Flickr User ID:</label>
    <input id="<?php echo $this->get_field_id( 'flickr_user_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_user_id' ); ?>" value="<?php echo $instance['flickr_user_id']; ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'flickr_display' ); ?>">Which photos to show:</label>
    <select name="<?php echo $this->get_field_name( 'flickr_display' ); ?>" id="<?php echo $this->get_field_id( 'flickr_display' ); ?>" class="widefat">
        <option value="0" <?php if ($instance ['flickr_display'] == '0') echo 'selected'; ?> >Latest</option>
        <option value="1" <?php if ($instance ['flickr_display'] == '1') echo 'selected'; ?> >Random</option>
        <option value="2" <?php if ($instance ['flickr_display'] == '2') echo 'selected'; ?> >Popular</option>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'flickr_limits' ); ?>">Number Of dispaly:</label>
    <input id="<?php echo $this->get_field_id( 'flickr_limits' ); ?>" name="<?php echo $this->get_field_name( 'flickr_limits' ); ?>" value="<?php echo $instance['flickr_limits']; ?>" style="width:100%;" />
</p>
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("flickr_widgets");') );
?>