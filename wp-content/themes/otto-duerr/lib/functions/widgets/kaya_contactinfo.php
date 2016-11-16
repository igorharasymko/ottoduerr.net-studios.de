<?php
class Contactinfo extends WP_Widget {
function Contactinfo() {
global $themename;
		$widget_ops = array( 'classname' => 'widget_contactinfo', 'description' => __('Use this widget to add "Mailing Address"', 'Apogee'));

		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget_contactinfo' );

		
		$this->WP_Widget('widget_contactinfo',$themename.'-Contact Info', $widget_ops, $control_ops );
	//parent::WP_Widget(false, $name=$themename.'-Contacat Info');
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	extract( $args );
	// If not title, use the name of the category.
	if( $instance["title"] ) {
		$title ='<img class="icon" src="wp-content/themes/otto-duerr/images/pin-icon.png">'.$instance["title"];
	}
	echo $before_widget;
	// Widget title
	echo $before_title;
	echo  $title;
	echo $after_title;
	if( $instance["name"] ) {
		 $name =$instance["name"];
		 	echo "<span><strong>".$name."</strong></span>";
	}
	if( $instance["address"] ) {
		$address =$instance["address"];
		$address = str_replace('{br}', '<br>', $address);
		echo "<span id='address'>".$address."</span>";
	}
	if( $instance["phoneno"] ) {
		
		$phoneno =$instance["phoneno"];
		echo "<span id='phone'>".'<strong>Tel.: </strong>'.$phoneno."</span>";
		
	}
	if( $instance["fax"] ) {
		
		$fax =$instance["fax"];
		echo "<span id='fax'>".'<strong>Fax: </strong>'.$fax."</span>";
		
	}
	
	if( $instance["email"] ) {
		
		$email =$instance["email"];
		echo "<span id='email'><strong>Email:</strong> ".$email."</span>";
	}
			
	echo $after_widget;
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['title'] = strip_tags( $new_instance['title'] );
$instance['name'] = strip_tags( $new_instance['name'] );
$instance['address'] = strip_tags( $new_instance['address'] );
$instance['email'] = strip_tags( $new_instance['email'] );
$instance['phoneno'] = strip_tags( $new_instance['phoneno'] );
$instance['fax'] = strip_tags( $new_instance['fax'] );
	return $instance;
}

/**
 *  form.
 */
function form($instance) {
$instance = wp_parse_args((array)$instance, array( 'title' => '', 'name' =>'', 'address'=>'', 'phoneno'=>'','fax'=>'', 'email' => ''));
?>

<p>
    <label for="<?php echo $this->get_field_id("title"); ?>">
    <?php _e( 'Title', 'Apogee'); ?> :
    <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php if($instance["title"]) { echo esc_attr($instance["title"]); } ?>" />
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("name"); ?>">
    <?php _e( 'Name','Apogee'); ?> :
    <input class="widefat" id="<?php echo $this->get_field_id("name"); ?>" name="<?php echo $this->get_field_name("name"); ?>" type="text" value="<?php if($instance["name"]) { echo esc_attr($instance["name"]); } ?>" />
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("address"); ?>">
    <?php _e( 'Address','Apogee'); ?>: <br />
    <textarea cols="35" rows="5" id="<?php echo $this->get_field_id("address"); ?>" name="<?php echo $this->get_field_name("address"); ?>"><?php echo esc_attr($instance["address"]); ?></textarea>
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("phoneno"); ?>">
    <?php _e( 'Phone No','Apogee'); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id("phoneno"); ?>" name="<?php echo $this->get_field_name("phoneno"); ?>" type="text" value="<?php echo esc_attr($instance["phoneno"]); ?>" />
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("fax"); ?>">
    <?php _e( 'Fax','Apogee'); ?> :
    <input   class="widefat" id="<?php echo $this->get_field_id("fax"); ?>" name="<?php echo $this->get_field_name("fax"); ?>" type="text" value="<?php echo esc_attr($instance["fax"]); ?>" />
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("email"); ?>">
    <?php _e( 'Email','Apogee' ); ?> :
    <input class="widefat" id="<?php echo $this->get_field_id("email"); ?>" name="<?php echo $this->get_field_name("email"); ?>" type="text" value="<?php echo esc_attr($instance["email"]); ?>" />
    </label>
</p>
<?php

}

}
add_action( 'widgets_init', create_function('', 'return register_widget("Contactinfo");') );
?>