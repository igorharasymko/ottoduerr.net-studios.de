<?php
/**
 * Template Name: Blog Page
 *
 */
get_header(); 
 // global variables
 global $timthumb,$kaya_readmore;
// Theme page Layout
$sidebar_layout=get_post_meta($post->ID,'kaya_pagesidebar',true); 
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
/**
*int $postid
*int $width image width
* 
*/

$img_width=kaya_image_width($post->ID);
?>
</div>
</div>

<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
<?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
<div <?php echo page_layout($post->ID); ?>>
	<?php
		$blogpages =@implode(",", get_option('blog_pages'));
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts("cat=$blogpages.&paged=$paged"); 
		/* Run the loop to output the blog page.
	 	* called loop-blog.php and that will be used instead.
	 	*/
		get_template_part( 'loop','blog');
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
