<?php
get_header(); ?>
</div>
</div>

<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
        <!-- Page Titles -->
        <div id="inner_title">
            <h2>
                <?php _e( 'Error 404 - Not Found', 'Apogee' ); ?>
            </h2>
            <div id="inner_right">
                <div class="search_box">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <!-- End Page Titles -->
        <div class="one_half">
            <?php _e( ' <h3>Archives by Subject:</h3>', 'Apogee' ); ?>
            <ul>
                <?php wp_list_categories('&title_li='); ?>
            </ul>
        </div>
        <div class="one_half_last">
            <?php _e( ' <h3>Archives by Month::</h3>', 'Apogee' ); ?>
            <ol>
                <?php wp_get_archives('type=monthly'); 
				next_posts_link() 
				?>
            </ol>
        </div>
    </div>
    <!-- .entry-content -->
</div>
<?php get_footer(); ?>
