<?php
/*** TOGGLE
------------------------------*/
function kaya_shortcode_toggle_content( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'heading'      => '',
    ), $atts));
	$out = '<div class="toggle_container">';
	$out.= '<div class="trigger">' .$heading. '</div>';
	$out .= '<div class="toggle_content" style="display: none;">';
	$out .= '<div class="block">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</div>';
   return $out;
}
add_shortcode('toggle_content', 'kaya_shortcode_toggle_content');

// tabs
function kaya_shortcode_tabs( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));	
	
	$out= '<div id="tabContaier">';
	$out.= '<ul>';
	foreach ($atts as $tab => $val) {
		$out.= '<li><a href="javascript:void(0);" tabid="#'.$tab.'">' .$val. '</a></li>';
		}
	$out .= '</ul>';
    $out .= '<div class="tabDetails">';	
  
   foreach ($atts as $tab => $val) {
     $newContent = str_replace("[tab ".$tab."]","[tab id='".$tab."']",do_shortcode($content));	
   }
   
   $out .= $newContent;
	 
	$out .= '</div></div>';
	
	return $out;
	
}
add_shortcode('tabs', 'kaya_shortcode_tabs');



/*** TAB PANES
------------------------------*/
function tabpanes( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));	
	foreach ($atts as $tab) {
		$out = '<div id="'.$tab.'" class="tabContents">';
		$out .=do_shortcode($content);
		$out .=	'</div>';
	}	
	return $out;
	
}
add_shortcode('tab', 'tabpanes');


// vtabs
function kaya_shortcode_vtabs( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));	
	
	$out= '<div id="vtabContaier">';
	$out.= '<ul>';
	foreach ($atts as $vtab => $val) {
		$out.= '<li><a href="javascript:void(0);" vtabid="#'.$vtab.'">' .$val. '</a></li>';
		}
	$out .= '</ul>';
    $out .= '<div class="vtabDetails">';	
  
   foreach ($atts as $tab => $val) {
     $newContent = str_replace("[vtab ".$vtab."]","[vtab id='".$vtab."']",do_shortcode($content));	
   }
   
   $out .= $newContent;
	 
	$out .= '</div></div>';
	
	return $out;
	
}
add_shortcode('vtabs', 'kaya_shortcode_vtabs');



/*** VTAB PANES
------------------------------*/
function vtabpanes( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));	
	foreach ($atts as $vtab) {
		$out = '<div id="'.$vtab.'" class="vtabContents">';
		$out .=do_shortcode($content);
		$out .=	'</div>';
	}	
	return $out;
	
}
add_shortcode('vtab', 'vtabpanes');
?>