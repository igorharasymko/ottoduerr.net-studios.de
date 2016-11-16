<?php

//short code for services pages
function kaya_testimonial ($atts, $content = null) { 
	extract(shortcode_atts(array(
        'title'      => '',
        'author'      => '',
	'author_image' => '',
	 'link'      => '#',
    ), $atts));
	
	$out= '<div class="testimonial">';
	$out .= '<div class="box2_outer"><div class="box2_inner"><div class=""> <a href="'.$link.'"> <img src="'.$author_image.'" width="70" height="70" /> </a>';
	$out .= '</div></div></div>';
	$out .= '<div class="testimonial_body">';	
	$out .= '<h5>' .$title. '</h5>';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
   return $out;
}
add_shortcode('testimonial','kaya_testimonial');
?>