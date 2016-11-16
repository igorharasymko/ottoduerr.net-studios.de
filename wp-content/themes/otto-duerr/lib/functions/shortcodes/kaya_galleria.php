<?php
//short code for home page boxes
function kaya_photo_galleria ($atts, $content = null) { 
	extract(shortcode_atts(array(
        'width'      => '600',
        'height'      => '400',
        'transition'      => 'fade',
		'autoplay' =>'5000',
    ), $atts));
	wp_print_scripts('jquery-galleria');
	wp_print_scripts('jquery-classic');
global $post;
$pid = $post->ID;

	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID,
		'size' => array($width,$height),
	), $atts));

	$id = intval($id);
	$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}
	 $width=trim($width);
	// Build galleria markup
	
$output='<div  style="width:'.$width.'px;height:'.$height.'px;" id="galleria-'.$pid.'">';
	// Loop through each image
	
	foreach ( $attachments as $id => $attachment ) {
		global $image_size;
	
		// Attachment page ID
		$att_page = get_attachment_link($id);
		// Returns array
		$img = wp_get_attachment_image_src($id, $image_size);
		$img = $img[0];
		$thumb = wp_get_attachment_image_src($id, 'thumbnail');
		$thumb = $thumb[0];
		// Set the image titles
		$title = $attachment->post_title;
		// Get the Permalink
		$permalink = get_permalink();
		// Set the image captions
		$description = htmlspecialchars($attachment->post_content, ENT_QUOTES);
		 $image = vt_resize($id, '', $width, $height, true );
		if($description == '') $description = htmlspecialchars($attachment->post_excerpt, ENT_QUOTES);
	// Build html for each image
		$output .= "<div>";
		$output .= "<a href='".$image['url']."'>";
		$output .= "<img src='".$image['url']."' width='".$width."' height='".$height."'  alt='".$description."' title='".$title."' />";
		$output .= "</a>";
		$output .= "</div>";
	
	// End foreach
	}
	// Close galleria markup
	$output .= "</div>";
	 $output .="<script type=\"text/javascript\">";
	global $pid ;
  // run galleria and add some options
  $output .= "jQuery('";
	  	$pid = $post->ID;
		$output .= "#galleria-" .$pid ."').galleria({
  		autoplay: " .$autoplay.",
      height: ". $height.",
      width: ".$width.",
      transition: '" . $transition . "',
	  image_crop: true
  });
  </script>";
	return $output;
}
add_shortcode('galleria','kaya_photo_galleria');
?>