<?php  
// global variables
global $timthumb,$kaya_readmore,$slider_limits;
$img_width=kaya_image_width($post->ID);
wp_enqueue_script("jquery_easing");
wp_enqueue_script("jquery_contentcarousel");
wp_enqueue_style('css_carousel_style');
$slider_post_limits=get_option('slider_post_limits')?get_option('slider_post_limits'):'10';
?>
<script type="text/javascript">
var $j = jQuery.noConflict();
		$j(document).ready(function() {  
			$j('#ca-container').contentcarousel();				
		});	
	</script>

<div class="slider">
    <!--start slider -->
    <div class="container">
        <div id="ca-container" class="ca-container">
            <div class="ca-wrapper">
                <?php  
							 
							 $loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' =>$slider_post_limits,'order' => 'desc')); ?>
                <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
			 ?>
                <div class="ca-item">
                    <!--1 slider -->
                    <div class="ca-item-main">
                    <?php $customlink =get_post_meta($post->ID, "customlink", true); ?>
                        <?php
											if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
											/**
											*int $postid
											*int $width image width
											*int $height image height
											*str $class image class
											*boolean  true/false(for images links) 
											*/
											echo '<a href="'.$customlink.'">';
											echo kaya_imageresize($post->ID, '287','187','img_radius','false');
											echo '</a>';
											}
											?>
                        <div class="ca-item-text">
                            <a href="<?php  echo $customlink; ?>"><h2><?php echo the_title(); ?></h2></a>
                            <?php if($post->post_excerpt) {				 
								echo get_the_excerpt(); }
								else { 
								echo content('20');
							}
								 ?> 
                 
                 <a href="<?php  echo $customlink; ?>" class="ca-details">Details</a> </div>
                    </div>
                    
                </div>
                <?php endwhile; // End the loop. Whew. ?>
                <?php else :  
						 echo '<img src="'.get_template_directory_uri().'/images/default_slider.png" width="960" height="400">';						 
						 endif; ?>
            </div>
        </div>
    </div>
</div>
<!--End slider -->
