<?php

//short code for home page boxes
function kaya_teaserbox ($atts, $content = null) { 
	extract(shortcode_atts(array(
        'icon'      => '',
        'title'      => '',
		'link'      => '#',
		'column'		=>'',
    ), $atts));
	
	$out= '<div class="'.$column.'">';
	$out.= '<div class="teaserbox ">';
	$out .= '<div class="teaserboxicon"><a href="'.$link.'"><img src="' .$icon. '" alt="" width="48" height="48" class="alignleft" /></a></div>';
	$out .= '<h4><a href="'.$link.'">' .$title.'</a></h4>';	
	$out .= '<div class="teaser_content"> '.do_shortcode($content).'</div>' ;
	//$out .= do_shortcode($content);
	//$out .= '</div>';	
	$out .= '</div>';
	$out .= '</div>';	
   return $out;
}
add_shortcode('teaserbox','kaya_teaserbox');

?>