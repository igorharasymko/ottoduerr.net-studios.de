<?php
function kaya_twitter($atts,$content=null) {
extract(shortcode_atts(array(
		'title' => '',
		'username'	=>'',
		'limits'	=> '5',
   ), $atts));
$out='<div class="kaya_twitter">';
$out.='<div class="title-holder">';
$out.='<h3><span>'.$title.'</span></h3>';
$out.='</div>';
	$out.='<ul class="tweets-list">';
$out.=shortcode_twitter($username, $limits);
$out.='</ul>';
$out.='</div>';
return $out;
}
add_shortcode('twitter','kaya_twitter');
function shortcode_twitter($username,$limit) {
	global $twitter_options;
	global $wpdb;
	$out="";
		include_once(ABSPATH . WPINC . '/class-simplepie.php');
	$messages = fetch_feed('http://twitter.com/statuses/user_timeline/'.$username.'.rss');
	$items = $messages->get_items();
	if ($username == '') {
	$out.='<blockquote><p>';
	$out.="Please enter your twitter Id in place of username";
	$out.="</p></blockquote>";
	}else{
		
	if ( empty($items)) {
	$out.='<blockquote><p>';
	$out.="No public Twitter messages";
		$out.="</p></blockquote>";
		}else{
				
	$i = 0;

	
	foreach ( $items as $message ) {
	
		
		$msg = " ".substr(strstr($message->get_description(),': '), 2, strlen($message->get_description()))." ";
		$out.='<li><img src="'.get_template_directory_uri().'/images/picons03.png" class="thumb" alt=""/><div class="description">';
		//if($encode_utf8) $msg = utf8_encode($msg);
		$link = $message->get_permalink();
		$time = $message->get_date();
		$msg = hyperlinks($msg);
		$msg = twitter_users($msg);
	
		$out .= $msg;
		
		//$out .= '<small>(' . relativeTime(strtotime($time)) . '&nbsp;)</small>';
		$out.='</div></li>';	
//$out .= '<a class="target_blank" href="' .$link. '" title="' .relativeTime(strtotime($time)). '">' .$msg. '</a>';
	$i++;
			if ( $i >= $limit ) break;	
		

}
}
}

return $out;
}
?>