<link href="<?php echo get_template_directory_uri(); ?>/css/parallax.css" rel="stylesheet" type="text/css" />
<?php global $width,$height,$class,$sliderlayout;?>
<div class="slider"><!--start slider -->
				<div class="container">
                    <div id="ca-container" class="ca-container" style="margin-top:20px;">
<?php
$timthumb=get_option('timthumb');
$linkurl=get_option('kaya_single_img_linkurl')? get_option('kaya_single_img_linkurl') :'#';
$imgurl=get_option('kaya_single_img');
$width="959";
$height="400";
if($timthumb!="true"){
	?>				
 <a href="<?php echo $linkurl; ?>">
                 <img  src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $imgurl; ?>&amp;w=<?php echo $width;?>&amp;h=<?php echo $height;?>&amp;zc=1"  alt="<?php echo the_title(); ?>" class="img_radius"  /> </a> <?php
			}else{
			 $image = vt_resize('',$imgurl,$width,$height, true );  ?>
			 <a href="<?php echo $linkurl; ?>"><img  <?php echo $title; ?> src="<?php echo $image['url']; ?>" width="<?php echo $width;?>" height="<?php echo $height;?>" alt="<?php echo the_title(); ?>" class="img_radius" /></a>
			<?php
			}
?>
</div>
</div>
</div>



  