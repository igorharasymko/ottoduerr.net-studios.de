<div id="footer_wrapper">   
    <div id="footer">
        <div class="one_half"> 
			<?php echo get_option('kaya_footercopyright'); ?>
      <?php echo " - " . date('Y'); ?> 
		</div>
        
          <div class="one_half_last">   
         <?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('bottom_footer_right_section') ) : ?>              
           	<div id="bottom_footer_right"><p>Bottom Footer right side Widget Area</p></div>
          <?php endif; // end Default sidebar area ?>
        </div>        
       
    </div>
</div>
<?php  $kaya_google_analytics=get_option('kaya_google_analytics');
        if ($kaya_google_analytics) { 	
        echo stripslashes($kaya_google_analytics); 					
        } else { ?>
<?php } ?>
<?php wp_footer(); ?>
</div>
</body>
</html>