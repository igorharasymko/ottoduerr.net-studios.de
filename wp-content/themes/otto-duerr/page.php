<?php
get_header(); ?>
<?php 
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
<?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
        <style>
            #outerdiv
            {
                min-height:496px;
                overflow:hidden;
                position:relative;
            }
            #innerIframe
            {
                position:absolute;
                top:-333px;
                left:0;
                width:975px;
                min-height: 3940px;
            }
        </style>
        <div id="outerdiv">
            <iframe src="http://www2.hornschuch.com/de/interior/kunstleder/" id="innerIframe" onload="resizeIframe()"></iframe>
        </div>
        <div <?php echo page_layout($post->ID); ?>>
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Apogee' ), 'after' => '</div>' ) ); ?>
                    <?php edit_post_link( __( 'Edit', 'Apogee' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
                <!-- .entry-content -->
            </div>
            <!-- #post-## -->
            <?php endwhile; ?>
        </div>
        <!--StartSidebar Section -->
        <?php if($sidebar_layout !="full") { ?>
        <div class="<?php echo $aside_class;?>">
           		 <?php get_sidebar(); ?>
			
        </div>
        <div class="clear"></div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <!--End content Section -->
</div>
<!--End Middle ( #content_wrapper ) Section -->
<?php get_footer(); ?>