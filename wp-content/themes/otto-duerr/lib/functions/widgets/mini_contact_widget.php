<?php
function contact_widgets() {
	register_widget('contact_widget');
}
class contact_widget extends WP_Widget {
function contact_widget() {
global $themename;
		
		$widget_ops = array( 'classname' => 'widget_mini_contactform', 'description' => __('Use this widget to add mini "Contact form"', 'Apogee') );

		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact_widget' );

		
		$this->WP_Widget('contact_widget',$themename.'-Mini Contact Form', $widget_ops, $control_ops );
	}

	
function widget($args,$instance ) {
		extract( $args );
		echo $before_widget;
$emailid = $instance['emailid'];
$contact_title = $instance['contact_title'];


 
	echo $before_title;
	echo $contact_title;		
	echo $after_title;
	
	

?>
<?php if(isset($hasError)) { //If errors are found ?>
	<p class="error"> <?php _e( 'Please check if you have filled all the fields with valid information. Thank you', 'Apogee' ); ?></p>
    
<?php } ?>

<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?> 
	<p> <?php _e( '<strong>Email Successfully Sent!</strong>', 'Apogee' ); ?></p>
    
     <?php _e( '<strong>Email Successfully Sent!</strong>', 'Apogee' ); ?>
    
	<p><?php _e( 'Thank you', 'Apogee' ); ?> <strong><?php echo $name;?></strong> 
	<?php _e( 'for using my contact form! Your email was successfully sent and I will be in touch with you soon.', 'Apogee' ); ?> </p>
    
<?php } ?>
<form action="<?php  echo get_template_directory_uri(); ?>/lib/functions/widgets/mini_contact_sent.php" method="post" id="mini_sendEmail">
					
							<p><label class="form-col1"><?php _e( 'Your Name :', 'Apogee' ); ?><span class="red">*</span></label> <input name="mini_name"  size="30"  id="mini_name"/></p>					
							<p><label class="form-col1"><?php _e( 'Your Email :', 'Apogee' ); ?><span class="red">*</span></label> <input name="mini_emailFrom"  size="30" id="mini_emailFrom" /></p>
								
							<input type="hidden" name="mini_emailTo" id="mini_emailTo" value="<?php echo $emailid;?>" />									
							<p><label class="form-col1"><?php _e( 'Message :', 'Apogee' ); ?><span class="red">*</span></label> <textarea name="mini_message" cols="23" rows="5" id="mini_message"></textarea></p>
                                               
						    <p><input name="submit" id="mini_submit" value="<?php _e( 'Submit', 'Apogee' ); ?>" type="submit"  class="mini_submit" /> </p>	
                                              
                                  		
												
							
					</form>
<?php

echo $after_widget;
}
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

/* Strip tags for title and name to remove HTML (important for text inputs). */

$instance['contact_title'] = strip_tags( $new_instance['contact_title'] );
$instance['emailid'] = strip_tags( $new_instance['emailid'] );
	return $instance;
}

function form( $instance ) {
$instance = wp_parse_args((array)$instance, array( 'contact_title' => '', 'emailid' =>''));	

/*  dispaly form. */
?>



<p>
<label for="<?php echo $this->get_field_id( 'contact_title' ); ?>"><?php _e('Title:', 'Apogee'); ?></label>
<input id="<?php echo $this->get_field_id( 'contact_title' ); ?>" name="<?php echo $this->get_field_name( 'contact_title' ); ?>" value="<?php echo $instance['contact_title']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'emailid' ); ?>"><?php _e('Email Id:', 'Apogee'); ?></label>
<input id="<?php echo $this->get_field_id( 'emailid' ); ?>" type="text" name="<?php echo $this->get_field_name( 'emailid' ); ?>" value="<?php echo $instance['emailid']; ?>" style="width:100%;" />
</p>
<?php } } 
add_action( 'widgets_init', 'contact_widgets' );
?>