<?php
/**
 * The template for displaying Tag Archive pages.
 */

get_header(); 
// Theme Layout Leftsidebar OR Rightsidebaror OR Full
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
// Image width Depend Theme layoout
$img_width=kaya_image_width(get_the_id());
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
?>
	</div>
	</div>
<!--Start Middle Section  -->
<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
      <div id="inner_title">
        <h2>
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'Apogee' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'Apogee' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'Apogee' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'Apogee' ); ?>
						<?php endif; ?>
					</h2>  
            <div id="inner_right">
                <div class="search_box">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <!-- End Page Titles -->
 <div <?php echo page_layout($post->ID); ?>>
	<?php
		/* Run the loop to output the blog page.
	 	* called loop-blog.php and that will be used instead.
	 	*/
		get_template_part( 'loop', 'blog');
    ?>
</div>

<?php if($sidebar_layout !="full") { ?>
<div class="<?php echo $aside_class;?>" >
    <?php get_sidebar('blog');?>
</div>
<div class="clear"></div>
<?php } ?>
    </div>
    <!--End content Section -->
</div>
<!--End Middle ( #content_wrapper ) Section -->
<?php get_footer(); ?>
