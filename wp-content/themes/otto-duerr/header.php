<!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie6.css" />
<![endif]-->
<?php 

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function(){
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
	
  });
</script>
<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function(){
	
	/* IE 6 Fixes */
	jQuery(".one_half_last").attr('style', 'float: left;');
	jQuery('h3').attr('style', 'font-size: 20px;');

  });
</script>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=true">
</script><script type="text/javascript">
  function initialize() {
	var duerr = new google.maps.LatLng(48.729636,9.116145);
	var location = new google.maps.LatLng(duerr.lat(),
        duerr.lng());
	
    var myOptions = {
      zoom: 11,
      center: duerr,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
		var marker = new google.maps.Marker({
      position: duerr,
      map: map,
      title:"Hello World!"
  });
	var infowindow = new google.maps.InfoWindow(
      { content: "Otto Dürr KG, Möhringer Landstr. 32, 70563 Stuttgart",
        size: new google.maps.Size(20,30)
      });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
  
  }
	
</script>
<?php 
$google_bodyfont=get_option('google_bodyfont')? get_option('google_bodyfont'):'Ubuntu Condensed';
$google_generaltitlefont=get_option('google_generaltitlefont')? get_option('google_generaltitlefont'):'Ubuntu Condensed';
$gbodyfont = str_replace( ' ', '+', $google_bodyfont); 
$generaltitlefont = str_replace( ' ', '+', $google_generaltitlefont); 
?>
<?php if( get_option('kaya_typhography')=="false") { ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'/>
<?php }else{ ?>
<?php if($google_bodyfont !="") { ?>
<link  rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=<?php echo $gbodyfont; ?>'>
<?php } ?>
<?php if($generaltitlefont !="") { ?>
<link  rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=<?php echo $generaltitlefont; ?>'>
<?php } ?>
<?php } ?>
</head>
<body onload="initialize();" <?php body_class(); ?>>

<!-- Start demobar -->
<?php //get_template_part('demo/demo'); ?>
<!-- Start Demobar -->
<?php if(get_option('topToggleBoxDisable')!="true") { ?>
	<?php  get_template_part('lib/includes/top_toggle_section'); ?>
<?php } ?>

<div class="<?php echo get_option('layoutoption')? get_option('layoutoption'): 'fluid' ;?>">
<?php
        // Get $post if you're inside a function
        global $post;        
        if ( is_home() and  get_option('sliderdisable') != 'true'){        
           echo "<div id='header_wrapper'>"; 
		   echo "<div id='header'>";      
        } else {
          echo "<div id='inner_header_wrapper'>";
		  echo "<div id='inner_header'>";      
        }
        ?>
<!--Start header_wrapper -->
<div id="logo">
    <?php  $logo=get_option('logo'); ?>
    <?php if($logo) { ?>
    <a href="<?php echo home_url(); ?> "> <img src="<?php echo $logo; ?>" alt="<?php the_title(); ?>"  /> </a>
    <?php }else{ ?>
    <a href="<?php echo home_url(); ?> "> <img src="<?php echo get_template_directory_uri()?>/images/logo.png" alt="<?php the_title(); ?>" /> </a>
    <?php } ?>
</div>

	<?php 
   		wp_nav_menu( array( 'container_class' =>'jqueryslidemenu','container_id' => 'myslidemenu','menu_class' =>'jqueryslidemenu','menu_id'=> '' ) );
    ?>
<div class="clear"></div>
