<?php
class cat_post_slider_news extends WP_Widget {
function cat_post_slider_news() {
global $themename;

		$widget_ops = array( 'classname' => 'widget_cat_post_slider_news', 'description' => __('Display the latest posts items from chosen category as news slider', 'Apogee'));
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget_cat_post_slider_news' );
		
		$this->WP_Widget('widget_cat_post_slider_news',$themename.'-Latest News Slider', $widget_ops, $control_ops );
}
/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	wp_print_scripts('jquery_sudoSlider');
		
	
	
	extract( $args );	
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
	}
	
	// Get array of post info.
	if($instance["cat"] != "-1"){ 
	$cat_posts = new WP_Query("showposts=-1&cat=" . $instance["cat"]);
	}else{
	$cat_posts = new WP_Query("showposts=-1");
	}
		echo '<script type="text/javascript">
		var $j = jQuery.noConflict();
		/* <![CDATA[ */
		$j(document).ready(function() { 
			var sudoSlider = $j("#kaya_news").sudoSlider({
			  vertical:true,
			   continuous:true,
			   auto:false,
			   hoverPause:true,
			   speed:2000																																																													 																																																																});		
			});
	
		/* ]]> */
		</script>';
	
	
	echo $before_widget;
	
	// Widget title
	echo $before_title;
	echo $instance["title"];
	echo $after_title;
?>

<div id="kaya_news">
    <ul>  
        <?php 
		$count=1;
		
		while ($cat_posts->have_posts() )
	{
		$cat_posts->the_post();
	
    if($count == 1)
    {
     echo '<li>';
    }
	?>
      <div class="latest_news_content">
           
           <div class="date-bg calender">
                <h5><?php echo get_the_date('M' );?></h5>
                <h4><?php echo get_the_date('d' );?></h4>
            </div>
            	<div class="description">
                    <strong><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></strong><br />
                    <?php if($post->post_excerpt) {				 
								echo get_the_excerpt(); }
								else { 
								echo content('20');
							}?> 
        			</div>
        </div>
        <?php 
		$count++;
		if($count == 4)
		{
		$count=1;
		echo '</li>';
		}
		  }
		   ?>
     </ul>
    
</div>
<?php 
	echo $after_widget;
	$post = $post_old; // Restore the post object.
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {

	return $new_instance;
}

/**
 *  form.
 */
function form($instance) {
$instance = wp_parse_args((array)$instance, 
	array( 
	
		'cat' => '',
		'title' => 'Latest News'	
		
	));											
		$title = strip_tags($instance['title']);
		?>
<p>
    <label for="<?php echo $this->get_field_id("title"); ?>">
    <?php _e( 'Title','Apogee' ); ?>
    :
    <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </label>
</p>
<p>
    <label>
    <?php _e( 'Choose News Category','Apogee'); ?>
    :
    <?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ,'show_option_none' =>'All') ); ?>
    </label>
</p>
<?php
wp_reset_query();
}

}

add_action( 'widgets_init', create_function('', 'return register_widget("cat_post_slider_news");') );
?>