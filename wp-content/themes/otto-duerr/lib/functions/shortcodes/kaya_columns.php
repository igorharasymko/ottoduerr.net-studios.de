<?php

// COLUMN 5 *****************************************************
 function kaya_one_fifth_shortcode( $atts, $content = null) {
   return '<div class="one_fifth">' .do_shortcode($content).'</div>';}
   add_shortcode('one_fifth', 'kaya_one_fifth_shortcode');
   
 function one_fifth_last_shortcode( $atts, $content = null) {
   return '<div class="one_fifth_last">' .do_shortcode($content) . '</div>';}
   add_shortcode('one_fifth_last', 'one_fifth_last_shortcode');  
   
// COLUMN 5_4 *****************************************************
 function kaya_four_fifth_shortcode( $atts, $content = null) {
   return '<div class="four_fifth">' .do_shortcode($content). '</div>';}
   add_shortcode('four_fifth', 'kaya_four_fifth_shortcode');
   
function kaya_four_fifth_last_shortcode( $atts, $content = null) {
   return '<div class="four_fifth_last">' .do_shortcode($content). '</div>';}
   add_shortcode('four_fifth_last', 'kaya_four_fifth_last_shortcode');
   
// COLUMN 4 *****************************************************   
function kaya_one_fourth_shortcode( $atts, $content = null) {
   return '<div class="one_fourth">' .do_shortcode($content). '</div>';}
   add_shortcode('one_fourth', 'kaya_one_fourth_shortcode'); 
   
   
// COLUMN 4_3 *****************************************************
function kaya_three_fourth_shortcode( $atts, $content = null ) {
   return '<div class="three_fourth">' .do_shortcode($content) . '</div>';}
add_shortcode('three_fourth', 'kaya_three_fourth_shortcode');

function kaya_three_fourth_last_shortcode( $atts, $content = null ) {
   return '<div class="three_fourth_last">' .do_shortcode($content) . '</div>';}
add_shortcode('three_fourth_last', 'kaya_three_fourth_last_shortcode');


function one_fourth_last_shortcode( $atts, $content = null) {
   return '<div class="one_fourth_last">' .do_shortcode($content) . '</div>';}
   add_shortcode('one_fourth_last', 'one_fourth_last_shortcode');  
   
   
// Column One Third ***************************************************** 

function kaya_one_third_shortcode($atts, $content = null) {
   return '<div class="one_third">'.do_shortcode($content).'</div>';}
add_shortcode('one_third', 'kaya_one_third_shortcode');


function one_third_last_shortcode( $atts, $content = null ) {
   return '<div class="one_third_last">'.do_shortcode($content).'</div>';}
add_shortcode('one_third_last', 'one_third_last_shortcode');



// COLUMN Two Third *****************************************************
function kaya_two_third_shortcode( $atts, $content = null ) {
   return '<div class="two_third">' .do_shortcode($content) . '</div>';}
add_shortcode('two_third', 'kaya_two_third_shortcode');

function kaya_two_third_last_shortcode( $atts, $content = null ) {
   return '<div class="two_third_last">' .do_shortcode($content) . '</div>';}
add_shortcode('two_third_last', 'kaya_two_third_last_shortcode');


// COLUMN One Half *****************************************************
function kaya_one_half_shortcode( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';}
add_shortcode('one_half', 'kaya_one_half_shortcode');

function one_half_last_shortcode( $atts, $content = null ) {
   return '<div class="one_half_last">' .do_shortcode($content) . '</div>';}
add_shortcode('one_half_last', 'one_half_last_shortcode');

// COLUMN Full width *****************************************************
function kaya_fullwidth_shortcode( $atts, $content = null ) {
   return '<div class="fullwidth">' . do_shortcode($content) . '</div>';}
add_shortcode('fullwidth', 'kaya_fullwidth_shortcode');
?>