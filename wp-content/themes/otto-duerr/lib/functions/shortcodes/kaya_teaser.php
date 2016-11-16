<?php
//short code for Teaser Text on the home page  =========================================
function kaya_teaser ($atts, $content = null) { 
	extract(shortcode_atts(array(
        'buttontext'  => '',
	 	'link'      => '#',
          ), $atts));
	
	$out= '<div class="teasercontainer">';
	$out.= '<div class="teasertext"> <h2>';
	$out .= do_shortcode($content);
	//$out .= '<a href='.$link.' class="viewmore">'.$buttontext.'</a>';
	$out.= '</h2></div>';	
	$out .= '</div>';	
   return $out;
}
add_shortcode('Teaser','kaya_teaser');
?>