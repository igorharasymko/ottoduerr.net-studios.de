<?php
get_header(); ?>
<?php
global $img_width,$single_image;
wp_print_scripts('jquery_sudoSlider');
?>
<script type="text/javascript" >
	jQuery(document).ready(function(){	
			var sudoSlider = jQuery("#kaya_portfolio_slider").sudoSlider({
				numeric:true,
				prevNext:false,
				continuous:true
			});
		});	
		
</script>
</div>
</div>
<?php
// Theme page Layout
$sidebar_layout=get_post_meta($post->ID,'kaya_pagesidebar',true); 
// define image width 
$img_width=kaya_image_width($post->ID);
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
?>

<!--Start Middle Section  -->
<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
    <?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
    <div <?php echo page_layout($post->ID); ?>>
    
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     
            <!-- .entry-meta -->
   
                 
                  
                <?php the_content(); ?> 
                               
                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Apogee' ), 'after' => '</div>' ) ); ?>
              
            </div>
            <!-- .entry-content -->
     
   
                    <?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
            <div id="entry-author-info">
                <div id="author-avatar"> <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'kaya_author_bio_avatar_size', 60 ) ); ?> </div>
                <!-- #author-avatar -->
                <div id="author-description">
                    <h4><?php printf( esc_attr__( 'About %s', 'Apogee' ), get_the_author() ); ?></h4>
                    <?php the_author_meta( 'description' ); ?>
                    <div id="author-link"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'Apogee' ), get_the_author() ); ?> </a> </div>
                    <!-- #author-link	-->
                </div>
                <!-- #author-description -->
            </div>
            <!-- #entry-author-info -->
            <?php endif; ?>
        
            
            </div>
	
        <?php endwhile; // end of the loop. ?>
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