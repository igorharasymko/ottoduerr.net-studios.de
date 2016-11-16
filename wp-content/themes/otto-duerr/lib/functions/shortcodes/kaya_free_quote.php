<?php
//short code for Teaser Text on the home page  =========================================
function kaya_freeequote ($atts, $content = null) { 
	extract(shortcode_atts(array(
        'buttontext'      => '',
	 	'link'      => '#',
          ), $atts));
	
	$out= '<div class="freeequote_container">';
	$out.= '<div class="freeequote_text">';
	$out .= do_shortcode($content);
	$out.= '</div>';
	$out .= '<div class="freeequote_button_text_container"> <a href='.$link.' class="readmore">'.$buttontext.'<span></span></a></div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('teaser','kaya_freeequote');
?>