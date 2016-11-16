<?php
global $meta_boxes;
//$metabox=array();
add_action('admin_menu', 'page_add_box');
function  page_add_box()
{
global $meta_boxes;
foreach($meta_boxes as $post_type => $value)
{
add_meta_box($value['id'], $value['title'], 'page_show_box', $post_type, $value['context'], $value['priority']);
}
}
// Callback function to show fields in meta box
function page_show_box() {
global $page, $post,$meta_boxes;
	// Use nonce for verification
	echo '<div class="kayaoptions-formtable">';
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	// Begin the fields loop
	foreach ($meta_boxes[$post->post_type]['fields']  as $field) {
			$meta = get_post_meta($post->ID, $field['id'], true);
			if($meta=="") $meta=$field['std'];
						echo '<div class="metapanel" id="slider_'.$field['id'].'">',
			'<div class="formfirstcolumn"><label for="', $field['id'], '">', $field['name'], '</label></div>',
			'<div class="fieldsdiv">';
			switch ($field['type']) 
			{
					case 'text':
							echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:60%" />';
							echo '<span class="desc">', $field['desc'],'</span>';
					break;
					case 'textarea':
							echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="20" rows="2" style="width:600px">', $meta ? $meta : $field['std'], '</textarea>';
							echo '<span class="desc">', $field['desc'],'</span>';
					break;
					case 'sselect':
							echo '<select name="', $field['id'], '" id="', $field['id'], '">';
						foreach ($field['options'] as $key => $val) {
							echo '<option value="', $key, '" ', $meta == $key ? ' selected="selected"' : '', '>', $val, '</option>';
						}
						echo '</select>';
					break;
					case 'select':
						echo '<select name="', $field['id'], '" id="', $field['id'], '">';
						foreach ($field['options'] as $key => $val) {

							echo '<option value="', $key, '" ', $meta == $key ? ' selected="selected"' : '', '>', $val, '</option>';

						}
						echo '</select>';
						echo '<span class="desc">', $field['desc'],'</span>';
					break;
					case 'radio':
							foreach ($field['options'] as $key => $val) {
							echo '<input  class="radio_button" type="radio" name="', $field['id'], '" value="', $key, '"', $meta == $key ? ' checked="checked"' : '', ' />', $val; 
							}
					break;
					case 'checkbox':
							echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;&nbsp;' , $field['desc'];
					break;
					case 'upload': 
							echo "<span><label for='upload_image'>";
							echo'<input value="'.stripslashes(get_post_meta($post->ID, $field['id'], true)).'" type="text" name="'.$field['id'].'"  id="'.$field['id'].'" size="50%" />';
							echo '<input class="upload_img_button"  id="'.$field['id'].'" type="button" value="Upload Image" />';
							echo '</label></span>';
							echo '<span class="desc">', $field['desc'],'</span>';
						
					break;
			}

			echo '</div>';
			echo '</div>';
	} // end fileds
	echo '</div>';
}
add_action('save_post', 'meta_save_data');
add_action('admin_init','custompagemeta_jsscript');
function custompagemeta_jsscript(){
wp_enqueue_script('custommeta_script', get_template_directory_uri() .'/lib/admin/js/custommeta_jsscript.js',array('jquery'));
wp_enqueue_script('color-picker', KAYA_DIRECTORY.'/lib/admin/js/colorpicker.js', array('jquery'));
}
// Save data from meta box
function meta_save_data($post_id) {
	global $meta_boxes,$post;
	// verify nonce
	if (!wp_verify_nonce(isset($_POST['mytheme_meta_box_nonce']), basename(__FILE__))) {
		return $post_id;
	}
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	// loop through fields and save the data
	  foreach ($meta_boxes[$post->post_type]['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end loop
}
?>