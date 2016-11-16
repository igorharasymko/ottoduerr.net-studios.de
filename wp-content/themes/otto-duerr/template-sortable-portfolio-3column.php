<?php
/**
 * Template Name: Sortable Portfolio 3Column
 *
 */
	get_header();
	wp_enqueue_script("jquery_easing");
	wp_enqueue_script('jquery_fancybox_pack');
	wp_enqueue_script('filter_portfolio');
	wp_enqueue_style('css_fancybox');
	wp_enqueue_style('css_filter_portfolio');
	?>

<script>  
	 jQuery(document).ready(function() {
	jQuery("a.example2").fancybox({
				'titleShow'     : true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'easingIn'      : 'easeOutBack',
				'easingOut'     : 'easeInBack'
			});
		});

</script>
<?php 
global $timthumb,$kaya_readmore;
$sidebar_layout=get_post_meta($post->ID,'kaya_pagesidebar',true); 
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
?>
</div>
</div>

<!--Start Middle Section  -->
<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
<?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
<?php if($sidebar_layout =="full") {
			 echo '<div id="content-extra-width">';
			 } else
			 echo '<div>';
			  ?>

<div <?php echo page_layout($post->ID); ?>>
 <div class="entry-content">
  	<ul id="filter">
		<li class="current"><a href="#" data-value='all'> <?php _e( 'All', 'Apogee' ); ?></a></li>
		<?php
	wp_list_categories(array('title_li' => '', 'taxonomy' => 'portfolio_category', 'walker' => new Portfolio_Walker()));
		?>
	</ul>

     <ul id="portfolio_3">
		<?php
		$column=4;
		//$class="one_fourth";
		$width="296";
		$height="206";
		$terms =@implode(',', get_option('portfoliosortable'));
			 $count=1;
			  $args=array(
						'post_type' => 'portfolio',
						'taxonomy' => 'portfolio_category',
						'posts_per_page' =>'-1'
					);
			$thumb_count=1;
			$i=0;
			wp_reset_query();
		$wp_query = new WP_Query();
		$wp_query->query($args);		
                        while ($wp_query->have_posts()) : $wp_query->the_post(); 
						 $terms = get_the_terms(get_the_ID(), 'portfolio_category');
						 $i++;
						 //$last = ($i == $column and $column != 1) ? 'last' : '';
						 
				$terms_slug = array();
						if (is_array($terms)) {
							foreach($terms as $term) {
								 $terms_slug[] = $term->slug;
							}
						}
						?>
		<li class="<?php echo implode(' ', $terms_slug); ?>">
		<div class="portfolio_3_item"> 
         <?php 
		 $imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
		  ?>
			<?php
			$video = get_post_meta( get_the_ID(), 'video', true );			
			if($video)
			{
			$lightbox_url=$video;
			$lightbox_class="videobox";
			if ( !empty( $video ) ) {	 	
			echo kaya_imageresize($post->ID,$width,$height,'','false');
				//echo'<div class="post_nav_box">';
				//echo'<a href="'.$video.'" class="lightbox_video" rel="prettyPhoto[mixed]" title="Video Preview">&nbsp;</a><a href="'.get_permalink().'" class="post_link"  title="Link To Post">&nbsp;</a>';
				//echo'</div>';
			}
			}else{
			$thumb_id = get_post_thumbnail_id();
			$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
			$lightbox_url=$imgurl;
			$lightbox_class="image";
			if ( !empty( $thumb_id ) ) {
				echo kaya_imageresize($post->ID,$width,$height,'','false');
				//echo'<div class="post_nav_box">';
				//echo'<a href="'.$imgurl.'" class="lightbox_image" rel="prettyPhoto[mixed]" title="Image Preview"></a> <a href="'.get_permalink().'" class="post_link"  title="Link To Post">&nbsp;</a>';
				//echo'</div>';
			}
				
			}			
			?>
         <h4>
         	<?php the_title(); ?> 
         </h4> <?php
    			 echo '<div class="post_nav_box">';
                     echo '<a href="'.get_permalink().'" class="link_post">&nbsp;</a>';                          
                      echo'<a href="'.$lightbox_url.'" class="'.$lightbox_class.' example2 lightbox iframe">&nbsp;</a>';
                 	echo'</div>';
	
		?>
        </div>
		</li>
		<?php 
		
		if($i == $column){
		$i = 0;
		}
		endwhile; ?>
	 </ul>
 </div>
</div>
            <?php if($sidebar_layout !="full") { ?>
            <div class="<?php echo $aside_class;?>" >
                <?php get_sidebar();?>
            </div>
        </div>
        <div class="clear"></div>
        <?php } ?>
    </div>
</div>
</div>
<?php get_footer(); ?>