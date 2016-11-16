<?php
// OptionsFramework Admin Interface
/*-----------------------------------------------------------------------------------*/
/* Options Framework Admin Interface - optionsframework_add_admin */
/*-----------------------------------------------------------------------------------*/
// Load static framework options pages 

$functions_path = KAYA_FILEPATH . '/lib/admin/';
function optionsframework_add_admin() {
    global $query_string;   

    $themename =  get_option('kaya_themename');   
    $shortname =  get_option('kaya_shortname');    

    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'optionsframework' ) {

		if (isset($_REQUEST['kaya_save']) && 'reset' == $_REQUEST['kaya_save']) {

			$options =  get_option('kaya_template'); 

			kaya_reset_options($options,'optionsframework');

			header("Location: admin.php?page=optionsframework&reset=true");

			die;

		}

    }

	$kaya_page=add_theme_page($themename,'Theme Options', 'edit_theme_options','optionsframework', 'optionsframework_options_page');	

    //$kaya_page = add_submenu_page('themes.php', $themename, 'Theme Options', 'edit_theme_options', 'optionsframework','optionsframework_options_page'); // Default

	// Add framework functionaily to the head individually

	add_action("admin_print_scripts-$kaya_page", 'kaya_load_only');
	add_action("admin_print_styles-$kaya_page",'kaya_style_only');
} 

add_action('admin_menu', 'optionsframework_add_admin');

/*-----------------------------------------------------------------------------------*/
/* Options Framework Reset Function - kaya_reset_options */
/*-----------------------------------------------------------------------------------*/
function kaya_reset_options($options,$page = ''){
	global $wpdb;
	$query_inner = '';
	$count = 0;

	$excludes = array( 'blogname' , 'blogdescription' );

	foreach($options as $option){		

		if(isset($option['id'])){ 

			$count++;

			$option_id = $option['id'];

			$option_type = $option['type'];	

			//Skip assigned id's

			if(in_array($option_id,$excludes)) { continue; }			

			if($count > 1){ $query_inner .= ' OR '; }

			if($option_type == 'multicheck'){

				$multicount = 0;

				foreach($option['options'] as $option_key => $option_option){

					$multicount++;

					if($multicount > 1){ $query_inner .= ' OR '; }

					$query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";				

				}	

			} else if(is_array($option_type)) {

				$type_array_count = 0;

				foreach($option_type as $inner_option){

					$type_array_count++;

					$option_id = $inner_option['id'];

					if($type_array_count > 1){ $query_inner .= ' OR '; }

					$query_inner .= "option_name = '$option_id'";

				}				

			} else {

				$query_inner .= "option_name = '$option_id'";
			}

		}		

	}

	//When Theme Options page is reset - Add the kaya_options option
	if($page == 'optionsframework'){
		$query_inner .= " OR option_name = 'kaya_options'";
	}

	//echo $query_inner;

	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);		
}

/*-----------------------------------------------------------------------------------*/
/* Build the Options Page - optionsframework_options_page */
/*-----------------------------------------------------------------------------------*/

function optionsframework_options_page(){

    $options =  get_option('kaya_template');      

    $themename =  get_option('kaya_themename');

?>

<div class="wrap" id="kaya_container">
    <div id="kaya-popup-save" class="kaya-save-popup">
        <div class="kaya-save-save">Options Updated</div>
    </div>
    <div id="kaya-popup-reset" class="kaya-save-popup">
        <div class="kaya-save-reset">Options Reset</div>
    </div>
    <form action="" enctype="multipart/form-data" id="kayaform">
        <div id="header">
            <div class="logo">
                <h2><?php _e( 'KAYAPATI','Apogee'); ?></h2>
            </div>
            <div class="icon-option"> </div>
            <div class="clear"></div>
        </div>
        <?php 

		// Rev up the Options Machine

        $return = optionsframework_machine($options);

        ?>
        <div id="main">
            <div id="kaya-nav">
                <ul>
                    <?php echo $return[1] ?>
                </ul>
            </div>
            <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
            <div class="clear"></div>
        </div>
        <div class="save_bar_top">
        <img style="display:none" src="<?php echo get_stylesheet_directory_uri(); ?>/lib/admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
        <input type="submit" value="Save All Changes" class="button-primary" />
    </form>
    <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="kayaform-reset">
        <span class="submit-footer-reset">
        <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
        <input type="hidden" name="kaya_save" value="reset" />
        </span>
    </form>
</div>
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div>
<!--wrap-->
<?php

}

/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page - kaya_style_only */
/*-----------------------------------------------------------------------------------*/
function kaya_style_only() {

	wp_enqueue_style('admin-style', KAYA_DIRECTORY.'/lib/admin/admin-style.css');
	wp_enqueue_style('admin-uistyle', KAYA_DIRECTORY.'/lib/admin/css/ui-lightness/jquery-ui-1.8.16.custom.css');
	wp_enqueue_style('admin-jslidrcss', KAYA_DIRECTORY.'/lib/admin/css/jquery.slider.css');
}	

/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page - kaya_load_only */
/*-----------------------------------------------------------------------------------*/

function kaya_load_only() {

	add_action('admin_head', 'kaya_admin_head');
wp_enqueue_script('jquery-input-mask');
	//wp_enqueue_script('jquery-ui-sortable');

wp_enqueue_script('jslider', KAYA_DIRECTORY.'/lib/admin/js/jquery.slider.js', array('jquery'));	
wp_register_script('jquery-input-ui', KAYA_DIRECTORY.'/lib/admin/js/jquery-ui-1.8.16.custom.min.js', array( 'jquery' ));
	wp_register_script('jquery-input-mask', KAYA_DIRECTORY.'/lib/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));

	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('jquery-input-ui');

	wp_enqueue_script('color-picker', KAYA_DIRECTORY.'/lib/admin/js/colorpicker.js', array('jquery'));

	wp_enqueue_script('ajaxupload', KAYA_DIRECTORY.'/lib/admin/js/ajaxupload.js', array('jquery'));	
	
}


function kaya_admin_head() {
?>
<script type="text/javascript" language="javascript">
        function addRow(tableID) { 
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
            }
            }catch(e) {
                alert(e);
            }
        }

    </script>
<script type="text/javascript" language="javascript">

		jQuery(document).ready(function(){
            document.onselectstart = new Function('return false');

            /* simple slider[default skin] */
            var maxFont = 30;
            var mf = jQuery('#myFont').css('font-size', 30);

            jQuery.fn.jSlider({
                renderTo: '#slidercontainer1',
                size: { barWidth: 400, sliderWidth: 5 },
                onChanging: function(percentage, e) {
                    mf.css('font-size', maxFont * percentage);
                    window.console && console.log('percentage: %s', percentage);
                }
            });
            /* end------------------------- */

    
			//Color Picker
			<?php $options = get_option('kaya_template');	

			foreach($options as $option){ 

			if($option['type'] == 'color' OR $option['type'] == 'typography' OR $option['type'] =='background' OR $option['type'] == 'googletypography' OR $option['type'] == 'border'){

				if($option['type'] == 'googletypography' OR $option['type'] == 'typography' OR $option['type'] == 'border' OR $option['type'] =='background'){

					$option_id = $option['id'];

					$temp_color = get_option($option_id);

					$option_id = $option['id'] . '_color';

					$color = $temp_color['color'];

				}

				else {

					$option_id = $option['id'];

					$color = get_option($option_id);

				}

				?>

				 jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    

				 jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({

					color: '<?php echo $color; ?>',

					onShow: function (colpkr) {

						jQuery(colpkr).fadeIn(500);

						return false;

					},

					onHide: function (colpkr) {

						jQuery(colpkr).fadeOut(500);

						return false;

					},

					onChange: function (hsb, hex, rgb) {

						//jQuery(this).css('border','1px solid red');

						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);

						jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);					

					}

				  });

			  <?php } } ?>	 

		});
		</script>
<?php

		//AJAX Upload
		?>
<script type="text/javascript">

	
    
  
			jQuery(document).ready(function(){			
				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();			
				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 

						function(){

           					if (jQuery(this).hasClass('last')) {

           						jQuery(this).removeClass('hidden');

           						return false;

           					}

           					jQuery(this).filter('.hidden').removeClass('hidden');

           				});

           		});          					

				jQuery('.group .collapsed input:checkbox').click(unhideHidden);				

				function unhideHidden(){

					if (jQuery(this).attr('checked')) {

						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}

					else {

						jQuery(this).parent().parent().parent().nextAll().each( 

							function(){

           						if (jQuery(this).filter('.last').length) {

           							jQuery(this).addClass('hidden');

									return false;
           						}

           						jQuery(this).addClass('hidden');

           					});     
					}

				}
			

				jQuery('.kaya-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.kaya-radio-img-img').removeClass('kaya-radio-img-selected');
					jQuery(this).addClass('kaya-radio-img-selected');				

				});

				jQuery('.kaya-radio-img-label').hide();

				jQuery('.kaya-radio-img-img').show();

				jQuery('.kaya-radio-img-radio').hide();

				jQuery('#kaya-nav li:first').addClass('current');

				jQuery('#kaya-nav li a').click(function(evt){			

						jQuery('#kaya-nav li').removeClass('current');

						jQuery(this).parent().addClass('current');						

						var clicked_group = jQuery(this).attr('href');		 

						jQuery('.group').hide();					

							jQuery(clicked_group).fadeIn();	

						evt.preventDefault();					

					});
			

				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){				

					var reset_popup = jQuery('#kaya-popup-reset');

					reset_popup.fadeIn();

					window.setTimeout(function(){

						   reset_popup.fadeOut();                        

						}, 2000);

						//alert(response);				

				}

			//Update Message popup
			jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;

			}

			jQuery('#kaya-popup-save').center();
			jQuery('#kaya-popup-reset').center();
			jQuery(window).scroll(function() { 
				jQuery('#kaya-popup-save').center();
				jQuery('#kaya-popup-reset').center();			

			});

			//AJAX Upload

			jQuery('#kayaform .image_upload_button').each(function(){			

			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	

			new AjaxUpload(clickedID, {

				  action: '<?php echo admin_url("admin-ajax.php"); ?>',

				  name: clickedID, // File upload name

				  data: { // Additional data to send

						action: 'kaya_ajax_post_action',

						type: 'upload',

						data: clickedID },

				  autoSubmit: true, // Submit file after selection

				  responseType: false,

				  onChange: function(file, extension){},

				  onSubmit: function(file, extension){

						clickedObject.text('Uploading'); // change button text, when user selects file	

						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button

						interval = window.setInterval(function(){

							var text = clickedObject.text();

							if (text.length < 13){	clickedObject.text(text + '.'); }

							else { clickedObject.text('Uploading'); } 

						}, 200);

				  },

				  onComplete: function(file, response) {				   

					window.clearInterval(interval);
					clickedObject.text('Upload Image');	

					this.enable(); // enable upload button

					// If there was an error

					if(response.search('Upload Error') > -1){

						var buildReturn = '<span class="upload-error">' + response + '</span>';

						jQuery(".upload-error").remove();

						clickedObject.parent().after(buildReturn);

					

					}

					else{

						var buildReturn = '<img class="hide kaya-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

						jQuery(".upload-error").remove();

						jQuery("#image_" + clickedID).remove();	

						clickedObject.parent().after(buildReturn);

						jQuery('img#image_'+clickedID).fadeIn();

						clickedObject.next('span').fadeIn();

						clickedObject.parent().prev('input').val(response);

					}

				  }

				});

			});

			

			//AJAX Remove (clear option value)

			jQuery('.image_reset_button').click(function(){

					var clickedObject = jQuery(this);

					var clickedID = jQuery(this).attr('id');

					var theID = jQuery(this).attr('title');	

					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';

					var data = {

						action: 'kaya_ajax_post_action',

						type: 'image_reset',

						data: theID

					};

					jQuery.post(ajax_url, data, function(response) {

						var image_to_remove = jQuery('#image_' + theID);

						var button_to_hide = jQuery('#reset_' + theID);

						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });

						button_to_hide.fadeOut();

						clickedObject.parent().prev('input').val('');

					});

					return false; 
				}); 

			//Save everything else

			jQuery('#kayaform').submit(function(){

					function newValues() {

					  var serializedValues = jQuery("#kayaform").serialize();

					  return serializedValues;

					}

					jQuery(":checkbox, :radio").click(newValues);

					jQuery("select").change(newValues);

					jQuery('.ajax-loading-img').fadeIn();

					var serializedReturn = newValues();

					 

					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';

				

					 //var data = {data : serializedReturn};

					var data = {

						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'optionsframework'){ ?>

						type: 'options',

						<?php } ?>



						action: 'kaya_ajax_post_action',

						data: serializedReturn

					};

					jQuery.post(ajax_url, data, function(response) {

						var success = jQuery('#kaya-popup-save');

						var loading = jQuery('.ajax-loading-img');

						loading.fadeOut();  

						success.fadeIn();

						window.setTimeout(function(){

						   success.fadeOut(); 


						}, 2000);

					});

				return false; 

					

				});   	 	

				

			});

		</script>
<?php

}

/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action - kaya_ajax_callback */
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_kaya_ajax_post_action', 'kaya_ajax_callback');

function kaya_ajax_callback() {

	global $wpdb; // this is how you get access to the database

	$save_type = $_POST['type'];

	//Uploads

	if($save_type == 'upload'){

		$clickedID = $_POST['data']; // Acts as the name

		$filename = $_FILES[$clickedID];

       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 

		

		$override['test_form'] = false;

		$override['action'] = 'wp_handle_upload';    

		$uploaded_file = wp_handle_upload($filename,$override);

		 

				$upload_tracking[] = $clickedID;

				update_option( $clickedID , $uploaded_file['url'] );

				

		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	

		 else { echo $uploaded_file['url']; } // Is the Response

	}

	elseif($save_type == 'image_reset'){

			

			$id = $_POST['data']; // Acts as the name

			global $wpdb;

			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";

			$wpdb->query($query);

		}	

	elseif ($save_type == 'options' OR $save_type == 'framework') {

		$data = $_POST['data'];

		parse_str($data,$output);

		//print_r($output);
				//Pull options

        	$options = get_option('kaya_template');

		foreach($options as $option_array){

			$id = $option_array['id'];

			$old_value = get_option($id);

			$new_value = '';

			if(isset($output[$id])){

				$new_value = $output[$option_array['id']];

			}

			if(isset($option_array['id'])) { // Non - Headings...

					$type = $option_array['type'];

					if ( is_array($type)){

						foreach($type as $array){

							if($array['type'] == 'text'){

								$id = $array['id'];

								$std = $array['std'];

								$new_value = $output[$id];

								if($new_value == ''){ $new_value = $std; }

								update_option( $id, stripslashes($new_value));

							}
							if($array['type'] == 'textsmall'){

								$id = $array['id'];

								$std = $array['std'];

								$new_value = $output[$id];

								if($new_value == ''){ $new_value = $std; }

								update_option( $id, stripslashes($new_value));

							}


						}                 

					}

					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save

						

						update_option($id,'false');

					}

					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save

						

						update_option($id,'true');

					}elseif ($type == 'sidebarmulticheck'){ // Checkbox Save

						    $multicheck_array = array();

                			$multicheck_array = $output[$option_array['id']];
							
							update_option($id,$multicheck_array);

					}elseif ($type == 'sortablemulticheck'){ // Checkbox Save

						    $multicheck_array = array();

                			$multicheck_array = $output[$option_array['id']];
							
							update_option($id,$multicheck_array);
							$optmulticheck_array = $output[$option_array['id'].'_sort_data'];
							
							update_option($id.'_sort_data',$optmulticheck_array);

					}elseif ($type == 'blogmulticheck'){ // Checkbox Save
						
							 $multicheck_array = array();

							$multicheck_array = $output[$option_array['id']];

                           update_option($id,$multicheck_array);

					}elseif ($type == 'taxportfolio'){ // Checkbox Save

						    $multicheck_array = array();

                        $multicheck_array = $output[$option_array['id']];

                   		update_option($id,$multicheck_array);

					}
					elseif ($type == 'customsidebar'){ // Checkbox Save

						    $customsidebar_array = array();
                                               $customsidebar_array = $output[$option_array['id']];

                                               update_option($id,$customsidebar_array);

					}

					elseif($type == 'multicheck'){ // Multi Check Save

						$option_options = $option_array['options'];

						foreach ($option_options as $options_id => $options_value){

							$multicheck_id = $id . "_" . $options_id;

							if(!isset($output[$multicheck_id])){

							  update_option($multicheck_id,'false');

							}

							else{

							   update_option($multicheck_id,'true'); 

							}

						}

					}elseif($type == 'background'){

						$background_array = array();	

						
						$background_array['color'] = $output[$option_array['id'] . '_color'];
						$background_array['image'] = $output[$option_array['id'] . '_image'];
						$background_array['position'] = $output[$option_array['id'] . '_position'];
						$background_array['repeat'] = $output[$option_array['id'] . '_repeat'];

						update_option($id,$background_array);

					} 

					elseif($type == 'typography'){

						$typography_array = array();	

						$typography_array['size'] = $output[$option_array['id'] . '_size'];

						$typography_array['face'] = stripslashes($output[$option_array['id'] . '_face']);

						$typography_array['style'] = $output[$option_array['id'] . '_style'];

						$typography_array['color'] = $output[$option_array['id'] . '_color'];

						update_option($id,$typography_array);

					}elseif($type == 'googletypography'){

						$googletypography_array = array();	

						$googletypography_array['size'] = $output[$option_array['id'] . '_size'];

						$googletypography_array['gfont'] = $output[$option_array['id'] . '_gfont'];

						$googletypography_array['color'] = $output[$option_array['id'] . '_color'];

						update_option($id,$googletypography_array);

					}

					elseif($type == 'border'){

						$border_array = array();	

						$border_array['width'] = $output[$option_array['id'] . '_width'];

						$border_array['style'] = $output[$option_array['id'] . '_style'];

						$border_array['color'] = $output[$option_array['id'] . '_color'];

						update_option($id,$border_array);

					}

					elseif($type != 'upload_min'){

					update_option($id,stripslashes($new_value));

					}

				}

			}	

	}


  die();

}

/*-----------------------------------------------------------------------------------*/
/* Generates The Options Within the Panel - optionsframework_machine */
/*-----------------------------------------------------------------------------------*/
function optionsframework_machine($options) {

    $counter = 0;

	$menu = '';

	$output = '';

	foreach ($options as $value) {
		$counter++;

		$val = '';

		//Start Heading

		 if ( $value['type'] != "heading" )

		 {

		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			$kayaid='';
			if(isset( $value['id'] )) { $kayaid = $value['id']; }

			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";

			$output .= '<div class="section section-'.$value['type'].' '. $class .' '.$kayaid.'">'."\n";

			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";

			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 } 

		 //End Heading

		$select_value = '';                                   

		switch ( $value['type'] ) {

		case 'text':

			$val = $value['std'];

			$std = get_option($value['id']);

			if ( $std != "") { $val = $std; }

			$output .= '<input class="kaya-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';

		break;
		case 'textsmall':

			$val = $value['std'];

			$std = get_option($value['id']);

			if ( $std != "") { $val = $std; }

			$output .= '<input class="input-text-small" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';

		break;

		case 'gfont':
		global $kayagoogle_fonts ;

			$output .= '<select class="kaya-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';

			$select_value = get_option($value['id']);
			foreach ($value['options'] as $option) {
				
				$selected = '';

				 if($select_value != '') {

					 if ( $select_value == $option['name']) { $selected = ' selected="selected"';} 

			     } else {

					 if ( isset($value['std']) )

						 if ($value['std'] == $option['name']) { $selected = ' selected="selected"'; }

				 }

				 $output .= '<option value="'.$option['name'].'" '. $option[$key] .''. $selected .'>';

				 $output .= $option['name'];

				 $output .= '</option>';

			 } 

			 $output .= '</select>';

		break;

		case 'select':

			$output .= '<select class="kaya-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
			$select_value = get_option($value['id']);
			foreach ($value['options'] as $option) {
			$selected = '';
		
			if($select_value != '') {

					 if ( $select_value == $option) { $selected = ' selected="selected"';} 

			     } else {

					 if ( isset($value['std']) )

						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }

				 }

				 $output .= '<option'. $selected .'>';

				 $output .= $option;

				 $output .= '</option>';

			 } 

			 $output .= '</select>';

		break;
		case 'customsidebar':
		$val = $value['std'];
			 $std = get_option($value['id']);
				 $custom_sidebar_arr=@get_option($value['id']);
				// print_r($custom_sidebar_arr);
				if ( $std != "") { $val = $std; }
					$output.= '<div id="kaya_widget_sidebar"><table id="kaya_sidebar_table" cellpadding="0" cellspacing="0">';
				$output.='<tbody>';
				
				if($custom_sidebar_arr !=""){
				foreach($custom_sidebar_arr as $custom_sidebar_code) {
					$output.='<tr><td><input type="text" name="'.$value['id'].'[]" value="'. $custom_sidebar_code.'"  size="30" style="width:97%" /></td><td><a  href="javascript:void(0);return false;" onClick="jQuery(this).parent().parent().remove();">Delete</a></td></tr>';
				}
					}				
				$output.='</tbody></table><input type="button" name="add_custom_widget" style="width:200px" value="Add New Sidebar" onClick="kaya_add_row()"></div>';
				?>
<script type="text/javascript" language="javascript">
							function kaya_add_row(){
								jQuery('#kaya_sidebar_table').append('<tr><td><input type="text" name="<?php echo $value['id'];?>[]" value="" size="30" style="width:97%" /></td><td><a href="javascript:void(0);return false;" onClick="jQuery(this).parent().parent().remove();">Delete</a></td></tr>');
													
							}

				</script>
<?php

		break;
	
case 'sortable1' :
?>

<?php
		 $std =  $value['std'];
		 $output.='<ul id="sortable11" class="connectedSortabl1e">';
       		foreach ($value['options'] as $key => $option) {



       $checked = "";

                       if (get_option( $value['id'])) {

                               if (@in_array($key, get_option($value['id'] ))) $checked =

"checked=\"checked\"";

                       }

               else {

               }
			  $output.='<li class="ui-state-default">'. $key .'</li>';

         // $output .= '<input type="checkbox" class="checkbox atp-input"name="'. $value['id'] .'[]" id="'. $value['id'] .'[]" value="'.$key.'"'. $checked .' /><label for="'. $key .'">'. $option .'</label><br/>';
 
}
$output.="</ul>";
		break;


		case 'sidebarmulticheck' :
		 $std =  $value['std'];
       		foreach ($value['options'] as $key => $option) {



       $checked = "";

                       if (get_option( $value['id'])) {

                               if (@in_array($key, get_option($value['id'] ))) $checked =

"checked=\"checked\"";

                       }

               else {

               }

                       $output .= '<input type="checkbox" class="checkbox atp-input"

name="'. $value['id'] .'[]" id="'. $value['id'] .'[]" value="'.$key.'"

'. $checked .' /><label for="'. $key .'">'. $option .'</label><br

/>';

}

		break;
		
		case 'sortablemulticheck' :
		 $std =  $value['std'];
		 ?>
		 <script>
	jQuery(function() {
	
		jQuery( ".sortable1" ).sortable({
			placeholder: "connectedSortable",
			create: function(event, ui) { 
				HomeSortableRel = jQuery(this).attr('rel');
			
				var order = jQuery(this).sortable('toArray');
            	jQuery('#'+HomeSortableRel).val(order);
			},
			update: function(event, ui) {
				HomeSortableRel = jQuery(this).attr('rel');
			
				var order = jQuery(this).sortable('toArray');
            	jQuery('#'+HomeSortableRel).val(order);
			}
		});
	
		jQuery( ".sortable1" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
	});
	</script>
	<?php
	$output.='<p>Select check boxes to pages which you want to show on your homepage and sort pages by <strong>Drag &amp; Drop</strong> vertically.	&nbsp; <a href="'.home_url().'/wp-admin/post-new.php?post_type=page"><strong>Add New Page</strong></a></p>'; 
		  $output .='<div class="sortable_order">';
       		foreach ($value['options'] as $key => $option) {



       $checked = "";

                       if (get_option( $value['id'])) {

                               if (@in_array($key, get_option($value['id'] ))) $checked =

"checked=\"checked\"";

                       }

               else {

               }

                       $output .= '<span class="sortablepages"><input   alt="'.html_entity_decode($option).'"  rel="'.$value['id'].'_sort" type="checkbox" class="checkbox atp-input"

name="'. $value['id'] .'[]" id="'. $value['id'] .'[]" value="'.$key.'"

'. $checked .' /><label for="'. $key .'">'. $option .'</label></span>';

}
$output .="</div>";
$output .="<div class='clear'></div>";
$output.='<div class="sortableorder">';
 $output.='<ul rel="'.$value['id'].'_sort_data" id="'.$value['id'].'_sort" class="connectedSortable sortable1">';
 
// $sortable_data_array=get_option('homecolumn_sort_data');
 $sortable_data_array = explode(',', get_option('homecolumn_sort_data'));
 if(!empty($sortable_data_array))
	 	{
	 	foreach($sortable_data_array as $key => $sortable_data_item)
	 	{
	 		if (is_array(get_option($value['id'] )) && in_array($sortable_data_item, get_option($value['id'] ))) {
	 
	 	 foreach ($value['options'] as $key => $option) {
	 if($sortable_data_item == $key) {
	 	$output.='<li id="'.$sortable_data_item.'" class="ui-state-default ">'.$option.'</li>'; 	
	 }
	 }	
	 
	 		}
	 	}
	 	}
  $output.='</ul>';
 $output.='<input type="hidden" id="'.$value['id'].'_sort_data" name="'.$value['id'].'_sort_data" value="" style="width:100%"/>';
$output.='</div>';

		break;

			case 'blogmulticheck' :

		 $std =  $value['std'];



                       foreach ($value['options'] as $key => $option) {



       $checked = "";

                       if (get_option( $value['id'])) {

                               if (@in_array(-($key), get_option($value['id'] ))) $checked =

"checked=\"checked\"";

                       }

               else {

               }

                       $output .= '<input type="checkbox" class="checkbox atp-input"

name="'. $value['id'] .'[]" id="'. $value['id'] .'[]" value="-'.$key.'"

'. $checked .' /><label for="'. $key .'">'. $option .'</label><br

/>';

}

		break;

		case 'select2':



			$output .= '<select class="kaya-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';

		

			$select_value = get_option($value['id']);

			 

			foreach ($value['options'] as $option => $name) {

				

				$selected = '';

				

				 if($select_value != '') {

					 if ( $select_value == $option) { $selected = ' selected="selected"';} 

			     } else {

					 if ( isset($value['std']) )

						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }

				 }

				  

				 $output .= '<option'. $selected .' value="'.$option.'">';

				 $output .= $name;

				 $output .= '</option>';

			 

			 } 

			 $output .= '</select>';



			

		break;

		case 'textarea':

			

			$cols = '8';

			$ta_value = '';

			

			if(isset($value['std'])) {

				

				$ta_value = $value['std']; 

				

				if(isset($value['options'])){

					$ta_options = $value['options'];

					if(isset($ta_options['cols'])){

					$cols = $ta_options['cols'];

					} else { $cols = '8'; }

				}

				

			}

				$std = get_option($value['id']);

				if( $std != "") { $ta_value = stripslashes( $std ); }

				$output .= '<textarea class="kaya-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';

		break;
		
		case "radio":

			 $select_value = get_option( $value['id']);				   

			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';

				   if($select_value != '') {

						if ( $select_value == $key) { $checked = ' checked'; } 

				   } else {

					if ($value['std'] == $key) { $checked = ' checked'; }

				   }

				$output .= '<input class="kaya-input kaya-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			}

			 
		break;

		case "checkbox": 
		   $std = $value['std'];  

		   $saved_std = get_option($value['id']);
		   $checked = '';

			if(!empty($saved_std)) {

				if($saved_std == 'true') {

				$checked = 'checked="checked"';

				}

				else{

				   $checked = '';

				}

			}

			elseif( $std == 'true') {

			   $checked = 'checked="checked"';

			}

			else {

				$checked = '';

			}

			$output .= '<input type="checkbox" class="checkbox kaya-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;

		case 'taxportfolio':

 	$output .= '<select class="kaya-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';

			$select_value = get_option($value['id']);

$output .= '<option value="">Select Category</option>';

 $tax_portfolio = get_terms('portfolio_category','orderby=name&hide_empty=0');

				foreach($tax_portfolio as $key => $portfolio) {

						$selected = '';

				 if($select_value != '') {

					 if ( $select_value == $portfolio->slug) { $selected = ' selected="selected"';} 

			     } else {

					 if ( isset($value['std']) )

						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }

				 }			

			$output .= '<option '. $selected .' value="'.$portfolio->slug.'">'.$portfolio->name.'</option>';

			}

		$output .= '</select>';

			
			 /* $select_value = get_option($value['id']);

			 

			foreach ($value['options'] as $option => $name) {

				

				$selected = '';

				

				 if($select_value != '') {

					 if ( $select_value == $option) { $selected = ' selected="selected"';} 

			     } else {

					 if ( isset($value['std']) )

						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }

				 }

				  

				 $output .= '<option'. $selected .' value="'.$option.'">';

				 $output .= $name;

				 $output .= '</option>';

			 

			 } 

			 $output .= '</select>'; */

		break;

		case "multicheck":
			$std =  $value['std'];         

			foreach ($value['options'] as $key => $option) {
			$kaya_key = $value['id'] . '_' . $key;

			$saved_std = get_option($kaya_key);

			if(!empty($saved_std)) 

			{ 

				  if($saved_std == 'true'){

					 $checked = 'checked="checked"';  

				  } 

				  else{

					  $checked = '';     

				  }    

			} 

			elseif( $std == $key) {

			   $checked = 'checked="checked"';

			}

			else {

				$checked = '';                                                                                    }

			$output .= '<input type="checkbox" class="checkbox kaya-input" name="'. $kaya_key .'" id="'. $kaya_key .'" value="true" '. $checked .' /><label for="'. $kaya_key .'">'. $option .'</label><br />';

										

			}

		break;
		case "background":
		$default = $value['std'];

			$background_stored = get_option($value['id']);

			/* Font Size */

			$val = $default['color'];

			if ( $background_stored['color'] != "") { $val = $background_stored['color']; }		
			
			// Background Color		
			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector""><div></div></div>';
			//$output .= '<input class="of-color of-background of-background-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $background['color'] ) . '" />';
				$output .= '<input class="kaya-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';
			
				$val = $default['image'];

			if ( $background_stored['image'] != "") { $val = $background_stored['image']; }	
			$sliderimage_id=$value['id'] .'_image';	
			$output .= optionsframework_uploader_function($sliderimage_id,$val,null);
			$output .="<br/>";
			/* Font Face */

			$val = $default['repeat'];

			if ( $background_stored['repeat'] != "") 
			$val = $background_stored['repeat']; 
			if (strpos($val, 'no-repeat') !== false){ $norepet = 'selected="selected"'; }
			if (strpos($val, 'repeat-x') !== false){ $repetx = 'selected="selected"'; }
			if (strpos($val, 'repeat-y') !== false){ $repety = 'selected="selected"'; }
			if (strpos($val, 'repeat') !== false){ $repet = 'selected="selected"'; }
			$output .= '<select class="kaya-background kaya-backgroun-repeat" name="'. $value['id'].'_repeat" id="'. $value['id'].'_repeat">';

			$output .= '<option value="no-repeat" '. $norepet .'>no-repeat</option>';
			$output .= '<option value="repeat-x" '. $repetx .'>Repeat Horizontally</option>';
			$output .= '<option value="repeat-y" '. $repety .'>Repeat Vertically</option>';
			$output .= '<option value="repeat" '. $repet .'>Repeat All</option>';

			
			$output .= '</select>';
			$val = $default['position'];

			if ( $background_stored['position'] != "") 
			$val = $background_stored['position']; 
			if (strpos($val, 'top left') !== false){ $topleft = 'selected="selected"'; }
			if (strpos($val, 'top center') !== false){ $topcenter = 'selected="selected"'; }
			if (strpos($val, 'top right') !== false){ $topright = 'selected="selected"'; }
			if (strpos($val, 'center left') !== false){ $centerleft = 'selected="selected"'; }
			if (strpos($val, 'center center') !== false){ $centercenter = 'selected="selected"'; }
			if (strpos($val, 'center right') !== false){ $centerright = 'selected="selected"'; }
			if (strpos($val, 'bottom left') !== false){ $bottomleft = 'selected="selected"'; }
			if (strpos($val, 'bottom center') !== false){ $bottomcenter = 'selected="selected"'; }
			if (strpos($val, 'bottom right') !== false){ $bottomright = 'selected="selected"'; }
			
			$output .= '<select class="kaya-background kaya-backgroun-repeat" name="'. $value['id'].'_position" id="'. $value['id'].'_position">';

			$output .= '<option value="top left" '. $topleft .'>Top Left</option>';
			$output .= '<option value="top center" '. $topcenter .'>Top Center</option>';
			$output .= '<option value="top right" '. $topright .'>Top Right</option>';
			$output .= '<option value="center left" '. $centerleft .'>Center Left</option>';
			$output .= '<option value="center center" '. $centercenter .'>Center Center</option>';
			$output .= '<option value="center right" '. $centerright .'>Center Right</option>';
			$output .= '<option value="bottom left" '. $bottomleft .'>Bottom Left</option>';
			$output .= '<option value="bottom center" '. $bottomcenter .'>Bottom Center</option>';
			$output .= '<option value="bottom right" '. $bottomright .'>Bottom Right</option>';
			
			

			
			$output .= '</select>';

			
		break;

		case "upload":
			$output .= optionsframework_uploader_function($value['id'],$value['std'],null);
		break;

		case "upload_min":
			$output .= optionsframework_uploader_function($value['id'],$value['std'],'min');

		break;

		case "color":

			$val = $value['std'];

			$stored  = get_option( $value['id'] );

			if ( $stored != "") { $val = $stored; }

			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';

			$output .= '<input class="kaya-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';

		break;   

		case "typography":
			$default = $value['std'];

			$typography_stored = get_option($value['id']);

			/* Font Size */

			$val = $default['size'];

			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }

			$output .= '<select class="kaya-typography kaya-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';

				for ($i = 9; $i < 71; $i++){ 

					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }

					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }

			$output .= '</select>';

		

			/* Font Face */

			$val = $default['face'];

			if ( $typography_stored['face'] != "") 

				$val = $typography_stored['face']; 



			$font01 = ''; 

			$font02 = ''; 

			$font03 = ''; 

			$font04 = ''; 

			$font05 = ''; 

			$font06 = ''; 

			$font07 = ''; 

			$font08 = '';

			$font09 = '';



			if (strpos($val, 'Arial, sans-serif') !== false){ $font01 = 'selected="selected"'; }

			if (strpos($val, 'Verdana, Geneva') !== false){ $font02 = 'selected="selected"'; }

			if (strpos($val, 'Trebuchet') !== false){ $font03 = 'selected="selected"'; }

			if (strpos($val, 'Georgia') !== false){ $font04 = 'selected="selected"'; }

			if (strpos($val, 'Times New Roman') !== false){ $font05 = 'selected="selected"'; }

			if (strpos($val, 'Tahoma, Geneva') !== false){ $font06 = 'selected="selected"'; }

			if (strpos($val, 'Palatino') !== false){ $font07 = 'selected="selected"'; }

			if (strpos($val, 'Helvetica') !== false){ $font08 = 'selected="selected"'; }
			

			

			$output .= '<select class="kaya-typography kaya-typography-face" name="'. $value['id'].'_face" id="'. $value['id'].'_face">';

			$output .= '<option value="Arial, sans-serif" '. $font01 .'>Arial</option>';

			$output .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';

			$output .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';

			$output .= '<option value="Georgia, serif" '. $font04 .'>Georgia</option>';

			$output .= '<option value="&quot;Times New Roman&quot;, serif"'. $font05 .'>Times New Roman</option>';

			$output .= '<option value="Tahoma, Geneva, Verdana, sans-serif"'. $font06 .'>Tahoma</option>';

			$output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"'. $font07 .'>Palatino</option>';

			$output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font08 .'>Helvetica*</option>';

			$output .= '</select>';

			

			/* Font Weight */

			$val = $default['style'];

			if ( $typography_stored['style'] != "") { $val = $typography_stored['style']; }

				$normal = ''; $italic = ''; $bold = ''; $bolditalic = '';

			if($val == 'normal'){ $normal = 'selected="selected"'; }

			if($val == 'italic'){ $italic = 'selected="selected"'; }

			if($val == 'bold'){ $bold = 'selected="selected"'; }

			if($val == 'bold italic'){ $bolditalic = 'selected="selected"'; }

			

			$output .= '<select class="kaya-typography kaya-typography-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';

			$output .= '<option value="normal" '. $normal .'>Normal</option>';

			$output .= '<option value="italic" '. $italic .'>Italic</option>';

			$output .= '<option value="bold" '. $bold .'>Bold</option>';

			$output .= '<option value="bold italic" '. $bolditalic .'>Bold/Italic</option>';

			$output .= '</select>';

			

			/* Font Color */

			$val = $default['color'];

			if ( $typography_stored['color'] != "") { $val = $typography_stored['color']; }			

			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';

			$output .= '<input class="kaya-color kaya-typography kaya-typography-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';



		break;  
		case "googletypography":
			$default = $value['std'];

			$googletypography_stored = get_option($value['id']);
			$val = $default['gfont'];

			if ( $googletypography_stored['gfont'] != "") { $val = $googletypography_stored['gfont']; }



			$output .= '<input  name="'. $value['id'].'_gfont" id="'. $value['id'].'_gfont"  type="text"   value="'.$val .'" size="20px" class="kaya-color kaya-googletypography kaya-googletypography-input">';
			/* Font Size */

			$val = $default['size'];

			if ( $googletypography_stored['size'] != "") { $val = $googletypography_stored['size']; }

			$output .= '<select class="kaya-typography kaya-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';

				for ($i = 9; $i < 71; $i++){ 

					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }

					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }

			$output .= '</select>';

		
			/* Font Color */

			$val = $default['color'];

			if ( $typography_stored['color'] != "") { $val = $typography_stored['color']; }			

			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';

			$output .= '<input class="kaya-color kaya-typography kaya-typography-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';



		break;  

		

		case "border":

		

			$default = $value['std'];

			$border_stored = get_option( $value['id'] );

			

			/* Border Width */

			$val = $default['width'];

			if ( $border_stored['width'] != "") { $val = $border_stored['width']; }

			$output .= '<select class="kaya-border kaya-border-width" name="'. $value['id'].'_width" id="'. $value['id'].'_width">';

				for ($i = 0; $i < 21; $i++){ 

					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }

					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }

			$output .= '</select>';

			

			/* Border Style */

			$val = $default['style'];

			if ( $border_stored['style'] != "") { $val = $border_stored['style']; }

				$solid = ''; $dashed = ''; $dotted = '';

			if($val == 'solid'){ $solid = 'selected="selected"'; }

			if($val == 'dashed'){ $dashed = 'selected="selected"'; }

			if($val == 'dotted'){ $dotted = 'selected="selected"'; }

			

			$output .= '<select class="kaya-border kaya-border-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';

			$output .= '<option value="solid" '. $solid .'>Solid</option>';

			$output .= '<option value="dashed" '. $dashed .'>Dashed</option>';

			$output .= '<option value="dotted" '. $dotted .'>Dotted</option>';

			$output .= '</select>';

			

			/* Border Color */

			$val = $default['color'];

			if ( $border_stored['color'] != "") { $val = $border_stored['color']; }			

			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';

			$output .= '<input class="kaya-color kaya-border kaya-border-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';



		break;   

		

		case "images":

			$i = 0;

			$select_value = get_option( $value['id']);

				   

			foreach ($value['options'] as $key => $option) 

			 { 

			 $i++;



				 $checked = '';

				 $selected = '';

				   if($select_value != '') {

						if ( $select_value == $key) { $checked = ' checked'; $selected = 'kaya-radio-img-selected'; } 

				    } else {

						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'kaya-radio-img-selected'; }

						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'kaya-radio-img-selected'; }

						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'kaya-radio-img-selected'; }

						else { $checked = ''; }

					}	

				

				$output .= '<span>';

				$output .= '<input type="radio" id="kaya-radio-img-' . $value['id'] . $i . '" class="checkbox kaya-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';

				$output .= '<div class="kaya-radio-img-label">'. $key .'</div>';

				$output .= '<img src="'.$option.'" alt="" class="kaya-radio-img-img '. $selected .'" onClick="document.getElementById(\'kaya-radio-img-'. $value['id'] . $i.'\').checked = true;" />';

				$output .= '</span>';

				

			}

		

		break; 

		

		case "info":

			$default = $value['std'];

			$output .= $default;

		break;     
	case "subheading":

			//$default = $value['std'];

			//$output .= $default;

		break; 		

		

		case "heading":

			

			if($counter >= 2){

			   $output .= '</div>'."\n";

			}

			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );

			$jquery_click_hook = "kaya-option-" . $jquery_click_hook;

			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';

			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";

		break;                                  

		} 

		

		// if TYPE is an array, formatted into smaller inputs... ie smaller values

		if ( is_array($value['type'])) {

			foreach($value['type'] as $array){

			

					$id = $array['id']; 

					$std = $array['std'];

					$saved_std = get_option($id);

					if($saved_std != $std){$std = $saved_std;} 

					$meta = $array['meta'];

					

					if($array['type'] == 'text') { // Only text at this point

						 

						 $output .= '<input class="input-text-small kaya-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  

						 $output .= '<span class="meta-two">'.$meta.'</span>';

					}

				}

		}

		if ( $value['type'] != "heading" ) { 

			if ( $value['type'] != "checkbox" ) 

				{ 

				//$output .= '<br/>';

				}
				
			if ( $value['type'] != "sortablemulticheck" ) 

				{ 

			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 

			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";

			$output .= '<div class="clear"> </div></div></div>'."\n";

			}else{ $output .= '</div><div class="clear"> </div></div></div>'."\n";
 }
			}

	}

    $output .= '</div>';

    return array($output,$menu);
}

/*-----------------------------------------------------------------------------------*/
/* OptionsFramework Uploader - optionsframework_uploader_function */
/*-----------------------------------------------------------------------------------*/

function optionsframework_uploader_function($id,$std,$mod){
    //$uploader .= '<input type="file" id="attachement_'.$id.'" name="attachement_'.$id.'" class="upload_input"></input>';

    //$uploader .= '<span class="submit"><input name="save" type="submit" value="Upload" class="button upload_save" /></span>';

    
	$uploader = '';

    $upload = get_option($id);

	

	if($mod != 'min') { 

			$val = $std;

            if ( get_option( $id ) != "") { $val = get_option($id); }

            $uploader .= '<input class="kaya-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';

	}

	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';

	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}

	

	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';

	$uploader .='</div>' . "\n";

    $uploader .= '<div class="clear"></div>' . "\n";

	if(!empty($upload)){

    	$uploader .= '<a class="kaya-uploaded-image" href="'. $upload . '">';

    	$uploader .= '<img class="kaya-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';

    	$uploader .= '</a>';

		}

	$uploader .= '<div class="clear"></div>' . "\n"; 

return $uploader;

}
?>
