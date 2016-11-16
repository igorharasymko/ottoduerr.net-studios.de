<?php
function port_portfolio ($atts, $content = null) {
	extract(shortcode_atts(array(
	    'id'      => '2',
        'images'      =>'5',
        'column'      =>'4',
	    'sidebar'   => '',
        
    ), $atts));
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
<?php
if($column == '5') { $class="one_fifth"; }  
 if($column == '4') {$class="one_fourth";}
  if($column == '4-2') {$class="one_fourth";}
  if($column == '4-3') {$class="one_fourth";}
if($column == '3') { $class="one_third"; }
if($column == '2') {$class="one_half"; }
if($column == '1') { $class="fullwidth"; }
   if($sidebar=="on")
   { 
if($column == '5') { $width="107"; $height="80";   }  
if($column == '4') { $width="139"; $height="120";  }
if($column == '4-2') { $width="139"; $height="120";  }
if($column == '4-3') { $width="139"; $height="170";  }
if($column == '3') { $width="193"; $height="150";}
if($column == '2') { $width="301"; $height="250"; }
if($column == '1') { $width="624"; $height="325"; }

}else{

if($column == '5') { $width="162"; $height="200";}  
 if($column == '4') { $width="212"; $height="250";}
  if($column == '4-2') { $width="212"; $height="150";}
  if($column == '4-3') { $width="212"; $height="170";}
if($column == '3') { $width="295"; $height="256"; }
if($column == '2') { $width="461"; $height="247"; }
if($column == '1') { $width="959"; $height="325"; }
}
	global $post, $wpdb;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts(array('post_type' => 'portfolio', 'posts_per_page' => $images, 'taxonomy' => 'portfolio_category', 'term' => $id, 'paged' => $paged));
			
 	$out='<div class="portfolio'.$column.' gallery">';
	$i = 0;
	 if(have_posts()) : 
        while (have_posts()): the_post(); 		
		$readmore = get_option('readmore');
$readmore= $readmore ? $readmore: 'Read More';	
		$post_title = get_the_title($post->ID);
		$i++;
	$permalink = get_permalink($post->ID);
	if($column != "1") {
	
	$last = ($i == $column and $column != 1) ? 'last' : '';
         $out.= '<div  class="'.$class.' '.$last.'">';          
          	$out.= '<div class="portfolio-padding">';	
			$video = get_post_meta( get_the_ID(), 'Video', true );			
			
			if($video)
			{
			if ( !empty( $video ) ) {
						$out.='<a href="'.$video.'" class="example2 lightbox iframe" title="Image Preview">';
					 	
						$out.=kaya_imageresize(get_the_ID(),$width,$height,'img_radius','false');
						$out.='</a>';
			//	$out.='<div class="post_nav_box">';
				//$out.='<a href="'.$video.'" class="lightbox_video" rel="prettyPhoto[mixed]" title="Video Preview">&nbsp;</a><a href="'.$permalink.'" class="post_link"  title="Link To Post">&nbsp;</a>';
			//	$out.='</div>';
			}
			}else{
			
			$thumb_id = get_post_thumbnail_id();
			
				if ( !empty( $thumb_id ) ) {						
				$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
				if (content('10') != "..."){
					$out.='<a href="'.$permalink.'" class="" title="Image Preview">';
				}
				$out.=kaya_imageresize(get_the_ID(),$width,$height,'img_radius','false');
				if (content('10') != "..."){
					$out.='</a>';
				}
			//	$out.='<div class="post_nav_box">';
			//	$out.='<a href="'.$imgurl.'" class="lightbox_image" rel="prettyPhoto[mixed]" title="Image Preview"></a><a href="'.$permalink.'" class="post_link"  title="Link To Post">&nbsp;</a>';
			//	$out.='</div>';
			
				}
				
			}
				
			 $out.='<div class="clear"> </div>';
			 	
            
			$out.='<div class="item_content_holder">';
		  
	     $out.='<h4>';
		 if (content('10') != "..."){ 
		 	$out.='<a href="'.$permalink.'">'; 
		 }
		 // Changed by Kevin Goedecke
		 // DATE: 04.12.2012 - 17:52
		 // REASON: Disable Display title of Vorhangstoffe Portfolio
		 
		 if (!strpos($post_title, "Bsp"))	{
		 	$out.= $post_title;
		 }
		 if (content('10') != "..."){
		 	$out.='</a>';
		 }
		 $out.='</h4>';
				global $kaya_content; 
				 global $more; $more=0;
				 
           
							 if($post->post_excerpt) {			 
								$out.= get_the_excerpt(); }
								else { 
								$out.= '';
							}
                            
				//$out.= the_excerpt(); 
			
			//$out.='<a class="readmore" href="'.$permalink.'">'.$readmore.'<span></span></a>';
		
			// $out.='</div>'; 
			
	  //portfolio padding end
	    $out.='</div>';  
	
		$out.='</div></div>';    	
	   
	     if($last=="last"){
	      $out.='<div class="clear v-space"></div>';
	     }
	     }
			
		if($column== "1")  { 
		
			$last = ($i == $column and $column != 1) ? 'last ' : '';
        	$out.= '<div class="portfolio-padding">';					
			$video = get_post_meta( get_the_ID(), 'Video', true );			
		
			if($video)
			{
			if ( !empty( $video ) ) {
				$out.='<a href="'.$video.'" class="example2 lightbox iframe" title="Image Preview">';
				$out.=kaya_imageresize(get_the_ID(),$width,$height,'img_radius','false');
				$out.='</a>';
				//$out.='<div class="post_nav_box">';
				//$out.='<a href="'.$video.'" class="lightbox_video" rel="prettyPhoto[mixed]" title="Video Preview">&nbsp;</a><a href="'.$permalink.'" class="post_link"  title="Link To Post">&nbsp;</a>';
				//$out.='</div>';
				//$out.='<br>';
			}
			}else{
			
			$thumb_id = get_post_thumbnail_id();
			
				if ( !empty( $thumb_id ) ) {
					$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
				$out.='<a href="'.$imgurl.'" class="example2 lightbox iframe" title="Image Preview">';
					$out.=kaya_imageresize(get_the_ID(),$width,$height,'','false');
					$out.='</a>';
					//$out.='<div class="post_nav_box">';
				//	$out.='<a href="'.$imgurl.'" class="lightbox_image" rel="prettyPhoto[mixed]"  title="Image Preview"></a><a href="'.$permalink.'" class="post_link"  title="Link To Post">&nbsp;</a>';
				//$out.='</div>';
				}
			}  	 
		
			$out.='<div class="item_content_holder">';
		  
	     $out.='<h4><a href="'.$permalink.'">'.$post_title.'</a></h4>'; 
				global $kaya_content; 
				 global $more; $more=0;
           
						 if($post->post_excerpt) {				 
								$out.= get_the_excerpt(); }
								else { 
								$out.= content('10');
							}
					// $out.='</div>'; 
			
	  //portfolio padding end
	    $out.='</div>';  
	
		$out.='</div>';
		 $out.='<div class="clear v-space2"> </div> ';
 }			
			if($i == $column){
$i = 0;
}
         endwhile;  
		 $out.='</div>'; 
         else :
$out.='<h2>'."Sorry but we could not find what you were looking for. But don't give up, keep at it!".'</h2>';
 endif; 

$out.=kaya_pagination(); 

      // $out.='</div>';
	  wp_reset_query();
	   return $out;
	   
} add_shortcode('portfolio','port_portfolio'); ?>