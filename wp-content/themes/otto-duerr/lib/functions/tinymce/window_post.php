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
<head>
	<title><?php _e("Kaya Shortcodes", 'Apogee'); ?></title>
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
<?php
foreach ($shortcode_tags as $shortcodekey => $short_code_value) {

if( stristr($short_code_value, 'kaya_') ) {

$shortcode_name = str_replace('kaya_shortcode_', 'Apogee' ,$short_code_value);
?><?php	
echo '<option value="' . $shortcodekey . '" >' .ucwords(str_replace('_',' ',$shortcodekey)).'</option>' . "\n";

}
}echo '</select></td>';
?>
            </td>
          </tr>
        </table>
		</div>
		
		<div id="portfolio_panel" class="panel">
		<br />
		
 
 
		</div>
		
              <div id="gallery_panel" class="panel">
		
		</div>
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
