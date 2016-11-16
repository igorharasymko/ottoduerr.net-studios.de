jQuery(document).ready(function() {
jQuery('.upload_img_button').click(function() {
var ImgUploadID = jQuery(this).attr('id');	
formfield = jQuery('#'+ImgUploadID).attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});
jQuery('.upload_img_button').click(function() {
var ImgUploadID = jQuery(this).attr('id');	
window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#'+ImgUploadID).val(imgurl);
 tb_remove();
}
});
});

jQuery(document).ready(function() { 
	jQuery(".kaya_pagesidebar").change(function () {
	jQuery(".kaya_widgetsidebar").show();
	selectlayout = jQuery("#kaya_pagesidebar option:selected").val(); 
	switch(selectlayout)
	{
		case 'full':
		jQuery(".kaya_widgetsidebar").hide();
		break;
		
	}
	
		
}).change();
});
var $j = jQuery.noConflict();
jQuery(document).ready(function() { 
jQuery(".sortable_order input").change(function(){
			myCheckId = jQuery(this).val(); 
			myCheckRel = jQuery(this).attr('rel'); 
			myCheckTitle = jQuery(this).attr('alt'); 
			
			if (jQuery(this).is(':checked')) { 
				jQuery('#'+myCheckRel).append('<li id="'+myCheckId+'" class="ui-state-default">'+myCheckTitle+'</li>');
			} 
			else
			{
				jQuery('#'+myCheckId+'').remove();
			}

			var order = jQuery('#'+myCheckRel).sortable('toArray');

            jQuery('#'+myCheckRel+'_data').val(order);
		});
		});
$j(document).ready(function() { 
	$j(".chooseslider").change(function () {	
	selectlayout = jQuery(".chooseslider option:selected").val(); 
	$j(".videourl").hide();
	$j(".kaya_single_img").hide();
	$j(".sliderlimits").hide();
	jQuery(".kaya_single_img_linkurl").hide();
	switch(selectlayout)
	{
		case 'contentcarousel':
		$j(".slider_post_limits").show();
		$j(".sliderheight").hide();
		$j(".slidertext_disable").hide();
		$j(".lightbox_enable").hide();
		$j(".slider_text").hide();
		break;
		
		case 'sudoslider':
		$j(".slider_post_limits").show();
		$j(".sliderheight").show();
		$j(".slidertext_disable").show();
		$j(".lightbox_enable").hide();
		$j(".slider_text").hide();
		break;
		
		case 'bxslider':
		$j(".slider_post_limits").show();
		$j(".sliderheight").show();
		$j(".slidertext_disable").show();
		$j(".lightbox_enable").show();
		$j(".slider_text").hide();
		break;
		
		case 'jcarousellite':
		$j(".slider_post_limits").hide();
		$j(".sliderheight").hide();
		$j(".slidertext_disable").hide();
		$j(".lightbox_enable").show();
		$j(".slider_text").hide();
		break;
		
		case 'imageslidertext':
		$j(".slider_post_limits").hide();
		$j(".sliderheight").hide();
		$j(".slidertext_disable").show();
		$j(".lightbox_enable").hide();
		$j(".slider_text").show();
		break;
		
		case 'staticimage':
		$j(".slider_post_limits").hide();
		$j(".kaya_single_img").show();
		$j(".kaya_single_img_linkurl").show();
		$j(".sliderheight").hide();
		$j(".slidertext_disable").hide();
		$j(".lightbox_enable").hide();
		$j(".slider_text").hide();
		break;
		
		case 'staticvideo':
		$j(".slider_post_limits").hide();
		$j(".videourl").show();
		$j(".sliderheight").hide();
		$j(".slidertext_disable").hide();
		$j(".lightbox_enable").hide();
		$j(".slider_text").hide();
		break;

	}
}).change();
});
$j(document).ready(function() { 
	$j("#slider_link").change(function () {	
	sliderlinktype = jQuery("#slider_link option:selected").val(); 
			$j("#slider_pages").hide();
			$j("#slider_portfolio").hide();
			$j("#slider_categories").hide();
			$j("#slider_posts").hide();
			$j("#slider_customlink").hide();
	
	switch(sliderlinktype)
	{
	case 'default':
			$j("#slider_pages").hide();
			$j("#slider_portfolio").hide();
			$j("#slider_categories").hide();
			$j("#slider_posts").hide();
			$j("#slider_customlink").hide();
		break;
		case 'pages':
			$j("#slider_pages").show();
			$j("#slider_portfolio").hide();
			$j("#slider_categories").hide();
			$j("#slider_posts").hide();
			$j("#slider_customlink").hide();
			
		break;
		case 'posts':
			$j("#slider_pages").hide();
			$j("#slider_portfolio").hide();
			$j("#slider_categories").hide();
			$j("#slider_posts").show();
			$j("#slider_customlink").hide();
			
		break;
		case 'categories':
			$j("#slider_pages").hide();
			$j("#slider_portfolio").hide();
			$j("#slider_categories").show();
			$j("#slider_posts").hide();
			$j("#slider_customlink").hide();
			
		break;
		case 'customlink':
			$j("#slider_pages").hide();
			$j("#slider_portfolio").hide();
			$j("#slider_categories").hide();
			$j("#slider_posts").hide();
			$j("#slider_customlink").show();
		
		break;
	}
}).change();
});
