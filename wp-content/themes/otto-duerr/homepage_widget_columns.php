<div id="bottom_widget_columns">
<?php
//echo is_active_sidebar('home_column1');

$active_column1=is_active_sidebar('home_column1');
$active_column2=is_active_sidebar('home_column2');
$active_column3=is_active_sidebar('home_column3');
$active_column4=is_active_sidebar('home_column4');

// active  column1
if( $active_column1 && $active_column2 && $active_column3 && $active_column4)
   {
$output='<div class="one_fourth">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_fourth">';
ob_start();
dynamic_sidebar('home_column2');
$output.= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_fourth">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_fourth_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>'; 
echo $output;
}

if( $active_column1 && $active_column2 && $active_column3 && !$active_column4)
   {  
$output='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column2');
$output.= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_third_last">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>';  
echo $output;
}

if( $active_column1 && !$active_column2 && !$active_column3 && $active_column4)
{
$output='<div class="one_half">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_half_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>'; 
echo $output;
}

if( $active_column1 && $active_column2 && !$active_column3 && !$active_column4)
{
$output='<div class="one_half">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_half_last">';
ob_start();
dynamic_sidebar('home_column2');
$output.= ob_get_clean();
$output.='</div>'; 
echo $output;
}
if( $active_column1 && !$active_column2 && $active_column3 && $active_column4)
{
$output='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_third_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>';  
echo $output;
}

if( $active_column1 && !$active_column2 && !$active_column3 && !$active_column4)
{
$output='<div class="fullwidth">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
echo $output; 
}
// Coumn1 Inactive: Rest all active 
if( !$active_column1 && $active_column2 && $active_column3 && $active_column4)
{
$output='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column2');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>';
$output.='<div class="one_third_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>'; 
 
echo $output;

}
// Coumn3 Inactive: Rest all active 
if( $active_column1 && $active_column2 && !$active_column3 && $active_column4)
{
$output='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_third">';
ob_start();
dynamic_sidebar('home_column2');
$output.= ob_get_clean();
$output.='</div>';
$output.='<div class="one_third_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>'; 
 
echo $output;

}
if( !$active_column1 && $active_column2 && !$active_column3 && $active_column4)
{
$output='<div class="one_half">';
ob_start();
dynamic_sidebar('home_column2');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_half_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>';
echo $output;
}
if( !$active_column1 && $active_column2 && $active_column3 && !$active_column4)
{
$output='<div class="one_half">';
ob_start();
dynamic_sidebar('home_column2');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_half_last">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>';
echo $output;
}

if( !$active_column1 && $active_column2 && !$active_column3 && !$active_column4)
{
$output='<div class="fullwidth">';
ob_start();
dynamic_sidebar('home_column2');
$output .= ob_get_clean();
$output.='</div>'; 
echo $output;
}

// Coumn3 Inactive: Rest all active 
if( !$active_column1 && !$active_column2 && $active_column3 && $active_column4)
{
$output='<div class="one_half">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_half_last">';
ob_start();
dynamic_sidebar('home_column4');
$output.= ob_get_clean();
$output.='</div>';
 echo $output;
}
if( $active_column1 && !$active_column2 && $active_column3 && !$active_column4)
{
$output='<div class="one_half">';
ob_start();
dynamic_sidebar('home_column1');
$output .= ob_get_clean();
$output.='</div>'; 
$output.='<div class="one_half_last">';
ob_start();
dynamic_sidebar('home_column3');
$output.= ob_get_clean();
$output.='</div>';
 echo $output;
}

if( !$active_column1 && !$active_column2 && $active_column3 && !$active_column4)
{
$output='<div class="fullwidth">';
ob_start();
dynamic_sidebar('home_column3');
$output .= ob_get_clean();
$output.='</div>'; 
 echo $output;
}
// Coumn4 Inactive: Rest all active 
if( !$active_column1 && !$active_column2 && !$active_column3 && $active_column4)
{
$output='<div class="fullwidth">';
ob_start();
dynamic_sidebar('home_column4');
$output .= ob_get_clean();
$output.='</div>'; 
 echo $output;
}
?>
</div>