<?php
/**
 * The template for displaying Author Archive pages.
 *
 */

get_header();
 // global variables
 global $timthumb,$kaya_readmore;
$sidebar_layout=get_post_meta($post->ID,'kaya_pagesidebar',true); 
$img_width=kaya_image_width($post->ID);
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
                <?php the_post(); 
	   
	   printf( __( 'Author Archives: %s', 'Apogee' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>
            </h2>
            <div id="inner_right">
                <div class="search_box">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <!-- End Page Titles -->
        
       <!-- Author Info -->
        <?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
        <div id="entry-author-info">
            <div id="author-avatar"> <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'kaya_author_bio_avatar_size', 60 ) ); ?> </div>
            <!-- #author-avatar -->
            <div id="author-description">
                <h4><?php printf( __( 'About %s', 'Apogee' ), get_the_author() ); ?></h4>
                <?php the_author_meta( 'description' ); ?>
            </div>
            <!-- #author-description	-->
        </div>
        <!-- #entry-author-info -->
        <?php endif; ?>
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
</div>
<?php get_footer(); ?>