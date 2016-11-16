<?php
global $img_width,$single_image;
wp_print_scripts('jquery_sudoSlider');
$slider_post_limits=get_option('slider_post_limits')?get_option('slider_post_limits'):'10';
?>
<script type="text/javascript" >
	var $s = jQuery.noConflict();
	$s(document).ready(function(){	
			var sudoSlider = $s("#sudo_slider_home").sudoSlider({
				numeric:true,
				prevNext:false,
				   auto:true,				
				continuous:true,
				
			});
		});	
		
</script>

<div id="sudo_slider_home">
    <ul>
        <?php 
                      $loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' =>$slider_post_limits,'order' => 'desc')); ?>
        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                             ?>
        <li>
            <?php
                            $slider_imageheight= get_option('sliderheight') ? get_option('sliderheight'):'400';
                           	$slider_video= get_post_meta($post->ID,'video',true);
                           
							// image custom link
							$customlink=getcustomlink($post->ID);
                            echo '<a href="'.$customlink.'">';
                            // video
                            if($slider_video !='')
                            {?>
            <iframe src="<?php  echo stripslashes($slider_video); ?>" width="960" height="<?php  echo ($slider_imageheight); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            <?php
							
                            }else{  // Image
                            
                                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                /**
                                *int $postid
                                *int $width image width
                                *int $height image height
                                *str $class image class
                                *boolean  true/false(for images links) 
                                */
                           echo kaya_imageresize($post->ID, '960',$slider_imageheight,'img_radius','');
                                }
                                }
                                echo '</a>';
                                ?>
            <?php if(get_option('slidertext_disable')!="true") { ?>
            <div id="sudo_slider_home_content_box">
                <h3><?php echo the_title(); ?></h3>
               		 <?php if($post->post_excerpt) {				 
								echo get_the_excerpt(); }
								else { 
								echo content('20');
							}?> 
                
                </div>
            <?php 
                                      }
                                      ?>
            <?php endwhile; // End the loop. Whew. ?>
        </li>
        <?php else :  
							echo '<li><img src="'.get_template_directory_uri().'/images/default_slider.png" width="960" height="400"></li>';						 
							endif; ?>
    </ul>
</div>
