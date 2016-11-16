<?php
global $sidebar_layout;
$right_left_sidebar=($sidebar_layout== "rightsidebar" ) ?  'sidebar' : 'sidebar_left'; 

?>
<div id="sidebar" class="<?php echo $right_left_sidebar; ?>">
	
    <?php
	wp_reset_query();
		 global $page_widget;    
	if($page_widget!="select"){ 
	if ( !dynamic_sidebar($page_widget) ) : 
		?>
    <div class="widget-container">
     <div class="widget_inner">
        <h3><?php _e( 'Sideabr Widget Area', 'Apogee' ); ?></h3>
        <?php _e("<p>Seleted widget area for this page is empty </p>
				<p><strong>To edit this sidebar:</strong><br>
			<p> Go to admin <strong><em>Appearance -> Widgets</em></strong> and place <em>widgets</em> into <strong>Appropriate</strong> Widget Areas.</p> 
				", 'Apogee'); ?>
  
    </div>
    </div>
    
    <?php 
		endif; 
		
			}else {	
		if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('Home Sidebar') ) : ?>   
          <div class="widget-container">
           <div class="widget_inner">
        <h3><?php _e( 'Sideabr Widget Area', 'Apogee' ); ?></h3>      
        <?php _e("<p>No <strong>Sidebar Widget Area</strong> is selected for this page</p>
				<p><strong>To edit this sidebar:</strong><br>		
			<p> Find <strong>Page Layout Options Panel</strong> which is located top right of the page while you are creating a<strong> page or post</strong> item in wp admin and follow the instructions.</p> 
			<p> <img src='".get_template_directory_uri()."/lib/admin/images/page_layout_options.png' alt='Page Layout Options' /></p>			
			", 'Apogee'); ?>
    </div>	
    </div>
          <?php endif;  ?>
	<?php			
					
		}?>
</div>