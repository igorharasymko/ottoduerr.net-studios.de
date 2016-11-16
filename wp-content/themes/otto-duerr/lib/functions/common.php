<?php
add_theme_support('automatic-feed-links');
/** Resize images width depand on sidebar/fullwidth in functions
 * 
 * kaya_image_width($postid)
  * @param int $postid
 * @return int
 
 */
function kaya_image_width($postid){
$sidebar_layout=get_post_meta($postid,'kaya_pagesidebar',true); 
$kaya_width=($sidebar_layout == "full" ) ? '959' : '627';
return $kaya_width;
 }
/** Resize images dynamically using wp built in functions
 * 
 * kaya_imageresize($postid,$width,$height,$class)
  * @param int $postid
  * @param int $width
 * @param int $height
 * @param string $class
 * @param boolean true/false
 * @return string
 
 */
function kaya_imageresize($postid,$width,$height,$class,$true)
{ 
global $timthumb;
$get_the_title=get_the_title($postid);
$thumb = get_post_thumbnail_id($postid);
$out='';

if($true=="true")
{
$out.='<a href="'.get_permalink($postid).'">';
}
	if($timthumb!="true"){		
	$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
	$out.='<img class="'.$class.'"  src="'.get_template_directory_uri().'/timthumb.php?src='.$imgurl.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1"  alt="'.$get_the_title.'" />';
	}else{
	$image = vt_resize( $thumb, '', 2*$width, 2*$height, true );
	$out.='<img class="'.$class.'" src="'.$image['url'].'" width="'.$width.'" height="'.$height.'" alt="'.$get_the_title.'" />';
	}
if($true=="true")
{
$out.='</a>';
}
	
return $out;	
}
// Dynamic customwidget  
$sidebar_widgets =get_option('customsidebar');
 if(is_array($sidebar_widgets)){
 array_unshift($sidebar_widgets, "select","Home Sidebar", "Pages Sidebar","Portfolio Sidebar","Blog Sidebar","Contact Sidebar");
 }else
 {
 $sidebar_widgets=array();
array_unshift($sidebar_widgets,"select","Home Sidebar", "Pages Sidebar","Portfolio Sidebar","Blog Sidebar","Contact Sidebar");
 }

// Page Layout option
function page_layout($postid)
{
$sidebar_layout=get_post_meta($postid,'kaya_pagesidebar',true); 
$contentcolumn="class='two_third'";
switch($sidebar_layout)
{
case 'leftsidebar':
$contentcolumn="class='two_third_last'";
break;
case 'rightsidebar':
$contentcolumn="class='two_third'";
break;
case 'full':
$contentcolumn="class='fullwidth'";
break;
}
echo  $contentcolumn;
}
// page title
function custom_pagetitle($post_id)
{
$subheader_titleoptions=get_post_meta($post_id,'subheader_titleoptions',true);
        echo '<div id="inner_title">';
            echo '<h2>'.get_the_title($post_id).'</h2>';
            echo '<div id="inner_right">';
                echo'<ul id="inner_title_list">';
                 echo  breadcrumbs_plus();
                echo'</ul>';
				 if(get_option('searchBox')!="true") {
               echo'<div class="search_box">';
                   get_search_form();
               echo '</div>';
			   }
           echo'</div>';
        echo'</div>';
}

// attachment single page sudo slider

function image_attachment_slider($postid,$img_width)
{  global $timthumb;
 $sidebar_layout=get_post_meta($postid,'kaya_pagesidebar',true); 
// $img_width=($sidebar_layout == "full" ) ? '930' :'597';
		$args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'DESC', 'post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $postid );
		$attachments = get_posts($args);
		if(count($attachments) >1) { $sliderid="kaya_portfolio_slider";}else{  $sliderid="kaya_portfolio_slider_single_image"; }
		?>
		   
				 <div id="<?php echo $sliderid; ?>">
							<ul>
								<?php
									if ($attachments) {
									foreach ( $attachments as $attachment ) { 
								?>
								<li>
									<?php 
									$thumb = $attachment->ID; 
									$imgurl=wp_get_attachment_url($thumb);		
										if($thumb) {
										if($timthumb!="true"){	?>
									<?php   ?>                  
									<img  src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $imgurl; ?>&amp;w=<?php echo $img_width;?>&amp;h=&amp;zc=1" alt="<?php the_title(); ?>"  class="img_radius" />         

									<?php
											}else{
											$image = vt_resize($attachment->ID,'',$img_width,'',true);
											//print_r($image);
											//echo $image['url'];
										?>
									<img src="<?php echo $image['url']; ?>" width="<?php echo $img_width;?>" height='<?php echo $image['height'];?>'  class="img_radius" />
									<?php } } ?>
								  
								</li>
								<?php }	} ?>
							</ul>
						</div>
		
<?php } 
// End attachment single page sudo slider
// custom post link
 function getcustomlink($postid) {
		$slider_link=  get_post_meta($postid,'customlink',true); 
		$sudoslider_imglink= $slider_link ? $slider_link: get_permalink($postid);
	return 	$sudoslider_imglink;
	}
 ?>