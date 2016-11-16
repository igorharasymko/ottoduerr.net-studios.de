<?php
// SHORT CODE BEGINS *****************************************************
// CLEAR  *****************************************************
function kaya_clear_shortcode( $atts, $content = null) {
   return '<div class="clear">' . $content . '</div>';}
   add_shortcode('clear', 'kaya_clear_shortcode');
   
// DIVIDER  *****************************************************
function Kaya_divider_shortcode( $atts, $content = null) {
   return '<div class="divider">' . $content . '</div>';}
   add_shortcode('divider', 'Kaya_divider_shortcode');
   
// DIVIDER2  *****************************************************
function Kaya_divider2_shortcode( $atts, $content = null) {
   return '<div class="divider2">' . $content . '</div>';}
   add_shortcode('divider2', 'Kaya_divider2_shortcode');
   
// Vertcal Space  *****************************************************
function kaya_vspace_shortcode( $atts, $content = null) {
   return '<div class="v-space">' . $content . '</div>';}
   add_shortcode('vspace', 'kaya_vspace_shortcode');  
   
/*** Read More Button
------------------------------*/
function kaya_readmore( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
        'target'      => '_self',
	    'color'      => '',	

    ), $atts));

	$out = "<div class='readmore'><a href=\"" .$link. "\" target=\"" .$target. "\" class=\"readmore" ." ".$color."\"><span></span>" .do_shortcode($content). "</a></div>";
    return $out;

}
add_shortcode('readmore', 'kaya_readmore');




/*** ROUNDED BUTTONS SMALL
------------------------------*/
function kaya_button_small( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'linkurl'      => '#',
        'target'      => '_self',
	    'color'      => 'blue',	

    ), $atts));

	//$out = "<a href=\"" .$url. "\" target=\"" .$target. "\" class=\"button-small" ." " .$color."\">" .do_shortcode($content). "</a>";
	
	$out = "<span class='button_small_container'><a href=\"" .$linkurl. "\" target=\"" .$target. "\" class=\"button_small" ." ".$color."\"><span></span>" .do_shortcode($content). "</a></span>";
    return $out;

}

add_shortcode('button_small', 'kaya_button_small');

/*** ROUNDED BUTTONS BIG

------------------------------*/

function kaya_button_big( $atts, $content = null ) {

    extract(shortcode_atts(array(

        'linkurl'      => '#',
        'target'      => '_self',
	    'color'      => 'blue',
		'desc'      => 'Button Description',	

    ), $atts));

	$out = "<span class='button_big_container'><a href=\" " .$linkurl. "\" "." target=\"".$target."\"" . " ". "class=\"button_big "  .$color ."\"" . "><span></span>"  .do_shortcode($content). "<br> <em> ".$desc." </em>". " </a></span>";

	return $out;}
	
add_shortcode('button_big', 'kaya_button_big'); 


function kaya_announcement_shortcode( $atts, $content = null) {
   return '<div class="announcement">' . $content . '</div>'; }
   add_shortcode('announcement', 'kaya_announcement_shortcode');
   
//short code for quotes
function kaya_quotes( $atts, $content = null ) {
   return '<blockquote>' . do_shortcode($content) . '</blockquote>';}
add_shortcode('quotes', 'kaya_quotes');
//end short code for quotes

//short code for UnOrderlist
function kaya_list( $atts, $content = null ) {
extract(shortcode_atts(array(
        'style'  => 'circle',
         ), $atts));
	 return str_replace('<ul>', '<ul class="'.$style.'">', do_shortcode($content));
	 
   }
  // return 'arrow_right<div class="arrow_type"><ul class="ul">' . $content . '</ul></div>';}
add_shortcode('list', 'kaya_list');
//end short code for OrderedList

//short code for messages

function kaya_alert_info_box( $atts, $content = null ) {
   return '<div class="alert-blue">' . $content . '</div>';}
add_shortcode('alert_blue', 'kaya_alert_info_box');

function kaya_warning_box( $atts, $content = null ) {
   return '<div class="alert-yellow">' . $content . '</div>';}
add_shortcode('alert_yellow', 'kaya_warning_box');

function kaya_success_box( $atts, $content = null ) {
   return '<div class="alert-green">' . $content . '</div>';}
add_shortcode('alert_green', 'kaya_success_box');

//short code for hilighted text
function kaya_hilight_yellow( $atts, $content = null ) {
   return '<span class="hilight-yellow">' . $content . '</span>';}
	add_shortcode('hilight_yellow', 'kaya_hilight_yellow');
	
function kaya_hilight_black( $atts, $content = null ) {
   return '<span class="hilight-black">' . $content . '</span>';}   
	add_shortcode('hilight_black', 'kaya_hilight_black');
	
	
//short code for dropcap text	
	
function Kaya_dropcap( $atts, $content = null ) {
   return '<div class="dropcap">' . do_shortcode($content) . '</div>';
}
add_shortcode('dropcap','Kaya_dropcap');
?>