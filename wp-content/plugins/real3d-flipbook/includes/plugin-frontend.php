<?php
	function real3dflipbook_shortcode($atts){
		$args = shortcode_atts( 
			array(
				'id'   => '-1'
			), 
			$atts
		);
		$id = (int) $args['id'];
		$flipbooks = get_option('flipbooks');
		$flipbook = $flipbooks[$id];
		$flipbook['rootFolder'] = plugins_url()."/real3d-flipbook/";
		$output = ('<div class="real3dflipbook" id="'.$id.'" ><div id="options" style="display:none;">'.json_encode($flipbook).'</div></div>');
		return $output;
	}
	add_filter('widget_text', 'do_shortcode');
	add_shortcode('real3dflipbook', 'real3dflipbook_shortcode');