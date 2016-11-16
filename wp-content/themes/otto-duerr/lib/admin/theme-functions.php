<?php



/* These are functions specific to the included option settings and this theme */



/*-----------------------------------------------------------------------------------*/

/* Theme Header Output - wp_head() */


/*-----------------------------------------------------------------------------------*/

/* Output CSS from standarized options */

/*-----------------------------------------------------------------------------------*/



function kaya_head_css() {



		$shortname =  get_option('kaya_shortname'); 

		$output = '';

		

		$custom_css = get_option('kaya_custom_css');

		

		if ($custom_css <> '') {

			$output .= $custom_css . "\n";

		}

		

		// Output styles

		if ($output <> '') {

			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";

			echo $output;

		}

	

}



/*-----------------------------------------------------------------------------------*/

/* Add Body Classes for Layout

/*-----------------------------------------------------------------------------------*/



// This used to be done through an additional stylesheet call, but it seemed like

// a lot of extra files for something so simple. Adds a body class to indicate sidebar position.



add_filter('body_class','kaya_body_class');

 

function kaya_body_class($classes) {

	$shortname =  get_option('kaya_shortname');

	$layout = get_option($shortname .'_layout');

	if ($layout == '') {

		$layout = 'layout-2cr';

	}

	$classes[] = $layout;

	return $classes;

}



/*-----------------------------------------------------------------------------------*/

/* Add Favicon

/*-----------------------------------------------------------------------------------*/



function childtheme_favicon() {

		$shortname =  get_option('kaya_shortname'); 

		if (get_option($shortname . '_custom_favicon') != '') {

	        echo '<link rel="shortcut icon" href="'.  get_option('kaya_custom_favicon')  .'"/>'."\n";

	    }

		else { ?>

			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/admin/images/favicon.ico" />

<?php }

}



add_action('wp_head', 'childtheme_favicon');



/*-----------------------------------------------------------------------------------*/

/* Show analytics code in footer */

/*-----------------------------------------------------------------------------------*/



function childtheme_analytics(){

	$shortname =  get_option('kaya_shortname');

	$output = get_option($shortname . '_google_analytics');

	if ( $output <> "" ) 

		echo stripslashes($output) . "\n";

}

add_action('wp_footer','childtheme_analytics');
?>