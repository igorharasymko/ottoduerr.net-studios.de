<?php
global $img_width,$single_image;
wp_print_scripts('jquery_sudoSlider');
$slider_post_limits=get_option('slider_post_limits')?get_option('slider_post_limits'):'10';
?>
<script type="text/javascript" >
	var $j = jQuery.noConflict();
	$j(document).ready(function(){	
			var sudoSlider = $j("#imageslider_text").sudoSlider({
				numeric:true,
				prevNext:false,
				continuous:true
			});
		});	
		
</script>
<div id="imageslider_text_wrapper">
	<div class="one_half">
    <div id="imageslider_text">
        <ul>
            <?php 
                      $loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' =>$slider_post_limits,'order' => 'desc')); ?>
            <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                             ?>
            <li>
                <?php
                            $slider_imageheight= get_option('sliderheight') ? get_option('sliderheight'):'300';
                           	$slider_video= get_post_meta($post->ID,'video',true);
                           
							// image custom link
							$customlink=getcustomlink($post->ID);
                            echo '<a href="'.$customlink.'">';
                            // video
                            if($slider_video !='')
                            {?>
                <iframe src="<?php  echo stripslashes($slider_video); ?>" width="462" height="<?php  echo ($slider_imageheight); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
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
                                echo kaya_imageresize($post->ID, '462',$slider_imageheight,'img_radius','');
                                }
                                }
                                echo '</a>';
                                ?>
                <?php if(get_option('slidertext_disable')!="true") { ?>
                <div id="sudo_slider_home_content_box">
                    <h3><?php echo the_title(); ?></h3>
                    <?php echo content(10); ?> </div>
                <?php 
                                      }
                                      ?>
                <?php endwhile; // End the loop. Whew. ?>
            </li>
            <?php else :  
							echo '<li><img src="'.get_template_directory_uri().'/images/default_slider.png" width="400" height="250"></li>';						 
							endif; ?>
        </ul>
</div>
</div>
        	<div class="one_half_last">
            <?php
                $slider_text=get_option('slider_text');
                    if ($slider_text) { 	
                 //   echo stripslashes($slider_text); 
					 echo do_shortcode($slider_text);					
                    } else { ?>
            <?php } ?>
        </div>
</div>