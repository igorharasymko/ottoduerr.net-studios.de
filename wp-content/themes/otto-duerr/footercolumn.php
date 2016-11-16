<?php
$footercolumn=get_option('footercolumn');
echo '<div id="panel_widget">';
echo  '<div  id="panel_wrapper">';
echo  '<div  class="panel">';
if($footercolumn == '5') { $footerclass="one_fifth"; }  
if($footercolumn == '4') {$footerclass="one_fourth";}
if($footercolumn == '3') { $footerclass="one_third"; }
if($footercolumn == '2') {$footerclass="one_half"; }
if($footercolumn == '1') { $footerclass="fullwidth"; }
 for($fc=1; $fc<=$footercolumn; $fc++)
 {
 $last = ($fc == $footercolumn and $footercolumn != 1) ? 'last' : '';
 ?>
 
<div class="<?php echo $footerclass; ?> <?php echo $last; ?>">
    <?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('top_togglebox_column_'.$fc.'') ) : ?>
    <h3>
        <?php _e( ' Toggle Box Column '.$fc.'', 'Apogee' ); ?>
    </h3>
    <p>
        <?php _e( 'Wesce sit amet porttitor leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque interdum, nulla sit amet varius dignissim Vestibulum pretium risus. <a href="#"> View More &raquo;</a>', 'Apogee' ); ?>
    </p>
    <?php endif; ?>
</div>
<?php
 }
echo '</div>';
echo '</div>';
?>