<?php require_once( '../../../../wp-load.php' );

Header("Content-type: text/css");
$google_h1font_size=get_option('google_h1font_size') ?  get_option('google_h1font_size') : '24';
$google_h2font_size=get_option('google_h2font_size') ? get_option('google_h2font_size') :'20';
$google_h3font_size=get_option('google_h3font_size') ? get_option('google_h3font_size') :'18';
$google_h4font_size=get_option('google_h4font_size') ? get_option('google_h4font_size') :'16';
$google_h5font_size=get_option('google_h5font_size') ? get_option('google_h5font_size') :'12';
$google_h6font_size=get_option('google_h6font_size') ? get_option('google_h6font_size') :'10';
$google_bodyfont=get_option('google_bodyfont') ? get_option('google_bodyfont') :'';
$google_generaltitlefont=get_option('google_generaltitlefont') ? get_option('google_generaltitlefont') :'Ubuntu Condensed';
$google_bodyfont_size=get_option('google_bodyfont_size') ? get_option('google_bodyfont_size') :'12';

$logo_margin_top=get_option('logo_margin_top');

$slider_bg_image=get_option('slider_background'); 
?>
<?php if( get_option('kaya_typhography')== "true") { ?>
body{
<?php echo 'font-family:'?><?php echo $google_bodyfont; ?>!important; 
<?php echo 'font-size:'?><?php echo $google_bodyfont_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_bodyfont_size+6; ?>px!important;
}


h1, h2, h3, h4, h5, h6
{<?php echo 'font-family:'?><?php echo $google_generaltitlefont; ?>!important; 
}

#content h1{
<?php echo 'font-size:'?><?php echo $google_h1font_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_h1font_size+6; ?>px!important; 
}

#content h2{
<?php echo 'font-size:'?><?php echo $google_h2font_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_h2font_size+6; ?>px!important; }

#content h3{
<?php echo 'font-size:'?><?php echo $google_h3font_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_h3font_size+6; ?>px!important; }

#content h4{
<?php echo 'font-size:'?><?php echo $google_h4font_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_h4font_size+6; ?>px!important; }

#contentn h5{
<?php echo 'font-size:'?><?php echo $google_h5font_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_h5font_size+6; ?>px!important; 
}

#content h6{
<?php echo 'font-size:'?><?php echo $google_h6font_size; ?>px!important;
<?php echo 'line-height:'?><?php echo $google_h6font_size+6; ?>px!important; 
}
<?php }else{ // Defalut googlefont if there is no font is selected from  Theme Options
?>
    h1, h2, h3, h4, h5, h6 {
    color:#252724;
    margin-bottom:10px;
    font-family: 'Ubuntu Condensed', sans-serif !important;
    }

<?php // Hyepr links Colors
} ?>
a, a:link, a:visited, ul#filter li.current a:link, ul#filter li.current a:visited{

}

.two_third a, .two_third a:visited,
.two_third_last a, .two_third_last a:visited,
.fullwidth a, .fullwidth a:visited
{
<?php
$HyperLinkColor=get_option('HyperLinkColor');
echo 'color:'?><?php echo $HyperLinkColor;
?>!important;
}

.two_third a:hover,
.two_third_last a:hover,
.fullwidth a:hover
{
<?php
$HyperLinkColorHover=get_option('HyperLinkColorHover');
echo 'color:'?><?php echo $HyperLinkColorHover;
?>!important;
}

#logo{
<?php echo 'padding-top:'?><?php echo get_option('logo_margin_top'); ?>px!important;
}

#header_wrapper, 
#inner_header_wrapper, 
#inner_title, 
.post_nav_box .lightbox,
.post_nav_box a.link_post,
.post_nav_box a.videobox,
.teasertext a
{
}

.divider{
  
}

.divider2{
}