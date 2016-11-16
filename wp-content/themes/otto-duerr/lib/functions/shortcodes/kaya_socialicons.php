<?php

//short code for home page boxes
function kaya_socialicons ($atts, $content = null) { 
	extract(shortcode_atts(array(
        'icon'      => '',
        'link'      => '',
    ), $atts));	
	$out= '<div class="social_icons">';
	$out .='<a  href='.$link.'><img src="'.$icon.'" alt="" width="24" height="24" class="" /> </a>';
	$out .= '</div>';			
   return $out;
}
add_shortcode('social','kaya_socialicons');
?>