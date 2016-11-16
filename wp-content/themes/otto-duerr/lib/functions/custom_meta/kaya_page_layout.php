<?php
 $prefix = '';
// Page Field Array
 $page_layout = array(
	'id' => 'my-page-layout',
	'title' => 'Page Layout Options',
	'page' => 'page_show_layout',
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(
			array(
			'name' => 'Choose Page Style',
			'desc' => 'Select Page style <em>Fullwidth</em> or <em>Right Sidebar</em> or <em>Left Sidebar</em> ',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select1',
			'std'	=> '',
			'options' => array( "rightsidebar" => "Right Sidebar", "leftsidebar" => "Left Sidebar","full" => "Full Width")
			),
		
		array(
			'name' => 'Select Sidebar Widget Area',
			'desc' => 'Select "Sidebar Widget Area" you want to display on this page, <br><em>Note: create custom sidebar widget areas by navigating to "Theme Options > Custom Sidebar" those are displayed in this list box.</em>',
			'id' => $prefix . 'kaya_widgetsidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => $sidebar_widgets
			),
	)

);

add_action('admin_menu', 'page_add_layout');
// Add the Meta Box  
function page_add_layout() {
	global $page_layout;
			add_meta_box( 
			$page_layout['id'],  //$id
			'Page Layout Options', //$title
			'page_show_layout', // $Callback
			'page', //$page
			'side', //$context
			'high' //$priority  
	);
	add_meta_box( 
			$page_layout['id'],  //$id
			'Page Layout Options', //$title
			'page_show_layout', // $Callback
			'post', //$page
			'side', //$context
			'high' //$priority  
	); 
	add_meta_box( 
			$page_layout['id'],  //$id
			'Page Layout Options', //$title
			'page_show_layout', // $Callback
			'slider', //$page
			'side', //$context
			'high' //$priority  
	);  
		add_meta_box( 
			$page_layout['id'],  //$id
			'Page Layout Options', //$title
			'page_show_layout', // $Callback
			'portfolio', //$page
			'side', //$context
			'high' //$priority  
	); 

}

// Callback function to show fields in meta box
function page_show_layout() {

		global $page_layout,$post,$page;
		// Use nonce for verification
		echo '<input type="hidden" name="mytheme1_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		// Begin the Page fields loop
	foreach ($page_layout['fields'] as $field) {
				// get value of this field if it exists for this post 
				$meta = get_post_meta($post->ID, $field['id'], true);
					echo '<div class="', $field['id'], '">';
					if($meta=="") $meta=$field['std'];
					echo '<p><strong>',$field['name'],'</strong></p>';
				
							switch ($field['type']) {
								 // case items will go here  
								case 'select':
										echo '<select name="', $field['id'], '" id="', $field['id'], '">';
										foreach ($field['options'] as $key => $val) {
											echo '<option value="', $val, '" ', $meta == $val ? ' selected="selected"' : '', '>', $val, '</option>';
										}
										echo '</select>';
										echo '<p><label>',$field['desc'],'</label></p>';
								break;
								case 'select1':
										echo '<select name="', $field['id'], '" id="', $field['id'], '">';
										foreach ($field['options'] as $key => $val) {
										echo '<option value="', $key, '" ', $meta == $key ? ' selected="selected"' : '', '>', $val, '</option>';
										}
										echo '</select>';
										echo '<p><label>',$field['desc'],'</label></p>';
								break;
									
						} //endswitch
			echo '</div>';
			} // end foreach	

}
add_action('save_post', 'page_save_layout_data');
add_action('admin_init','custompagemetalayout_jsscript');
function custompagemetalayout_jsscript(){
wp_enqueue_script('custommeta_script', get_template_directory_uri() .'/lib/admin/js/custommeta_jsscript.js',array('jquery'));
wp_enqueue_script('color-picker', KAYA_DIRECTORY.'/lib/admin/js/colorpicker.js', array('jquery'));
}
// Save data from meta box
function page_save_layout_data($post_id) {
		global $page_layout,$page;
		// verify nonce

		if (!wp_verify_nonce(isset($_POST['mytheme1_meta_box_nonce']), basename(__FILE__))) {
			// TODO: Fix this and enable verify nonce!	
			//return $post_id;
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
		}elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		 // loop through fields and save the data
		foreach ($page_layout['fields'] as $field) {
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