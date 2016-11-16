<?php
class taxpostnivoslider extends WP_Widget {

function taxpostnivoslider() {
global $themename;
$widget_ops = array( 'classname' => 'categorypost_widget', 'description' => __('Use this widget to display mini "Portfolio Slider"', 'Apogee'));
	parent::WP_Widget(false, $name=$themename.'-Portfolio Nivoslider',$widget_ops);
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	wp_print_scripts('kaya_nivo');
	wp_print_styles('style_nivo');
	extract( $args );
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
	}
	$portfoliocat=@implode(",",$instance["portfolio_slug"]);
	// Get array of post info.
	  query_posts(array('showposts' => $instance["num"] ,'post_type' => 'kayaportfolio', 'taxonomy' => 'portfolio_category', 'term' => $portfoliocat ));
	// Excerpt length filter
	
	echo '<script type="text/javascript">
/* <![CDATA[ */
jQuery(window).load(function($) {
jQuery("#slider").nivoSlider();
});	
/* ]]> */
</script>';
	echo $before_widget;
	echo $before_title;
	// Widget title

	echo $instance["title"];
echo $after_title;
echo '<div id="slider-wrapper">
        <div id="slider" class="nivoSlider">';	
	while ( have_posts() )	{
		the_post();
	?>

     <a href="<?php the_permalink() ?>" <?php if(get_option('colorbox')!="true" ) { ?> <?php }  ?>>
     
           <?php the_post_thumbnail(array(262,168),array('class' =>'')); ?>
            </a> 

<?php
	}
	
	echo '</div></div>';
	
	echo $after_widget;
	$post = $post_old; // Restore the post object.
	wp_reset_query();
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
$instance = wp_parse_args((array)$instance, array( 'title' => '', 'num' => '3'));
?>
<p>
    <label for="<?php echo $this->get_field_id("title"); ?>">
    <?php _e( 'Title','Apogee'); ?>
    :
    <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
    </label>
</p>
<p>
    <label>
    <?php _e( 'Category','Apogee'); ?>
    :
    <?php
                  	
				$cats_array =get_terms('portfolio_category','orderby=name&hide_empty=0');;

	$dynamic_cats = array();
foreach ($cats_array as $categs) {
	$dynamic_cats[$categs->slug] = $categs->name;
	$cats_ids[] = $categs->slug; } ?>
    <select 	style="height:100px;" multiple="multiple"  id="<?php echo $this->get_field_id("portfolio_slug"); ?>[]" name="<?php echo $this->get_field_name("portfolio_slug"); ?>[]">
        <option value="">Select Category</option>
        <?php foreach ($cats_array as $categs) { 
		 $selected = "";

                       if ($instance["portfolio_slug"]) {

                               if (@in_array($categs->slug,$instance["portfolio_slug"])) $selected =

"selected=\"selected\"";

                       }

               else {

               }
		
		
		?>
        <option   value="<?php echo $categs->slug; ?>"  <?php  echo $selected;?>><?php echo $categs->name; ?> </option>
        <?php } ?>
    </select>
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("num"); ?>">
    <?php _e('Number of Images to display','Apogee'); ?>
    :
    <input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
    </label>
</p>
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("taxpostnivoslider");') );
?>