<?php
/**
 * Template Name: Gallery Portrait
 */
get_header();
get_header();
wp_enqueue_script("jquery_easing");
wp_enqueue_script('jquery_fancybox_pack');
wp_enqueue_style('css_fancybox');
 ?>

<script>  
	 jQuery(document).ready(function() {
	jQuery("a.example2").fancybox({
				'titleShow'     : true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'easingIn'      : 'easeOutBack',
				'easingOut'     : 'easeInBack'
			});
		});

</script>
<?php 
$sidebar_layout=get_post_meta($post->ID,'kaya_pagesidebar',true); 
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
?>
</div>
</div>
<!--Start Middle Section  -->
<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
        <?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
        <div id="content-extra-width">
            <div <?php echo page_layout($post->ID); ?>>
                <?php while ( have_posts() ) : the_post();
				the_content(); 
				 ?>
                <div class="clear"></div>
                <?php  $portrait_gallery_width=get_option('portrait_gallery_width');
			$portrait_gallery_height=get_option('portrait_gallery_height');
			$image_title=get_option('image_title');
			$portrait_gallery_width=$portrait_gallery_width?$portrait_gallery_width:'225';
			$portrait_gallery_height=$portrait_gallery_height?$portrait_gallery_height:'275';
			$gallery_class= $image_title!="true" ? 'kaya_gallery' :'kaya_gallery_without_title' 

    ?>
                <ul class="<?php echo $gallery_class; ?>">
                    <?php  $id = intval($id); $images = get_children( array( 'post_parent' => $id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
	$i = 0; //defined by WP
	$nums= get_option('gallery_images_limits')? get_option('gallery_images_limits'): '8';	 
	$chunked = @array_chunk($images, $nums);
	
	
	if(isset($_GET["showpage"])){ 
		$pagenum = $_GET["showpage"];
	}else{ 
		$pagenum = 1;
	}
	
	$start = ($pagenum * $nums) - ($nums -1); 
	$end = $pagenum * $nums; 
	
	
	$n = 0;

	
	foreach ( $images as $id => $attachment ) {
		$n++; 
	if($n >= $start && $n <= $end){
		// Attachment page ID
		$att_page = get_attachment_link($id);
		// Returns array
		$img = wp_get_attachment_image_src($id, 'full');
		$img = $img[0];
		$thumb = wp_get_attachment_image_src($id, 'full');
		$thumb = $thumb[0];
		// Set the image titles
		$title = $attachment->post_title;
		// Get the Permalink
		$permalink = get_permalink();
		// Set the image captions
		echo "<li>";
	$timthumb=get_option('timthumb');
	if($timthumb!="true"){ ?>
                    <?php  $imgurl=wp_get_attachment_url($id); ?>
                    <a href="<?php echo $imgurl; ?>" class="example2"> <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $imgurl; ?>
										&amp;w=<?php echo $portrait_gallery_width; ?>&amp;h=<?php echo $portrait_gallery_height; ?>&amp;zc=1" alt="<?php echo $title; ?>"  class="img_radius" /> </a>
                    <?php
										}else{
										 $imgurl=wp_get_attachment_url($id);
										 $image = vt_resize( $id, '', $portrait_gallery_width, $portrait_gallery_height, true );  ?>
                    <a href="<?php echo $imgurl; ?>" class="example2"> <img class="img_radius"  src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo $title; ?>"  /></a>
                    <?php
										}
										if($image_title!="true"){
										echo "<p>" .$title ."</p>";
										}
										echo "</li>";
		 }
		 }
					
					?>
                </ul>
                <?php
	if(count($chunked) > 1){
	  $k = isset($_GET["showpage"]) - 1; //previous page number
	  $l = isset($_GET["showpage"]) + 1; //next page number
	$output= "<div class='pagination'>";
	  //if($_GET["showpage"] != 1)$output .= '<a href="'.get_permalink($post->ID).'&showpage='.$k.'">Previous</a>';
	
	  for($j=1; $j< count($chunked)+1; $j++){ 
		 $k = $j - 1;
		//$l = $j + 1; 
			$output .= '<span><a href="'.get_permalink($post->ID).'?showpage='.$j.'"'; 
		if($_GET["showpage"] == $j) $output .= "class='current'";
		if($j==1 && !$_GET["showpage"]) $output .= "class='current'";
		$output .= "> $j </a></span>";
	 } 
	 
	//if($_GET["showpage"] < count($chunked))$output .= '<a href="'.get_permalink($post->ID).'&showpage='.$l.'">Next</a>';
	}
	$output.='</div>';
	echo $output;
	?>
                <?php endwhile; // end of the loop. ?>
            </div>
            <?php if($sidebar_layout !="full") { ?>
            <div class="<?php echo $aside_class;?>" >
                <?php get_sidebar();?>
            </div>
            <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
