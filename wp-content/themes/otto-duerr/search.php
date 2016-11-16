<?php
/**
 * The template for displaying Search Results pages.
 *
 */
get_header(); ?>
</div>
</div>
<?php $img_width=kaya_image_width($post->ID); ?>

<!--Start Middle Section  -->
<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
    	<!-- Page Titles -->
        <div id="inner_title">
           <h2><?php printf( __( 'Search Results for: %s', 'Apogee' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
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