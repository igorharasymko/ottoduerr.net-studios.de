<?php
   function kaya_image_slider($atts, $content = null) {
   extract(shortcode_atts(array(
        'width'      => '620',
		  'height'      => '400',
		  'class'      => ''
     
    ), $atts));
	wp_print_scripts('jquery_sudoSlider');
	$sudoid=rand(1,10);
	?>
     <?php
 $out='<div class="kslider_wrap'.$sudoid.'">';
  $out.='<style>
	.kslider_wrap'.$sudoid.' span#controls
	{
	width:'.$width.'px;
	
	}
	</style>';

$out.='<div id="kslider" class="kslider'.$sudoid.'">';
?>
<script type="text/javascript">
jQuery(document).ready(function($){	
			var sudoSlider = $(".kslider<?php echo $sudoid; ?>").sudoSlider({
				numeric:true,
				prevNext:false,
				 auto:true,
				continuous:true
			});
		});	
		
</script>
<?php	
$out.='<ul>';
  
	if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$content,$matches)){
		foreach ($matches[0] as $img) {
		$out.='<li>';
		
		
		$timthumb=get_option('timthumb');
		if($timthumb!="true"){		
	
	$out.='<img class="'.$class.'"  src="'.get_template_directory_uri().'/timthumb.php?src='.$img.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1"  alt="'.$get_the_title.'" />';
	}else{
	$image = vt_resize('', $img, $width, $height, true );
	$out.='<img class="'.$class.'" src="'.$image['url'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$get_the_title.'" />';
	}
	//	$out.='<img src="'.$img.'" height="'.$height.'" width="'.$width.'">';
	$out.='</li>';
		}
	
		}
$out.='</ul>';
$out.='</div>';
$out.='</div>';
return $out;
}
add_shortcode('kslider', 'kaya_image_slider');
?>