<?php
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
<?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
<div <?php echo page_layout(get_the_id()); ?>>
	<?php 
	/* Run the loop to output the page.
	 * called loop-page.php and that will be used instead.
	 */
     get_template_part('loop','page'); 
     ?>
</div>
        <!--StartSidebar Section -->
        <?php if($sidebar_layout !="full") { ?>
        <div class="<?php echo $aside_class;?>">
            <?php get_sidebar('pages');?>
        </div>
        <div class="clear"></div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <!--End content Section -->
</div>
<!--End Middle ( #content_wrapper ) Section -->
<?php get_footer(); ?>