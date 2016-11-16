<?php
// Define Themename
$themename="Apogee";
define('KAYA_LIB', TEMPLATEPATH . '/lib');
define('KAYA_ADMIN', KAYA_LIB . '/admin');
define('KAYA_FUNCTIONS', KAYA_LIB . '/functions');
define('KAYA_WIDGETS', KAYA_LIB . '/functions/widgets');
define('KAYA_META', KAYA_LIB . '/functions/custom_meta');
define('KAYA_SHORTCODES', KAYA_LIB . '/functions/shortcodes');
define('KAYA_INCLUDES', KAYA_LIB . '/includes');
define('KAYA_THEME_JS', get_template_directory_uri() . '/js');
define('KAYA_ADMIN_JS', get_template_directory_uri() . '/lib/admin/js');

// theme optional panel

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('KAYA_FILEPATH', TEMPLATEPATH);
	define('KAYA_DIRECTORY', get_template_directory_uri());

} else {
	define('KAYA_FILEPATH', STYLESHEETPATH);
	define('KAYA_DIRECTORY', get_template_directory_uri());
}
// Disable wordpress automatic formating 
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content','my_formatter',99);
add_filter('widget_text','my_formatter',99);

/* These files build out the options interface.  Likely won't need to edit these. */
require_once(KAYA_FUNCTIONS . '/custom_posts/kaya_slider.php');
require_once(KAYA_FUNCTIONS . '/custom_posts/kaya_portfolio.php');
//require_once (KAYA_FILEPATH . '/lib/admin/admin-functions.php');		// Custom functions and plugins
require_once (KAYA_FILEPATH . '/lib/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */
require_once (KAYA_FILEPATH . '/lib/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (KAYA_FILEPATH . '/lib/admin/theme-functions.php'); 	// Theme actions based on options settings
require_once(KAYA_INCLUDES . '/header_loads.php'); //header functions
require_once(KAYA_INCLUDES . '/portfolio_walker.php'); // portfolio category  walker
require_once(KAYA_INCLUDES . '/breadcrumbs-plus/breadcrumbs-plus.php'); // Breadcrumb
require_once(KAYA_FUNCTIONS . '/kaya_pagination.php'); // pagination functions
require_once(KAYA_INCLUDES . '/kaya_vt_resize.php'); // pagination functions
require_once(KAYA_INCLUDES . '/twitter_feeds.php'); // twitter feeds functions
require_once(KAYA_FUNCTIONS . '/kaya_comments.php'); // comments page
require_once(KAYA_FUNCTIONS . '/common.php'); // comman functions
require_once(KAYA_FUNCTIONS . '/var.php'); // comman functions

//  custom meta box
require_once(KAYA_META . '/kaya_page_layout.php'); 
//require_once(KAYA_META . '/kaya_page_meta.php'); // Custom Meta Page
//require_once(KAYA_META . '/kaya_post_meta.php'); // custom meta posts page
require_once(KAYA_META . '/kaya_slider_meta.php'); // custom slider meta page
require_once(KAYA_META . '/kaya_portfolio_meta.php'); // custom portfolio meta page
require_once(KAYA_META .'/meta_class.php');

require_once(KAYA_SHORTCODES . '/kaya_portfolio.php');   // portfolio shortcode
require_once(KAYA_SHORTCODES . '/kaya_general.php'); // general shortcode
require_once(KAYA_SHORTCODES . '/kaya_tabs_and_toggle.php'); // tabs and toggles shortcodes
require_once(KAYA_SHORTCODES . '/kaya_teaser_boxes.php'); // teaser box shortcodes
//require_once(KAYA_SHORTCODES . '/kaya_services.php'); // services shortcodes
//require_once(KAYA_SHORTCODES . '/kaya_testimonial.php'); // testimonial shortcodes
require_once(KAYA_SHORTCODES . '/kaya_socialicons.php'); // socialicons shortcodes
require_once(KAYA_SHORTCODES . '/kaya_columns.php'); // layout shortcodes 
require_once(KAYA_SHORTCODES . '/kaya_galleria.php'); // galleria shortcodes
require_once(KAYA_SHORTCODES . '/kaya_teaser.php'); // teaser shortcodes
require_once(KAYA_SHORTCODES . '/kaya_image_slider.php'); // video shortcodes

require_once(KAYA_WIDGETS . '/widgets.php');
require_once(KAYA_WIDGETS . '/mini_contact_widget.php'); // display mini contact form
require_once(KAYA_WIDGETS . '/kaya_popularpost.php'); // displays the most pupular post baed on comments
require_once(KAYA_WIDGETS . '/kaya_recentpost.php'); // displays the most recent category posts
require_once(KAYA_WIDGETS . '/kaya_cat_post_slider_news.php'); // Slider for category post items
require_once(KAYA_WIDGETS . '/kaya_cat_post_slider_testimonial.php'); // Testimonial Slider for category post items
require_once(KAYA_WIDGETS . '/kaya_flickr.php'); // displays flickr images
require_once(KAYA_WIDGETS . '/kaya_twitter.php'); // displays the twitter comments
require_once(KAYA_WIDGETS . '/kaya_contactinfo.php'); // displays mailing address
require_once(KAYA_WIDGETS . '/kaya_tax_recentpost.php'); // displays the most recent portfolio items
require_once(KAYA_WIDGETS . '/kaya_tax_portfolio_nivoslider.php'); // displays the most recent portfolio items in a slider 


// tinymce editor 
require_once(KAYA_FUNCTIONS.'/tinymce/kaya_tinymce.php');
add_filter('widget_text','do_shortcode');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_header', 'wp_generator'); 

function wpt_remove_version() {  
       return '';  
    }  
    add_filter('the_generator', 'wpt_remove_version');  

// Make theme available for translation
// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'Apogee', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		

//remove_action('wp_head', 'wp_generator');

// This theme allows users to set a custom background
	add_custom_background();

// This theme menu supports
	add_theme_support( 'nav-menus' );
	add_editor_style();
	if ( ! isset( $content_width ) )
	$content_width ='';
	//add_custom_image_header( '', 'kaya_admin_custom_skin' );

// This theme uses wp_nav_menu() in 2 location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'Apogee' ),
		//'secondary' => __( 'Secondary Navigation' , 'Apogee'),

		) );

// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
// limit the post content ======================================================================================
function content($num) {
$theContent = get_the_content();
$output = preg_replace('/<img[^>]+./','', $theContent);
$output = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $output );
$output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
$limit = $num+1;
$content = explode(' ', $output, $limit);
array_pop($content);
$content = implode(" ",$content)."...";
return $content;
}

// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
function has_portfolio_category( $portfolio_category, $_post = null ) {
	if ( empty( $person ) )
		return false;
	if ( $_post )
		$_post = get_post( $_post );
	else

		$_post =& $GLOBALS['post'];

	if ( !$_post )
		return false;
	$r = is_object_in_term( $_post->ID, 'portfolio_category', $portfolio_category );

		if ( is_wp_error( $r ) )
		return false;
	return $r;
}
/*

 * Thank to Bob Sherron.
 * http://stackoverflow.com/questions/1155565/query-multiple-custom-taxonomy-terms-in-wordpress-2-8/2060777#2060777

 */

function multi_tax_terms($where) {
    global $wp_query;
    global $wpdb;
    if (isset($wp_query->query_vars['term']) && (strpos($wp_query->query_vars['term'], ',') !== false && strpos($where, "AND 0") !== false) ) {
        // it's failing because taxonomies can't handle multiple terms
        //first, get the terms
        $term_arr = explode(",", $wp_query->query_vars['term']);
        foreach($term_arr as $term_item) {
            $terms[] = get_terms($wp_query->query_vars['taxonomy'], array('slug' => $term_item));
        }

        //next, get the id of posts with that term in that tax
        foreach ( $terms as $term ) {
            $term_ids[] = $term[0]->term_id;
        }

        $post_ids = get_objects_in_term($term_ids, $wp_query->query_vars['taxonomy']);

        if ( !is_wp_error($post_ids) && count($post_ids) ) {
            // build the new query
            $new_where = " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
            // re-add any other query vars via concatenation on the $new_where string below here

            // now, sub out the bad where with the good
            $where = str_replace("AND 0", $new_where, $where);
        } else {
            // give up
        }
    }
    return $where;
}
add_filter("posts_where", "multi_tax_terms");

function kaya_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'kaya_remove_recent_comments_style' );
?>
<?php
function homepage_column( $id = '', $class = '', $homepagewidget = '' ) {
    return "<div id='{$id}' class='{$class}'>".homepage_dynamic_sidebar( $homepagewidget )."</div>";
}
function homepage_dynamic_sidebar($index = '') {
	$homesidebar_contents = "";
	ob_start();
        if ( function_exists('dynamic_sidebar') && dynamic_sidebar( $index ) ){
	$homesidebar_contents = ob_get_clean();
	return $homesidebar_contents;
	}
}
?>