<?php
function kaya_twitter($att,$content=null)(
extract(shortcode_atts(
		'title' => 'Recent Tweets',
		'username'	=>'envanto',
		'limits'	='5'
),$atts));
$out='<div class="kaya_twitter">';
$out.='<div class="title_holder">';
$out.='<h3><span>'.$title.'</span></h3>';
$out.='</div>';
echo $username;
$out.=parse_cache_feed($username, $limits);
$out.='</div>';
)
add_shortcode('twitter','kaya_twitter');