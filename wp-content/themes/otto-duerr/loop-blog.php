<?php  
// global variables
 global $timthumb,$kaya_readmore,$img_width;
 ?>
<?php while ( have_posts() ) : the_post();
 ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
           			
                <div class="date_blog">
                        <span class="blog_month"><?php echo get_the_date('M' );?></span>
                        <span class="blog_date"><?php echo get_the_date('d' );?></span>
                     
                    </div>
             <div class="post_meta_info_wrapper">
               <div class="blog_description">
                <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Apogee' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
            </a></h3>
                         <span class="post_meta_info">
                         	<span class="post_by"><?php  _e( 'By', 'Apogee' ); ?> <?php the_author_posts_link(); ?> <?php echo get_the_date();?></span>
                            <span class="post_comment"><?php comments_popup_link(__('Leave a comment', 'Apogee' ), __( '1 Comment', 'Apogee' ), __( '% Comments', 'Apogee' ) ); ?> </span>
                           <span class="post_tags"> <?php the_category(', ') ?> </span>
                         </span>
                    </div>
                    </div>
                    <br />
				<?php

				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.

				/**
				*int $postid
				*int $width image width
				*int $height image height
				*str $class image class
				*boolean  true/false(for images links) 
				*/
				
				echo kaya_imageresize($post->ID,$img_width,'250','img_radius','true');
				}?>
                
				<div class="clear v-space1"></div>
					<?php the_excerpt(); ?>
             	<div class="readmore">   
                    <a href="<?php the_permalink(); ?>"><?php echo $kaya_readmore; ?> <span> </span></a>
                </div>
 
    </div>
<!-- #post-## -->
<div class="clear v-space2"></div>
<?php  
 $commentsection = get_post_meta( $post->ID, 'commentsection', true );	
if( $commentsection != "on") {
comments_template( '', true );
} ?>
<?php endwhile; // End the loop. Whew. ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php echo kaya_pagination();
?>