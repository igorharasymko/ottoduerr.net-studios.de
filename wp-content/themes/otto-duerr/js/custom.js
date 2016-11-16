jQuery(document).ready(function() {
							
		jQuery(".tabContents").hide(); // Hide all tab conten divs by default
		jQuery(".tabContents:first").show(); // Show the first div of tab content by default
		
		jQuery("#tabContaier ul li:first a").addClass("active");
		
		jQuery("#tabContaier ul li a").click(function(){ //Fire the click event
			
			var activeTab = jQuery(this).attr("tabid"); // Catch the click link
			jQuery("#tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
			jQuery(this).addClass("active"); // set clicked link to highlight state
			jQuery(".tabContents").hide(); // hide currently visible tab content div
			jQuery(activeTab).fadeIn(); // show the target tab content div by matching clicked link.
		});
		jQuery(".vtabContents").hide(); // Hide all tab conten divs by default
		jQuery(".vtabContents:first").show(); // Show the first div of tab content by default
		jQuery("#vtabContaier ul li:first a").addClass("active");
		
		jQuery("#vtabContaier ul li a").click(function(){ //Fire the click event
			
			var activeTab = jQuery(this).attr("vtabid"); // Catch the click link
			jQuery("#vtabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
			jQuery(this).addClass("active"); // set clicked link to highlight state
			jQuery(".vtabContents").hide(); // hide currently visible tab content div
			jQuery(activeTab).fadeIn(); // show the target tab content div by matching clicked link.
		});
	
	
							
jQuery("a.example2").each(function() {	 
		var image = jQuery(this).contents("img");
			hoverclass = 'hover_video';

	if(jQuery(this).attr('href').match(/(jpg|gif|jpeg|png|tif)/)) 
	hoverclass = 'hover_image';
	if (image.length > 0)
	{	
		var hoverbg = jQuery("<span class='"+hoverclass+"'></span>").appendTo(jQuery(this));
		
			jQuery(this).bind('mouseenter', function(){
			height = image.height();
			width = image.width();
			pos =  image.position();		
			hoverbg.css({height:height, width:width, top:pos.top, left:pos.left});
		});
	}

});	

jQuery("a.example2").contents("img").hover(function() {
		jQuery(this).stop().animate({"opacity": "0.2"}, 400);
		},function() {
		jQuery(this).stop().animate({"opacity": "1"},400);
	});

		// for portfolio pages 
		jQuery('.caption').hide();
 		jQuery('.post_nav_box').hide();
 		jQuery('.portfolio_4_item,.portfolio_2_item,.portfolio_3_item').mouseover(function(e)
		{
		jQuery(this).find('h4').slideDown(100);
		jQuery(this).find('.post_nav_box').show();
		});
		
		// hides the icons container
  		jQuery('.portfolio_4_item,.portfolio_2_item,.portfolio_3_item').mouseleave(function(e)
		{	 
		jQuery(this).find('h4').slideUp(30);
		jQuery(this).find('.post_nav_box').hide();
		});
		
		// pages top toggle box 
		jQuery("#open").click(function(){
			jQuery("div#panel_wrapper").slideDown("slow");
		});	
		jQuery("#close").click(function(){
			jQuery("div#panel_wrapper").slideUp("slow");	
		});		
		jQuery("#toggle a").click(function () {
			jQuery("#toggle a").toggle();
		});	
		
		
		// jquery slide menu 
		jQuery('.jqueryslidemenu ul:first > li').addClass("main-links");		
		jQuery(".jqueryslidemenu ul li.main-links:last-child").css("border-right","none");
		
		
		// shortcode toggle 
		jQuery(".toggle_content").hide();
		jQuery("div.trigger").click(function(){
			jQuery(this).toggleClass("active").next().slideToggle("fast");
		});
		
// Mini contact form widget
		var $j = jQuery.noConflict();
		$j("#mini_submit").click(function(){					   				   
		$j(".error").hide();
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var mini_emailToVal = $j("#mini_emailTo").val();
		if(mini_emailToVal == '') {
			$j("#mini_emailTo").after('<span class="error">You forgot to enter the email address In  Widget Field.</span>');
			hasError = true;
		} else if(!emailReg.test(mini_emailToVal)) {	
			$j("#mini_emailTo").after('<span class="error">Enter a valid email address In widget field.</span>');
			hasError = true;
		}
		
		var mini_emailFromVal = $j("#mini_emailFrom").val();
		if(mini_emailFromVal == '') {
			$j("#mini_emailFrom").after('<span class="error">Sie haben vergessen Ihre Email-Adresse anzugeben.</span>');
			hasError = true;
		} else if(!emailReg.test(mini_emailFromVal)) {	
			$j("#mini_emailFrom").after('<span class="error">Bitte geben Sie eine gültige Email-Adresse an.</span>');
			hasError = true;
		}
		
		var mini_messageVal = $j("#mini_message").val();
		if(mini_messageVal == '') {
			$j("#mini_message").after('<span class="error">Was ist Ihr Anliegen, bitte geben Sie eine Nachricht ein.</span>');
			hasError = true;
		}
		var mini_nameVal = $j("#mini_name").val();
		if(mini_nameVal == '') {
			$j("#mini_name").after('<span class="error">Bitte geben Sie Ihren Namen an.</span>');
			hasError = true;
		}
		if(hasError == false) {
			
         $j(this).hide();
			//$j("#sendEmail .submit").append('<img src=jquerymcolor.template_path + "images/mid-icons-1.png" alt="Loading" id="loading" />');
			$j.post(wppath.template_path + "/lib/functions/widgets/mini_contact_sent.php",
   				{ mini_emailTo:mini_emailToVal,mini_emailFrom:mini_emailFromVal,mini_message:mini_messageVal,mini_name:mini_nameVal},
   					function(data){
					
						$j("#mini_sendEmail").slideUp("normal", function() {				   
							
							$j("#mini_sendEmail").after('<h1>Vielen Dank.</h1><p>Ihre Email wurde versandt.</p>');											
						});
   					}
				 );
		}
		
		return false;
	});						
		
		
});

jQuery(document).ready(function() {   
	// *************************************************************************************
	// Contact Form script
	// ************************************************************************************
	
	function validateMyAjaxInputs() {

		jQuery.validity.start();
		// Validator methods go here:
		jQuery("#name").require();
		jQuery("#email").require().match("email");
		jQuery("#subject").require();	
		jQuery("#captcha").require();

		// End the validation session:
		var result = jQuery.validity.end();
		return result.valid;
	}
	jQuery("#contact-form").submit(function () { 
							//alert(jquerymcolor.template_path);				
			if (validateMyAjaxInputs()) { //  procced only if form has been validated ok with validity 
				var str = jQuery(this).serialize(); 
				jQuery.ajax({
					type: "POST",
					url: wppath.template_path+"/mailsend.php",
					data: str,
					success: function (msg) {
						jQuery("#formstatus").ajaxComplete(function (event, request, settings) { 
						if(msg === 'OK') {   jQuery('input[type=text]').val(""); jQuery('textarea').val(""); }
							if (msg == 'OK') { // Message Sent? Show the 'Thank You' message
								result = '<div class="successmsg">Ihre Nachricht wurde versandt. Vielen Dank!</div>';
								//jQuery('#contact-form').clearForm();
							} else {
								result = msg;
							}
							jQuery(this).html(result);
						});
					}
		
				});
				return false;
			}
		});
	});