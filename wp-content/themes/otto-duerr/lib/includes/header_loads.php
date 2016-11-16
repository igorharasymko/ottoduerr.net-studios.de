<?php
/// juqery and css loads
function kaya_jquery_scripts()
{	
/**
* Whether the current request is for a network or blog admin page
* @return bool True if inside WordPress  pages.
 */
if(!is_admin()){
	wp_enqueue_script("jquery");	
	wp_register_script('jquery_tools', KAYA_THEME_JS .'/jquery.tools.min.js');
	wp_register_script('jquery_bxsldier', KAYA_THEME_JS .'/jquery.bxSlider.min.js');
	
	//wp_enqueue_script('jquery-tools', KAYA_THEME_JS .'/jquery.tools.min.js');	
	// for nivo slider widgets
	wp_register_script('kaya_nivo', KAYA_THEME_JS.'/jquery.nivo.slider.pack.js');
	wp_register_style('style_nivo', get_template_directory_uri() . '/css/nivo-slider.css', false, '3.0', 'all');
	
	wp_localize_script( 'jquery', 'wppath', array('template_path' => get_template_directory_uri('template_directory')));
	
	
//  frontpage main slider
	wp_register_script('jquery_contentcarousel', KAYA_THEME_JS .'/jquery.contentcarousel.js','','',true,'in_footer');
	wp_register_style('css_carousel_style', get_template_directory_uri().'/css/carousel_style.css',false, '3.0', 'all');
	
//  Home alternate slider
	wp_register_script('jquery_jcarousellite', KAYA_THEME_JS .'/jcarousellite_1.0.1.js','','',true,'in_footer');
	wp_register_style('css_jcarousellite', get_template_directory_uri().'/css/jcarousellite.css',false, '3.0', 'all');
	
//  Testimonial Sudo slider & News jcarousellite slider
	wp_register_script('jcarousellite', KAYA_THEME_JS .'/jcarousellite_1.0.1.js','','',true,'in_footer');
	wp_register_script('jquery_sudoSlider', KAYA_THEME_JS .'/jquery.sudoSlider.js','','',true,'in_footer');
	
// filter portfoloio
	wp_register_script('filter_portfolio', KAYA_THEME_JS .'/filter_portfolio.js','','',true,'in_footer');
	wp_register_style('css_filter_portfolio', get_template_directory_uri().'/css/filter_portfolio.css',false, '3.0', 'all');
	
// for contact us page
	wp_register_style('css_filter_portfolio', get_template_directory_uri().'/css/filter_portfolio.css',false, '3.0', 'all');


// for fancybox / lightbox / zoom box
	wp_register_script('jquery_fancybox_pack', KAYA_THEME_JS .'/fancybox/jquery.fancybox-1.3.4.pack.js');
	wp_register_style('css_fancybox', KAYA_THEME_JS .'/fancybox/jquery.fancybox-1.3.4.css', false, '3.0', 'all');
	wp_register_script( 'jquery_easing', KAYA_THEME_JS .'/jquery.easing.1.3.js');
	
// Galleria shortcode
	wp_register_script('jquery-galleria', KAYA_THEME_JS .'/galleria/galleria.js','','',true,'in_footer');
	wp_register_script('jquery-classic', KAYA_THEME_JS .'/galleria/themes/classic/galleria.classic.js','','',true,'in_footer');
	
// for top drodown menu on  all pages
	wp_enqueue_script('jquery-jqueryslidemenu', KAYA_THEME_JS .'/jqueryslidemenu.js');
	

	
	
// custom script
	wp_enqueue_script('jquery-custom', KAYA_THEME_JS .'/custom.js','','',true,'in_footer');

	wp_register_script( 'jquery-validation', KAYA_THEME_JS .'/jquery.validation.js');
				
//wp_register_script( 'jquery-tabify', KAYA_THEME_JS .'/jquery.tabify.js');
//wp_enqueue_script('jquery-custom', KAYA_THEME_JS .'/custom.js','','',true,'in_footer');

		if (is_page_template('template-contact.php') ){ 
		
		}
	}
}
      

add_action('wp_print_scripts', 'kaya_jquery_scripts');
function kaya_style_css()
{
/**
* Whether the current request is for a network or blog admin page
* @return bool True if inside WordPress administration pages.
 */
		if(is_admin())
		{

			wp_enqueue_style('meta_stylelayout', get_template_directory_uri() . '/lib/admin/meta-style.css', false, '3.0', 'all');	
			wp_enqueue_style('metacolor-picker', KAYA_DIRECTORY.'/lib/admin/css/colorpicker.css', false, '3.0', 'all');

		}

}
add_action('init', 'kaya_style_css');
?>