<?php  
// global variables
global $timthumb,$kaya_readmore,$slider_limits,$height;
$img_width=kaya_image_width($post->ID);
wp_enqueue_script("jquery_easing");
wp_enqueue_script("jquery_jcarousellite");
wp_enqueue_style('css_jcarousellite');
wp_enqueue_script('jquery_fancybox_pack');
wp_enqueue_style('css_fancybox');

?>
<script type="text/javascript">
var $j = jQuery.noConflict();
	$j(document).ready(function() {
	
		$j(function() {
			$j(".sliderImages").jCarouselLite({
				visible: 1,
				//easing: "elasout",
				auto: 4500,
				btnNext: ".next_jcarousellite",
				btnPrev: ".prev_jcarousellite",
				speed: 1000
			});
		});
		
		
		$j(function() {
			$j(".sliderTextHolder").jCarouselLite({
				visible: 1,
				vertical: true,
				//easing: "elasout",
				auto: 4500,
				btnNext: ".next_jcarousellite",
				btnPrev: ".prev_jcarousellite",
				'easingIn'      : 'easeOutBack',
				speed: 1000
			});
		});
		
	 jQuery(document).ready(function() {
	jQuery("a.example2").fancybox({
				'titleShow'     : true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'easingIn'      : 'easeOutBack',
				'easingOut'     : 'easeInBack'
			});
		});
		
	});	
</script>
<div class="jcarousellite">
	<div class="one_half">
    	<div class="sliderImages_wrapper">
   			<div class="sliderImages">
                <ul>
                    <?php 
						global $height;
                        $slider_post_limits=get_option('slider_post_limits')?get_option('slider_post_limits'):'10';
                        $loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' =>$slider_post_limits,'order' => 'desc')); ?>
                        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                             ?>
                        <li>
                            <?php
                            $sudoslider_imageheight= get_option('sudosliderheight') ? get_option('sudosliderheight'):'';
                            $sudoslider_link= get_post_meta($post->ID,'customlink',true);
                            $sudoslider_video= get_post_meta($post->ID,'sudo_video',true);
                            $sudoslider_imglink= $sudoslider_link ? $sudoslider_link: get_permalink($post->ID);
							$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
                        	 if( get_option('lightbox_enable')=="true")
										 {
										
										if($sudoslider_video!='')
										 {
										 $links=$sudoslider_video;
										 }else{
										 $links=$imgurl;
										 }
										 
										 //$links=$imgurl;
										 $lightboxclass="example2";
										 }else
										 {
										 $links=get_permalink(); 
										 $lightboxclass='';
										 }
										
										echo '<a class="'.$lightboxclass.' iframe" href="'.$links.'">';
										  // Image
										
											if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
											/**
											*int $postid
											*int $width image width
											*int $height image height
											*str $class image class
											*boolean  true/false(for images links) 
											*/
											echo kaya_imageresize($post->ID, '400','225','jcarousellite_border','');
									}
											echo '</a>';
				?>
                           
                            <?php endwhile; // End the loop. Whew. ?>
                        </li>
                
                    <?php else :  
                echo '<li><img src="'.get_template_directory_uri().'/images/default_slider.png" width="400" height="225"></li>';						 
                endif; ?>
                </ul>
            </div>
          </div> 
          
             <div id="slider_nav">  
                <a href="#" class="prev_jcarousellite"><img src="<?php bloginfo('template_url'); ?>/images/previous_jcarousellite.png" alt="Previous" width="23" height="24" /> </a>					
                <a href="#" class="next_jcarousellite"><img src="<?php bloginfo('template_url'); ?>/images/next_jcarousellite.png" alt="Next"  width="23" height="24"/> </a> 
         	</div>
            
        </div>
  


        <div class="one_half_last"> 
                <div class="sliderTextHolder">
                    <ul>
                       <?php 
                        $slider_post_limits=get_option('slider_post_limits')?get_option('slider_post_limits'):'1';
                        $loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' =>$slider_post_limits,'order' => 'desc')); ?>
                        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                             ?>
                            <li>
                                <h2><?php the_title(); ?></h2> 
									<?php if($post->post_excerpt) {				 
										echo get_the_excerpt(); }
										else { 
										echo content('40');
										}?> 
                                    <br /><br />
                                	 <div class="readmore">   
                                   		<a href="<?php the_permalink(); ?>"><?php echo $kaya_readmore; ?> <span> </span></a>
                               		 </div>
                                       <?php endwhile; // End the loop. Whew. ?> 
                            </li>
                   <?php else :  
                echo '<li> <h2> Default Slidee Title</h2> <br> This is demo text and is disappeared once you create slider posts items. </li>';						 
                endif; ?>
                    </ul>
                </div>
        </div>
</div>