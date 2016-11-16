<?php

// look up for the path
require_once('tinymce-config.php');

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here", 'Apogee'));

global $wpdb;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
.panel_wrapper {
height:250px !important;
}
</style>
<head>
	<title> <?php _e("Kaya Shortcodes", 'Apogee'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri(); ?>/lib/functions/tinymce/tinymce.js"></script>
<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('mediatag').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="kaya_shortcodes" action="#">
	<div class="tabs">
		<ul>
			<li id="shortcodes_tab" class="current"><span><a href="javascript:mcTabs.displayTab('shortcodes_tab','shortcodes_panel');" onmousedown="return false;"><?php _e("General Shortcodes", 'Apogee'); ?></a></span></li>
			<li id="portfolio_tab"><span><a href="javascript:mcTabs.displayTab('portfolio_tab','portfolio_panel');" onmousedown="return false;"><?php _e("portfolio", 'Apogee'); ?></a></span></li>
          
		</ul>
	</div>
	
	<div class="panel_wrapper">
		<!-- media panel -->
		<div id="shortcodes_panel" class="panel current">
		<br />
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>

 <td nowrap="nowrap"><label for="kayashortcodetag"> <?php _e("Select Shortcode", 'Apogee'); ?></label></td>
            <td><select id="kayashortcodetag" name="kayashortcodetag" style="width: 190px">	
<?php $i=1;
foreach ($shortcode_tags as $shortcodekey => $short_code_value) { 

if( stristr($short_code_value, 'kaya_') ) {

$shortcode_name = str_replace('kaya_shortcode_', 'Apogee' ,$short_code_value);

if($i==1)
{
 echo  '<optgroup label="Genral">';
}
if($i==22)
{
 echo  '</optgroup>';
}
if($i==22)
{

 echo  '<optgroup label="columns">';
}
?>
<?php	
echo '<option value="' . $shortcodekey . '" >' . ucwords(str_replace('_',' ',$shortcodekey)).'</option>' . "\n";
$i++;
} 
}echo '</select></td>';
?>
   </td>
   </tr>
        </table>
		</div>
		
		<div id="portfolio_panel" class="panel">
		<br />
		
  <table border="0" cellpadding="4" cellspacing="0">
         <tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Select Categories", 'Apogee'); ?></label></td>
            <td>
			<?php
			
			
?>
<select multiple="multiple" name="portfolio_tag" id="portfolio_tag" style="width: 200px; height:80px;">
<option value=""> <?php _e("All", 'Apogee'); ?></option>
<?php $tax_portfolio = get_terms('portfolio_category','orderby=name&hide_empty=0');
				foreach($tax_portfolio as $key => $portfolio) {
								
	 ?>
			<option value="<?php echo $portfolio->slug; ?>"><?php echo $portfolio->name; ?>
			</option>
			<?php } ?>
		</select>
		</td>
          </tr>
		  
<tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Number of Columns", 'Apogee'); ?></label></td>
            <td>
			<input type="text" name="max_columns" id="max_columns" size="5" value='4' > <small><?php _e("( max 5 columns start: 1 to 5)", 'Apogee'); ?></small>
		</td>
          </tr>
		  
		   <tr>
		 
		   <tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Posts Per Page", 'Apogee'); ?></label></td>
            <td>
			<input type="text" id="images_pages" name="images_pages" size="6" value='4'> 
		</td>
          </tr>
               <tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Sidebar", 'Apogee'); ?></label></td>
            <td> <input type="radio"  id="portfolio_sidebar"  name="portfolio_sidebar" value="off" checked><?php _e("Off", 'Apogee'); ?>
			<input type="radio"  id="portfolio_sidebar"   name="portfolio_sidebar" value="on"><?php _e("On", 'Apogee'); ?>
			
		</td>
          </tr>
    
        </table>
 
		</div>
		<!-- portfolio panel end -->
        <!-- Blog panel start -->
        <div id="blog_panel" class="panel">
		<br />
		
  <table border="0" cellpadding="4" cellspacing="0">
         <tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Select Category", 'Apogee'); ?></label></td>
            <td>
			<?php
			
			
?>
<select name="blog_tag" id="blog_tag" style="width: 200px">
<option value=""> <?php _e("All", 'Apogee'); ?></option>
<?php $cat = get_categories('orderby=name&hide_empty=0');
				foreach($cat as $key => $blog) {
								
	 ?>
			<option value="<?php echo $blog->cat_ID; ?>"><?php echo $blog->name; ?>
			</option>
			<?php } ?>
		</select>
		</td>
          </tr> 
		   <tr>
		 
            <td nowrap="nowrap"><label for="blog_tag"><?php _e("Posts Per Page", 'Apogee'); ?></label></td>
            <td>
			<input type="text" id="numberof_post" name="numberof_post" size="6" value='4'> 
		</td>
          </tr>
           <tr>
		 
            <td nowrap="nowrap"><label for="blog_tag"><?php _e("Image Width", 'Apogee'); ?></label></td>
            <td>
			<input type="text" id="imagewidth" name="imagewidth" size="6" value='180'> 
		</td>
          </tr>
            <tr>
		 
            <td nowrap="nowrap"><label for="blog_tag"><?php _e("Image Height", 'Apogee'); ?></label></td>
            <td>
			<input type="text" id="imageheight" name="imageheight" size="6" value='180'> 
		</td>
          </tr>
          
             <tr>
		 
            <td nowrap="nowrap"><label for="blog_tag"><?php _e("Meta Info Show/Hide", 'Apogee'); ?></label></td>
            <td>
			<input type="radio"  name="metainfo_show" id="metainfo_show"  value="on" checked><?php _e("Show", 'Apogee'); ?>
			<input type="radio"  name="metainfo_show" id="metainfo_show" value="off" ><?php _e(" Hide", 'Apogee'); ?>
		</td>
          </tr>
         
            <tr>
		 
            <td nowrap="nowrap"><label for="blog_tag"><?php _e("Post Image Show/Hide", 'Apogee'); ?></label></td>
            <td>
			<input type="radio"  name="postimg_show" id="postimg_show"  value="on" checked> <?php _e("Show", 'Apogee'); ?>
			<input type="radio"  name="postimg_show" id="postimg_show" value="off" ><?php _e("Hide", 'Apogee'); ?>
		</td>
          </tr>
           <tr>
		 
            <td nowrap="nowrap"><label for="blog_tag"><?php _e("Pagination Show/Hide", 'Apogee'); ?></label></td>
            <td>
			<input type="radio"  name="pagination_show" id="pagination_show"  value="on" checked><?php _e("Show", 'Apogee'); ?>
			<input type="radio"  name="pagination_show" id="pagination_show" value="off" ><?php _e(" Hide", 'Apogee'); ?>
		</td>
          </tr>
    
        </table>
 
		</div>

        <!-- Blog panel end -->
             	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'Apogee'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'Apogee'); ?>" onclick="insertshortcodes();" />
		</div>
	</div>
</form>
</body>
</html>
