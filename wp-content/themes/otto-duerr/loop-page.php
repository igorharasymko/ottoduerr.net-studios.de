<?php
global $img_width,$single_image,$slider_imageheight;
wp_print_scripts('jquery_sudoSlider');
?>
<script type="text/javascript" >
	jQuery(document).ready(function(){	
			var sudoSlider = jQuery("#kaya_portfolio_slider").sudoSlider({
				numeric:true,
				prevNext:false,
				continuous:true
			});
		});	
		
</script>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
	$single_image=get_option('portfolio_bigger_image');
 	$slider_imageheight= get_option('sliderheight') ? get_option('sliderheight'):'300';
	$video= get_post_meta($post->ID,'Video',true);
		if($video!='')
			{?>                            
			<iframe src="<?php  echo stripslashes($video); ?>" width="<?php  echo ($img_width); ?>" height="<?php  echo ($slider_imageheight); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
         <div class="clear v-space"></div>
			<?php
				}
				
				else{  // Image
			if($single_image!="true")
					{
					echo image_attachment_slider($post->ID,$img_width, '150');
					echo '<div class="clear"></div>';
					 echo ' <div class="clear v-space"></div>';
				}
				else;
						
				}			
	
	
				?>
    <?php     	
			 the_content(); 
			 wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Apogee' ), 'after' => '</div>' ) ); 
			edit_post_link( __( 'Edit', 'Apogee' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<!-- End Ps -->
<?php  
 $commentsection = get_post_meta( get_the_ID(), 'commentsection', true );	
if( $commentsection == "on") {
comments_template( '', true );
} ?>
<?php endwhile; // end of the loop. ?>
