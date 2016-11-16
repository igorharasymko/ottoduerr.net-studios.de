<?php
function kaya_categoryslider($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" =>'',
		"category" => '',
		'postlimit' => '',
		'imagewidth' => '46',
		'imageheight' => '146',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	if($pagination == 'true'){
		$query .= '&paged='.$paged;
	}
	if(!empty($category)){
		$query .= '&category_name='.$category;
	}
	if(!empty($postlimit)){
		$query .= '&posts_per_page='.$postlimit;
	}

	$wp_query->query($query);
	ob_start();
	?>
<?php $out='<div id="category_post_items">';
		$out.='<h3>'.$title.'</h3>';
			//$out.='<div class="sliderHolder">';
		
	 while ($wp_query->have_posts()) : $wp_query->the_post(); 
	 $permalink = get_permalink($post->ID);
	  $post_title = get_the_title($post->ID);
	  $count=$post->comment_count;
				         
        	if (function_exists('the_post_thumbnail') &&
					current_theme_supports("post-thumbnails") &&
					!isset($instance["thumb"]) &&	
					has_post_thumbnail()
				) :
			    
			 $out.='<a href="'.$permalink.'">';                      
				$thumb = get_post_thumbnail_id(); 
				$image = vt_resize( $thumb, '',$imagewidth,$imageheight, true );	
					
			if($thumb){ 
				$out.='<img class="img_radius alignleft" src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'" alt="'.$post_title.'" />';
			} 
             $out.='</a>';
			 $out.='<span class="category_post_item_text">';
			 $out.='<strong><a class="read-more" href="'.$permalink.'">'.$post_title.'</a></strong> <br>';
			 $out.= '<span class="category_post_news_items_date">'.get_the_date().'</span>';
			$out.='<span class="category_post_item_exerpt">'.content(8).'</span>';
			
			//$out.='<a class="read-more" href="'.$permalink.'">Read More</a>'; 
			 $out.='</span>'; 
			    $out.='<div class="clear v-space"> </div>';
			 endif;
         
		
	endwhile;
	//$out.='</div>';
	$out.='</div>';
  $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	$out.=$content;
	ob_end_clean();
	return $out;
}
add_shortcode("categoryslider", "kaya_categoryslider");
?>