<?php
class taxpost extends WP_Widget {

function taxpost() {
global $themename;
$widget_ops = array( 'classname' => 'widget_taxpost', 'description' => __('Use this widget to display portfolio items', 'Apogee'));
	parent::WP_Widget(false, $name=$themename.'-Portfolio Items',$widget_ops);	
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	// Get array of post info.
	  query_posts(array('showposts' => $instance["num"] ,'post_type' => 'kayaportfolio', 'taxonomy' => 'portfolio_category', 'term' => $instance["portfolio_slug"] ));
	// Excerpt length filter
	echo $before_widget;
	
	// Widget title
	echo $before_title;
	echo $instance["title"];
	echo $after_title;

	// Post list
	echo "<ul>\n";
	
	while ( have_posts() )	{
		the_post();
	?>

<li>    
     <a href="<?php the_permalink() ?>" <?php if(get_option('colorbox')!="true" ) { ?>  <?php }  ?>>
    <?php the_post_thumbnail(array(46,46),array('class' =>'thumb' )); ?>
    </a>
    
    </a> <a class="view-more" href="<?php the_permalink() ?>"> <strong><?php echo the_title(); ?></strong> </a> <br />
    <?php /*?>
    <span class="recentpost-date">
    <?php the_time("F d,  Y"); ?>
    </span> <br /><?php */?>
                    <span class="taxnomy-recentpost-body-text">
                     <?php if($post->post_excerpt) {				 
								echo get_the_excerpt(); }
								else { 
								echo content('7');
							}
								 ?> 
   					</span> </li>
<?php
	}
	
	echo "</ul>\n";
	
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
$num = strip_tags($instance['num']);
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
    <select id="<?php echo $this->get_field_id("portfolio_slug"); ?>" name="<?php echo $this->get_field_name("portfolio_slug"); ?>">
        <option value="">All</option>
        <?php foreach ($cats_array as $categs) { ?>
        <option   value="<?php echo $categs->slug; ?>"  <?php  echo $instance["portfolio_slug"] == $categs->slug ? ' selected="selected"' : '' ;?>><?php echo $categs->name; ?> </option>
        <?php } ?>
    </select>
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id("num"); ?>">
    <?php _e('Number of posts to show','Apogee'); ?>
    :
    <input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo $num; ?>" size='3' />
    </label>
</p>
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("taxpost");') );
?>
