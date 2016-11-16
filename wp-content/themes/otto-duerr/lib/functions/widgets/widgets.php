<?php

// custom sidebar widgets create funtions
if ( function_exists('register_sidebar') )
	{	
		 $dynamic_widgets =get_option('customsidebar');
		// print_r($sidebar_widgets);
		  if(is_array($dynamic_widgets)){
		  if($dynamic_widgets) {
		foreach ($dynamic_widgets as $page_name)
		{	 
			if($page_name != "") {
			register_sidebar(array(
			'name' =>$page_name,
			'id'            => 'sidebar-'.strtolower(preg_replace('/\s+/', '-', $page_name)),
			'description' => esc_html__('A widget area, used as sidebar for "'.$page_name.'" Section', 'Apogee'),		
			'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
			'after_widget' => '</div> </div> <div class="v-sapce"></div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
				));
		} }
	}
	}
}


// Register Widget Home Column1 
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Home Column1',
		'id'            => 'home_column1',
		'description' => esc_html__('A widget area, used as a Homepage Column1', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));
// Register Widget Home Column2 
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Home Column2',
		'id'            => 'home_column2',
		'description' => esc_html__('A widget area, used as a Homepage Column2', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));
// Register Widget Home Column1 
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Home Column3',
		'id'            => 'home_column3',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));

// Register Widget Home Column1 
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Home Column4',
		'id'            => 'home_column4',
		'description' => esc_html__('A widget area, used as a Homepage Column4', 'Apogee'),
	'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));
// Home Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Home Sidebar',
		'id'            => 'Home Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for Homepage', 'Apogee'),
	'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));


// Pages Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Pages Sidebar',
		'id'            => 'Pages Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for Pages', 'Apogee'),
	'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));
// Portffolio Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Portfolio Sidebar',
		'id'            => 'Portfolio Sidebar',
		'description' => esc_html__('A widget area, used as sidebar for Portfolio Section', 'Apogee'),
	'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));

// Blog Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Blog Sidebar',
		'id'            => 'Blog Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for Blog Section', 'Apogee'),
	'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));

// Contact Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Contact Sidebar',
		'id'            => 'Contact Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for Contact Page', 'Apogee'),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget_inner">',
		'after_widget' => '</div> </div> <div class="v-sapce"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
));


// Top Toggle Section 1st Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Top Togglebox Column 1',
		'id'            => 'top_togglebox_column_1',
		'description' => esc_html__('A widget area, used as the 1st column in the Top Toggle Section.', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container-top %2$s">',
		'after_widget' => '</div> ',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
// Top Toggle Section 2nd Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Top Togglebox Column 2',
		'id'            => 'top_togglebox_column_2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Top Toggle Section.', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container-top %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));
		
// Top Toggle Section 3rd Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Top Togglebox Column 3',
		'id'            => 'top_togglebox_column_3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Top Toggle Section.', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container-top %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));
		
// Top Toggle Section 4th Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Top Togglebox Column 4',
		'id'            => 'top_togglebox_column_4',
		'description' => esc_html__('A widget area, used as the Fourth column in the Top Toggle Section.', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container-top %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));

// Top Toggle Section 5th Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Top Togglebox Column 5',
		'id'            => 'top_togglebox_column_5',
		'description' => esc_html__('A widget area, used as the Fifth column in the Top Toggle Section.', 'Apogee'),
		'before_widget' => '<div id="%1$s" class="widget-container-top %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));

// Bottom Footer Rightside Widget Area	
if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Bottom Footer Right Section',
		'id'            => 'bottom_footer_right_section',
		'description' => esc_html__('A widget area, used as bottom Footer Rightside Section.', 'Apogee'),
		'before_widget' => '<div id="bottom_footer_right">',
		'after_widget' => '</div>',
		));
	
?>