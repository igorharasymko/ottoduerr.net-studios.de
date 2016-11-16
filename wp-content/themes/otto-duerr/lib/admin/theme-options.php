<?php
add_action('init','kaya_options');
$admin_img_url =  get_template_directory_uri() . '/lib/admin/images/';
if (!function_exists('kaya_options')) {
function kaya_options(){	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "";

// Populate OptionsFramework option in array for use in theme
global $kaya_options,$admin_img_url;
$kaya_options = get_option('kaya_options');
$porfolio_array =get_terms('portfolio_category','hide_empty=1');
$kaya_portfolio = array();
	foreach ($porfolio_array as $portfolio) {
	$kaya_portfolio[$portfolio->slug] = $portfolio->name;
	$portfolio_ids[] = $portfolio->slug;

	}
array_unshift($kaya_portfolio,'All');

$GLOBALS['template_path'] =KAYA_DIRECTORY;
//Access the WordPress Categories via an Array
$kaya_categories = array();  
$kaya_categories_obj = get_categories('hide_empty=0');
		foreach ($kaya_categories_obj as $kaya_cat) {
		$kaya_categories[$kaya_cat->cat_ID] = $kaya_cat->cat_name;
		}
$kaya_pages = array();
$kaya_pages_obj = get_pages('sort_column=post_parent,menu_order');    
	foreach ($kaya_pages_obj as $kaya_page) 
	{
		$kaya_pages[$kaya_page->ID] = $kaya_page->post_title; 
	}
// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 
// Background Defaults
$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
//Stylesheets Reader
$alt_stylesheet_path = KAYA_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {

    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 

        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {

            if(stristr($alt_stylesheet_file, ".css") !== false) {

                $alt_stylesheets[] = $alt_stylesheet_file;

            }

        }    

    }

}

//More Options

$uploads_arr = wp_upload_dir();

$url =  KAYA_DIRECTORY . '/lib/admin/images/';
$skinurl =  get_template_directory_uri() . '/images/skins/';
$all_uploads_path = $uploads_arr['path'];

$all_uploads = get_option('kaya_uploads');

$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");

$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

	// Set the Options Array
	$options = array();
	$options[] = array( "name" => "General Settings",
						"type" => "heading"
						);
						
				$options[]=	array(
						"name" => "Choose Layout Option",
						"type" => "radio",
						"id" => $shortname."layoutoption",
						"std" => "fluid",
						"options"  => array( 'boxed' => "Boxed Layout", 'fluid' => 'Fluid Layout' ),
						"desc" => ""
						);
	
		$options[]=	array(
						"name" => "Disable Top Toggle Box",
						"type" => "checkbox",
						"id" => $shortname."topToggleBoxDisable",
						"std" => "false",
						"desc" => "Check this box to disable top Toggle Box on every page."
					);
					
		$options[]=	array(
						"name" => "Disable Search Box",
						"type" => "checkbox",
						"id" => $shortname."searchBox",
						"std" => "false",
						"desc" => "Check this box to disable Search Box on every page."
					);
					
	
	$options[] = array( "name" => "Top Toggle Widget Columns",
					"desc" => "Select number of widge columns you want to display on the top toggle box.",
					"id" => "footercolumn",
					"std" => "4",
					"type" => "images",
					"options" => array(
						'1' => $admin_img_url . 'fc1.png',
						'2' => $admin_img_url . 'fc2.png',
						'3' => $admin_img_url . 'fc3.png',
						'4' => $admin_img_url . 'fc4.png',
						'5'	=> $admin_img_url . 'fc5.png'
						)
					);


	$options[] =array(
						"name" => "Top  Header Logo URL",
						"desc" => "Upload your image Logo like, Ex: logo.png",
						"id" => $shortname."logo",
						"std" => "",
						"type" => "upload"
					);			
					
	$options[] =array(	
						"name" => "Logo Margin Top",
						"desc" => "Add Margin Top, Keep it empty if your logo fit properly. Ex: 10, 20 etc. ",
						"id" => $shortname."logo_margin_top",
						"std" => "",
						"type" => "textsmall"
					);	
				
	$options[] =array(
						"name" => "Email ID",
						"desc" => "Add an email id to which you want to recieve contact imformation from <strong>Contact us</strong> page. ",
						"id" => $shortname."emailid",
						"std" => "",
						"type" => "text"
					);	
		
	$options[]=	array(
						"name" => "Disable Timthumb",
						"type" => "checkbox",
						"id" => $shortname."timthumb",
						"std" => "false",
						"desc" => "Check this box to disable timthumb,when the slider images or thubnail images do not display."
					);
					
	$options[] =array(
						"name" => "Change Read More Text",
						"desc" => "Change Read More text how you want to display on the readmore button. ",
						"id" => $shortname."kaya_readmore",
						"std" => "",
						"type" => "text"
					);	

	$options[] =array(
						"type" => "textarea",
						"name" => "Google Analytics",
						"std" => "",
						"desc" => "Paste your Google Analytics tracking code here, complete code along with javascript. <a href='http://support.google.com/googleanalytics/bin/answer.py?hl=en&answer=55488'>Refere this page</a>",
						"id" => $shortname."kaya_google_analytics"
						);
	// Frontpage code		
	$options[] = array( 
						"name" => "Front Page Settings",
						"type" => "heading"
					); 
			
	$options[]=	array(
						"name" => "Frontpage Settings",
						"desc" => "",
						"type" => "sortablemulticheck",
						"options" => $kaya_pages,
						"id" => $shortname."homecolumn",
						"std" => "2"
					);
// Portfolio Setting

	$options[] = array(
							"name" => "Portfolio ",
							"type" => "heading"
					   );
			
	$options[]=	array(
							"name" => "Disable Image in Portfolio sinlge Page",
							"type" => "checkbox",
							"id" => $shortname."portfolio_bigger_image",
							"std" => "false",
							"desc" => "Check this box to Disable the 'Bigger Image' in single Portfolio page'."
					);
				
						
	// Galley Setting

	$options[] = array(
							"name" => "Gallery ",
							"type" => "heading"
					   );
			
	$options[]=array(
							"name" => "Portrait Gallery image width",
							"desc" => "Add gallery image width ex: 205, Default sizes are 205px width and 275px height",
							"id" => $shortname."portrait_gallery_width",
							"std" => "",
							"type" => "textsmall"
					);
				
	$options[]=array(
							"name" => "Portrait Gallery image height",
							"desc" => "Add gallery image height ex: 300, Default sizes are 205px width and 275px height",
							"id" => $shortname."portrait_gallery_height",
							"std" => "",
							"type" => "textsmall"
					);
				
				
	$options[]=array(	
							"name" => "Lnadscape Gallery image width",
							"desc" => "Add gallery image width ex: 205, Default sizes are 205px width and 150px height",
							"id" => $shortname."lnadscape_gallery_width",
							"std" => "",
							"type" => "textsmall"
					);
				
	$options[]=array(
							"name" => "Lnadscape Gallery image height",
							"desc" => "Add gallery image height ex: 150, Default sizes are 205px width and 150px height",
							"id" => $shortname."lnadscape_gallery_height",
							"std" => "",
							"type" => "textsmall"
					);
				
				
				
	$options[]=	array(
						"name" => "Disable Image Title Description",
						"type" => "checkbox",
						"id" => $shortname."image_title",
						"std" => "false",
						"desc" => "Check this box to Disable Title Description for images."
					);
					
	$options[]=array(
							"name" => "Show Number of Gallery images",
							"desc" => "Enter Number of images you want to display on the gallery pages.",
							"id" => $shortname."gallery_images_limits",
							"std" => "",
							"type" => "textsmall"
					);
 	   

	/* Portfolio options	

	$options[] = array(
							"name" => "Portfolio",
							"type" => "heading"
					   ); 
					
	 $options[] =array(
							"name" => "Read More Text For Portfolio Page",
							"desc" => "Enter text for Read More for Sortable Portfolio Pages. ",
							"id" => $shortname."readmore",
							"std" => "",
							"type" => "text"
					  );

	 $options[] = array( 
							"name" => "Sortable Portfolio Options.",
							"type" => "subheading" 
						);
					
	 $options[] =array(
							"name" => "Read More Text For Sortable Portfolio Page",
							"desc" => "Enter text for Read More for Sortable Portfolio Pages. ",
							"id" => $shortname."sortable_portfolo_readmore",
							"std" => "",
							"type" => "text"
						);
	$options[]=	array(
							"name" => "Disable  Item Description",
							"type" => "checkbox",
							"id" => $shortname."sortable_portfolo_item_desc",
							"std" => "false",
							"desc" => "Check this box to Disable Item Description in sortable  portfolio page ."
					);	

	$options[]=	array(
							"name" => "Disable  Readmore",
							"type" => "checkbox",
							"id" => $shortname."sortable_portfolo_readmore_disable",
							"std" => "false",
							"desc" => "Check this box to Disable Readmore in sortable  portfolio page ."
					);
			
		
		*/
		// Blog options

	$options[] = array( 
							"name" => "Blog Page",
							"type" => "heading"
						); 	   

	$options[]=	array(
							"name" => "Blog Page",
							"desc" => "Select the categories to <strong>exclude</strong> the posts from Blog page ",
							"id" => $shortname."blog_pages",
							"std" => "",
							 "options" => $kaya_categories,
							"type" => "blogmulticheck"
					);
	$options[]=	array(
							"name" => "Disable Blog Bigger Post Image",
							"type" => "checkbox",
							"id" => $shortname."blog_bigger_image",
							"std" => "false",
							"desc" => "Check this box to Disable the 'Bigger Image' in single post page'."
					);

	$options[]= array(
							"name" => "Slider Settings",
							"type" => "heading"
					); 
					
	 $options[] =array(
							"name" => "Disable Frontpage Slider.", 
							"desc" => "Check this box to disable the Slider in Homepage",
							"id" => $shortname."sliderdisable",
							"std" => "false",
							"type" => "checkbox"
					);
	$options[]=array(
							"name" => "Choose slider",
							"id"	=> "chooseslider",
							"std"	=>"",
							"options" => array(
												"contentcarousel" => "Contentcarousel Slider",
												"sudoslider" => "Sudo Slider",
												"bxslider" => "Bxslider",
												"jcarousellite" => "jcarousellite Slider",
												"imageslidertext" => "Image Slider and Text",									
												"staticimage" => "staticimage",
												"staticvideo"	=> "staticvideo",
												),
							"type"	=> "select2",
					);


	$options[] =array(	
						"name" => "Adde header Description.",
						"desc" => "Add text which displays on the right side of the slider.",
						"id" => $shortname."slider_text",
						"std" => "",
						"type" => "textarea"
					);
					
					
	$options[] =array(	
						"name" => "slider limits.",
						"desc" => "Add number of slides you want to display on the slider",
						"id" => $shortname."slider_post_limits",
						"std" => "",
						"type" => "textsmall"
					);
					
	$options[] =array(	
						"name" => "Slider Height.",
						"desc" => "Eneter Height",
						"id" => $shortname."sliderheight",
						"std" => "",
						"type" => "textsmall"
					);
	$options[] =array(	
						"name" => "Disable  Slider Description.",
						"desc" => "Check This Box Disable  Slider Description",
						"id" => $shortname."slidertext_disable",
						"std" => "",
						"type" => "checkbox"
					);	
	$options[] =array(	
						"name" => "Enable Lightbox.",
						"desc" => "Check This Box Lightbox Enable",
						"id" => $shortname."lightbox_enable",
						"std" => "",
						"type" => "checkbox"
					);	
	
					
	$options[] =array(	
						"name" => "Single Image Upload.",
						"desc" => "If you would like to display single image without slides on the front page slider, add single image by clicking <strong>Upload Image</strong> button.",
						"id" => $shortname."kaya_single_img",
						"std" => "",
						"type" => "upload"
					);			
	$options[] =array(	
						"name" => "Single Image Link URL.",
						"desc" => "Add a link to the image, like this format: ex: http://www.domain.com",
						"id" => $shortname."kaya_single_img_linkurl",
						"std" => "",
						"type" => "text"
					);
	$options[] =array(	
						"name" => "Video Embed code.",
						"desc" => "Add Video embedcode. Note: please make sure that the width and height of the video should be 960x400 for Landscape and 255x400 for Potrait.",
						"id" => $shortname."videourl",
						"std" => "",
						"type" => "textarea"
					);	

		//  Custom sidebar code

	$options[]=array( 
							"name" => "Custom Sidebar",
							"type" => "heading"
					);
	$options[]=array(	
							"name" => "Custom sidebar",
							"desc" => "Click <strong>Add New Sidebar</strong> button and Enter the Sidebar Name and click <strong>Save All Changes</strong>. ",
							"id" => $shortname."customsidebar",
							"std" => "",
							"type" => "customsidebar"
					);	



				

	$options[] = array(
							"name" => "Custom Colors",
							"type" => "heading" 
					);	
	
	$options[] = array(
							"name" => "Frontpage Main Slider",
							"type" => "subheading" 
					);		
							
	$options[]=array(	
						"name" => "Frontpage Main Slider Background Color",
						"desc" => "Add color for Homepage slider Background, Ex: #333333  ",
						"id" => $shortname."HomeSliderBG",
						"std" => "",
						"type" => "color"
				);				
					
					
		$options[] = array(
							"name" => "Hyper Link Colors",
							"type" => "subheading" 
					);
				
	$options[]=array(	
							"name" => "Pages Hyper Link Color",
							"desc" => "Add Hyper link color for content section of the pages, Ex: #333333 ",
							"id" => $shortname."HyperLinkColor",
							"std" => "",
							"type" => "color"
					);
			
	$options[]=array(	
							"name" => "Hyper Link Mouse Over Color",
							"desc" => "Add Hyper link mouse over color for content section of the pages, Ex: #333333  ",
							"id" => $shortname."HyperLinkColorHover",
							"std" => "",
							"type" => "color"
					);
				

	
	// Typography
		$options[] = array( "name" => "Typography Settings",
						"type" => "heading" );				
		
		$options[] = array( "name" => "Google Font for Titles and Body of the page.",
				"type" => "subheading" );
			$options[]=	array(
						"name" => "Enable Typography",
						"type" => "checkbox",
						"id" => $shortname."kaya_typhography",
						"std" => "false",
						"desc" => "Check this box to enable the typography which are going to aplly."
					);
					

		$options[]=array(	"name" => "Google Font for Title Headings, H1, H2, H3, H4, H5, H6",
						"desc" => "Paste Google font name in the above text field, Ex: Merienda One, Get the Google Fonts from <a href='http://www.google.com/webfonts#ChoosePlace:select'>here</a>. <br> 
						How to find Google Font Name? check it out ".'<a href="'.get_template_directory_uri().'/images/gogole-font-name.png">here</a>' ,
							"id" => $shortname."google_generaltitlefont",
							"std" => '',
							"type" => "text");
							
		
																
		$options[]=array(	"name" => "Google Body Font",
							"desc" => "Paste Google font name in above text field" ,
							"id" => $shortname."google_bodyfont",
							"std" => '',
							"type" => "text");

											
		$options[] = array( "name" => "General Font Settings",
						"type" => "subheading" );			
						
										
		$options[]=array(	"name" => "Body Font size",
							"desc" => "Add Body Font Size in numbers as a pixels, minimum should be 12",
							"id" => $shortname."google_bodyfont_size",
							"std" => '12',
							"type" => "textsmall");	
		
		$options[]=array(	"name" => "H1 font size",
							"desc" => "Add H1 Title Font Size in numbers as a pixels, Ex: 24 Default is 24",
							"id" => $shortname."google_h1font_size",
							"std" => '24',
							"type" => "textsmall");	
										
		$options[]=array(	"name" => "H2 font size",
							"desc" => "Add H2 Title Font Size in numbers as a pixels, Ex: 22 Default is 22",
							"id" => $shortname."google_h2font_size",
							"std" => '22',
							"type" => "textsmall");
							
		$options[]=array(	"name" => "H3 font size",
							"desc" => "Add H3 Title Font Size in numbers as a pixels, Ex: 20 Default is 20",
							"id" => $shortname."google_h3font_size",
							"std" => '20',
							"type" => "textsmall");
							
		$options[]=array(	"name" => "H4 font size",
							"desc" => "Add H4 Title Font Size in numbers as a pixels, Ex: 18 Default is 18",
							"id" => $shortname."google_h4font_size",
							"std" => '18',
							"type" => "textsmall");
																
		$options[]=array(	"name" => "H5 font size",
							"desc" => "Add H5 Title Font Size in numbers as a pixels, Ex: 16 Default is 16",
							"id" => $shortname."google_h5font_size",
							"std" => '16',
							"type" => "textsmall");
							
		$options[]=array(	"name" => "H6 font size",
							"desc" => "Add H6 Title Font Size in numbers as a pixels, Ex: 14 Default is 14",
							"id" => $shortname."google_h6font_size",
							"std" => '14',
							"type" => "textsmall");

	// Footer section
				
	$options[] =array( 
							"name" => "Footer",
							"type" => "heading"
						); 	

	$options[] =array(
						"type" => "textarea",
						"name" => "Footer CopyRight",
						"desc" => "Paste your Footer CopyRight",
						"std"	=>"",
						"id" => $shortname."kaya_footercopyright"
			); 
update_option('kaya_template',$options); 					  
update_option('kaya_themename',$themename);   
update_option('kaya_shortname',$shortname);
}
}
?>