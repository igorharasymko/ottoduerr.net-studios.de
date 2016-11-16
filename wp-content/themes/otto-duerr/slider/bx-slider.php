<?php
global $timthumb,$kaya_readmore,$img_width, $single_image;;
wp_print_scripts('jquery_bxsldier');
wp_enqueue_script("jquery_easing");
wp_enqueue_script('jquery_fancybox_pack');
wp_enqueue_style('css_fancybox');
?>
<script>  
	 jQuery(document).ready(function() {
	jQuery("a.example2").fancybox({
				'titleShow'     : true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'easingIn'      : 'easeOutBack',
				'easingOut'     : 'easeInBack'
			});
		});

</script>
<script type="text/javascript">
var $j = jQuery;
  $j(document).ready(function(){
   $j('#slider1').bxSlider({
    displaySlideQty: 3,
    moveSlideQty: 1,
	//pager: true,
	//controls: false
  });
  });
</script>


<div id="slider1_wrapper">
    <ul id="slider1">
	<?php 
		$slider_post_limits=get_option('slider_post_limits')?get_option('slider_post_limits'):'6';
		$loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' =>$slider_post_limits,'order' => 'desc')); ?>
        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
			 ?>
        <li>
            <?php
			$slider_imageheight= get_option('sliderheight') ? get_option('sliderheight'):'400';
			$slider_video= get_post_meta($post->ID,'video',true);
			$imgurl=wp_get_attachment_url(get_post_thumbnail_id());
			$customlink=getcustomlink($post->ID);
			//echo $instance["lightbox"];
			 if( get_option('lightbox_enable')=="true")
			 {
			
			if($slider_video!='')
			 {
			 $links=$slider_video;
			 }else{
			 $links=$imgurl;
			 }
			 
			 //$links=$imgurl;
			 $lightboxclass="example2";
			 }else
			 {
			 $links=$customlink; 
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
				echo kaya_imageresize($post->ID, '300',$slider_imageheight,'bx-slider-img','');
				}
				echo '</a>';
				?>
           <?php if(get_option('slidertext_disable')!="true") {
		   
		   ?>	 
           <div class="bx-slider-title-container">
           <strong><?php echo the_title(); ?></strong><br />
         			  <?php if($post->post_excerpt) {				 
										echo get_the_excerpt(); }
										else { 
										echo content('10');
										}?>  <br />
             <div class="readmore">   
                    <a href="<?php the_permalink(); ?>"><?php echo $kaya_readmore; ?> <span> </span></a>
                </div>
    		</div>
              <?php 
			  }
			  ?>
            <?php endwhile; // End the loop. Whew. ?>
        </li>

    <?php else :  
echo '<li><img src="'.get_template_directory_uri().'/images/default_slider.png" width="338" height="500"></li>';						 
endif; ?>
</ul>
</div>