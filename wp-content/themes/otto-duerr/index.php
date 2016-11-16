<?php get_header(); ?>
<?php 
    $chooseslider=get_option('chooseslider');
	
    if( get_option('sliderdisable') != 'true')	
		{
		if(get_option('chooseslider') == 'contentcarousel' ) {
  
  		get_template_part('slider/contentcarousel','slider');
		
		}elseif ( get_option('chooseslider') == 'sudoslider' ) {
  
  		get_template_part('slider/sudo','slider');
  		
		}elseif ( get_option('chooseslider') == 'bxslider' ) {
  
  		get_template_part('slider/bx','slider');
		
		}elseif ( get_option('chooseslider') == 'jcarousellite' ) {
		
		get_template_part('slider/jcarousellite','slider');
		
		}elseif ( get_option('chooseslider') == 'imageslidertext' ) {
		
		get_template_part('slider/imageslider','text');
  		
		}elseif ( get_option('chooseslider') == 'staticvideo' ) {
					
		get_template_part('slider/video','slider');
		
		} elseif ( get_option('chooseslider') == 'staticimage') {
		
		get_template_part('slider/single','image');
		
		} elseif ( get_option('chooseslider') == '') {
		get_template_part('slider/contentcarousel','slider');
		
		}else
		get_template_part('slider/default','slider');
		}
    ?>
</div>
</div>

<div id="content_wrapper">
<!--Start content_wrapper -->
<div id="content">
<?php 
 $sortable_data_array = explode(',', get_option('homecolumn_sort_data') ? get_option('homecolumn_sort_data') :'2');
 if(!empty($sortable_data_array['0']))
	 	{
	 	foreach($sortable_data_array as $key => $sortable_data_item)
	 	{
		  $sidebar_layout=get_post_meta($sortable_data_item,'kaya_pagesidebar',true); 
		 	$page_widget=get_post_meta($sortable_data_item,"kaya_widgetsidebar",true);			
$img_width=kaya_image_width($sortable_data_item);
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
?>
<div <?php echo page_layout($sortable_data_item); ?>>
<?php
		 $obj_home = get_page($sortable_data_item);
		//$home_content = $obj_home->post_content;
		
		echo apply_filters( 'the_content' ,$obj_home->post_content);
		//echo do_shortcode($home_content);
		echo '</div>';
	
		 ?>
<!--Sidebar Section -->
<?php if($sidebar_layout !="full") {  ?>
<div class="<?php echo $aside_class;?>" >
    <?php get_template_part('sidebar','home'); ?>
</div>
<div class='clear'></div>
<?php }
echo "<div class='clear'></div>"; 
		}
		}
get_template_part('homepage_widget_columns');	
echo "</div>";



 echo "</div>"; 
		?>


<?php get_footer(); ?>

