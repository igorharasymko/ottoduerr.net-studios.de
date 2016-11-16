<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sudoSlider.js"></script>
<?php

function kaya_portfolio2($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"portfolio" => '',
		'postlimit' => '',
		'imagewidth' => '150',
		'imageheight' => '100',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	$query = 'post_type=kayaportfolio';
	$query .= '&taxonomy=portfolio_category';
	
	if($pagination == 'true'){
		$query .= '&paged='.$paged;
	}
	if(!empty($portfolio)){
		$query .= '&term='.$portfolio;
	}
	if(!empty($postlimit)){
		$query .= '&posts_per_page='.$postlimit;
	}
	//query_posts(array('post_type' => 'kayaportfolio', 'posts_per_page' => $images, 'taxonomy' => 'portfolio_category', 'term' => $id, 'paged' => $paged));
	$wp_query->query($query);
	ob_start();
	?>
<?php 
$out='<script src="'.get_template_directory_uri().'/js/jquery.sudoSlider.js"></script>';
?>

<?php	
$out.='<div>';
			$i=1;
	 while ($wp_query->have_posts()) : $wp_query->the_post(); 
	 $permalink = get_permalink($post->ID);
	  $post_title = get_the_title($post->ID);
	  $count=$post->comment_count;
	  ?>
      <script>
jQuery(document).ready(function(){	
			var sudoSlider = jQuery("#slider_portfolio<?php echo $i; ?>").sudoSlider({
				numeric:true,
				prevNext:false,
				continuous:true
			});
		});
</script>

       	 
      <?php
		$out.='<div class="one_half" id="taxportfolio_nav">';
		//	$out.='<div class="sliderHolder">';
        	 
                    $args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID );
                    $attachments = get_posts($args);
					if(count($attachments) >1) { $sliderid="slider_portfolio$i";}else{  $sliderid="slider_portfolio_single_image"; }
       		 $out.='<div id="'.$sliderid.'"  class="taxportfolio">';
           	 $out.='<ul>';
                    if ($attachments) {
                    foreach ( $attachments as $attachment ) { 
               
                $out.='<li>';
                   
                    $thumb = $attachment->ID; 
                    $timthumb=get_option('timthumb');					
                        if($thumb) {
                        if($timthumb!="true"){	
                     $imgurl=wp_get_attachment_url( $thumb); 
                     $out.='<img src="'.get_template_directory_uri().'/timthumb.php?src='.$imgurl.'&amp;w='.$imagewidth.'&amp;h=300&amp;zc=1" alt="'.$post_title.'" class="" />';
                            }else{
                            $image = vt_resize( $thumb, '',$imagewidth,'300', true );
                        
                    $out.='<img src="'.$image['url'].'"  width="'.$image['width'].'" alt="'.$post_title.'" />';
                   } } 
                $out.='</li>';
                }	} 
            $out.='</ul>';
       // $out.='</div>';

			 $out.='</div>'; $out.='</div>'; 
			  $out.='<div class="one_half_last">';
			$out.='<h4>'.$post_title.'</strong></h4>';
                                  
			$out.=content(10);
             $out.='<div class="post_nav_box">';
				$out.='<a href="'.$video.'" class="lightbox_video" rel="prettyPhoto[mixed]" title="Video Preview">&nbsp;</a><a href="'.$permalink.'" class="post_link"  title="Link To Post">&nbsp;</a>';
				$out.='</div>';
				$out.='<br>';
			
            $out.='</div>'; 
			$out.='<div class="clear"></div>'; 
			$out.='<div class="v-space"></div>'; 
		$i++;	 
	endwhile;
	$out.='</div>';
  $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	$out.=$content;
	ob_end_clean();
	return $out;
}
add_shortcode("portfolio2", "kaya_portfolio2");
?>