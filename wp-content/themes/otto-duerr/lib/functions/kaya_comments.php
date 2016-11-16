<?php

if ( ! function_exists( 'kaya_comment' ) ) :
function kaya_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 46 ); ?>
			<?php printf( __( '%s <span class="says"></span>', 'Apogee' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'Apogee' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'Apogee' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'Apogee' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->


	<?php

			break;

		case 'pingback'  :

		case 'trackback' :

	?>
	<li class="post pingback">

		<p><?php _e( 'Pingback:', 'Apogee' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'Apogee'), ' ' ); ?></p>

	<?php 

			break;

	endswitch;

}

endif;



if ( ! function_exists( 'kaya_posted_on' ) ) :


function kaya_posted_on() { ?>
	<div class="postmeta">
	<div class="postmetadata">
	<span class="postmetadate"><?php echo get_the_date();?></span>
	<span class="postemetain"><?php _e('Posted In','Apogee'); ?>: <?php the_category(', ') ?> </span>
	<span class="postmetawriter"><?php  _e( 'By ' ,'Apogee'); the_author_posts_link(); ?>  </span>
	<span class="comments"> <?php comments_popup_link( __( 'Leave a comment', 'Apogee' ), __( '1 Comment', 'Apogee' ), __( '% Comments', 'Apogee' ) ); ?> </span>
	<span class="editlink"><?php edit_post_link( __( 'Edit', 'Apogee' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' );?></span>
	</div>
	</div>
<?php
}
endif;
if ( ! function_exists( 'kaya_comment' ) ) :

function kaya_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case '' :

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<div id="comment-<?php comment_ID(); ?>">

		<div class="comment-author vcard">

			<?php echo get_avatar( $comment, 46 ); ?>

			<?php printf( __( '%s <span class="says">says:</span>', 'Apogee' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>

		</div><!-- .comment-author .vcard -->

		<?php if ( $comment->comment_approved == '0' ) : ?>

			<em><?php _e( 'Your comment is awaiting moderation.', 'Apogee' ); ?></em>

			<br />

		<?php endif; ?>



		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">

			<?php

				/* translators: 1: date, 2: time */

				printf( __( '%1$s at %2$s', 'Apogee' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'Apogee' ), ' ' );

			?>

		</div><!-- .comment-meta .commentmetadata -->



		<div class="comment-body"><?php comment_text(); ?></div>



		<div class="reply">

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		</div><!-- .reply -->

	</div><!-- #comment-##  -->



	<?php

			break;

		case 'pingback'  :

		case 'trackback' :

	?>

	<li class="post pingback">

		<p><?php _e( 'Pingback:', 'Apogee' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'Apogee'), ' ' ); ?></p>

	<?php 

			break;

	endswitch;

}

endif;

if ( ! function_exists( 'kaya_posted_in' ) ) :

function kaya_posted_in() {

	// Retrieves tag list of current post, separated by commas.

	$tag_list = get_the_tag_list( '', ', ' );

	if ( $tag_list ) {

		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Apogee' );

	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Apogee' );

	} else {

		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Apogee' );

	}

	// Prints the string, replacing the placeholders.

	printf(

		$posted_in,

		get_the_category_list( ', ' ),

		$tag_list,

		get_permalink(),

		the_title_attribute( 'echo=0' )

	);

}
endif;?>