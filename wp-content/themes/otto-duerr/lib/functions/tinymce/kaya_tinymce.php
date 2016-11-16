<?php
class add_kaya_shortcodes_button {
	
	var $pluginname = "shortcode_kaya";
	
	function add_kaya_shortcodes_button()  {
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
		
		// init process for button control
		add_action('init', array (&$this, 'addbuttons') );
	}

	function addbuttons() {
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		 
		// add the button for wp2.5 in a new way
			add_filter("mce_external_plugins", array (&$this, "add_tinymce_plugin" ), 5);
			add_filter('mce_buttons', array (&$this, 'register_button' ), 5);
		}
	}
	
	// used to insert button in wordpress 2.5x editor
	function register_button($buttons) {
	
		array_push($buttons, "separator", $this->pluginname );
	
		return $buttons;
	}
	function add_tinymce_plugin($plugin_array) {
		global $page_handle;
		global $post,$wpdb;

		
	$post_id = $_GET['post'];
		$post = get_post($post_id);
		$post_type = $post->post_type;

if($post_type == 'post'){
			$plugin_array[$this->pluginname] =  get_template_directory_uri() .'/lib/functions/tinymce/editor_plugin_post.js';
		}else{
//wp_enqueue_script("editor_plugin_page", get_template_directory_uri() ."/lib/functions/tinymce/editor_plugin_page.js", array("editor_plugin_page"), "1.0");
$plugin_array[$this->pluginname] =  get_template_directory_uri() .'/lib/functions/tinymce/editor_plugin_page.js';
}
			
		return $plugin_array;
	}
	
	function add_tinymce_langs_path($plugin_array) {
		// Load the TinyMCE language file	
		$plugin_array[$this->pluginname] = get_template_directory_uri() .'/lib/functions/tinymce/langs.php';
		return $plugin_array;
	}
	
	
	function change_tinymce_version($version) {
		return ++$version;
	}
	
}

// Call it now
$tinymce_button = new add_kaya_shortcodes_button ();
?>