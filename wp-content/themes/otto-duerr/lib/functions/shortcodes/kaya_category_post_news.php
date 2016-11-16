<?php
function kaya_category_items_news($atts, $content = null) {
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
<?php $out='<div id="category_post_news_items">';
		$out.='<h3>'.$title.'</h3>';
			//$out.='<div class="sliderHolder">';
		
	 while ($wp_query->have_posts()) : $wp_query->the_post(); 
	 $permalink = get_permalink($post->ID);
	  $post_title = get_the_title($post->ID);
	  $count=$post->comment_count;
	  
			 $out.='<div class="date-bg calender">';
               $out.=' <h5> '. get_the_date('M' ).' </h5>';
               $out.=' <h4>'. get_the_date('d' ).'	</h4>';
           	$out.='</div>';
            
            
			 $out.='<span class="category_post_news_items_text">';
			 $out.='<strong><a class="read-more" href="'.$permalink.'">'.$post_title.'</a></strong> <br>';
			 $out.= '<span class="category_post_news_items_date">'.get_the_date().'</span>';
			$out.='<span class="category_post_item_exerpt">'.content(10).'</span>';
			
			//$out.='<a class="read-more" href="'.$permalink.'">Read More</a>'; 
			 $out.='</span>'; 
			    $out.='<div class="clear v-space"> </div>';
		         
		
	endwhile;
	//$out.='</div>';
	$out.='</div>';
  $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	$out.=$content;
	ob_end_clean();
	return $out;
}
add_shortcode("news", "kaya_category_items_news");
?>