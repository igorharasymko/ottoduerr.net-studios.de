<?php

global $kaya_shortcodes;
global $kaya_shortcodes;
$kaya_shortcodes=array();

$kaya_shortcodes = array(
  // Layout Start
array(
		"name" => "Layouts",
		"value" => "layouts",
		"sub" => true,
		"options" => array(
			array(
				"name" => "Five Column Layout",
				"value" => "fivecolumn_layout",
				"options" => array (
					array(
						"name" => sprintf("%s Content",'column5'),
						"id" => "1",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column5'),
						"id" => "2",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column5'),
						"id" => "3",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column5'),
						"id" => "4",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column5_last'),
						"id" => "5",
						"default" => "",
						"type" => "textarea"
					),
				)
			),
			// five cloumn last
			// four column start
				array(
				"name" => "Four Layout",
				"value" => "fourcolumn_layout",
				"options" => array (
					array(
						"name" => sprintf("%s Content",'column4'),
						"id" => "1",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column4'),
						"id" => "2",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column4'),
						"id" => "3",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => sprintf("%s Content",'column4_last'),
						"id" => "4",
						"default" => "",
						"type" => "textarea"
					),
				)
			),
			// four column end
		),
	),
	// layouts end

		
);				
add_action('admin_menu', 'shortcode_add_box');	
function shortcode_add_box() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		
	add_meta_box( 'kaya-shortcode-meta', 'Shortcode Generator', 'shortcode_show_box', 'post', 'normal', 'high' );
	add_meta_box( 'kaya-shortcode-meta', 'Shortcode Generator', 'shortcode_show_box', 'page', 'normal', 'high' );
	add_meta_box( 'kaya-shortcode-meta', 'Shortcode Generator', 'shortcode_show_box', 'portfolio', 'normal', 'high' );
	}
}

add_action('admin_init','customshortcodemeta_jsscript');

function customshortcodemeta_jsscript(){
wp_enqueue_script('customshortcode_script', get_template_directory_uri() .'/lib/admin/js/kaya_shortcode.js',array('jquery'));
}			
function shortcode_show_box($kaya_shortcodes) {
	global $kaya_shortcodes,$post,$page;
	
	// array values and names
	echo '<div class="sc_shortcodetype"><table  cellspacing="0"><tbody><tr><th style="text-align:right">Shortcode</th><td><select name="shortcodeselect">';
	echo '<option value="">Choose a shortcode...</option>';
	
	foreach($kaya_shortcodes as $shortcode) {
			echo '<option value="'.$shortcode['value'].'">'.$shortcode['name'].'</option>';
	}
	
	echo '</select></td></tr></tbody></table></div>';
	
	foreach($kaya_shortcodes as $shortcode) {
			echo '<div id="shortcode_'.$shortcode['value'].'" class="second_step">';
			// sub values
			if(isset($shortcode['sub'])){
				echo '<div class="shortcode_subtype"><table cellspacing="0"><tbody><th>Type</th><td><select name="kaya_sc_'.$shortcode['value'].'_selector">';
				echo '<option value="">Choose a type</option>';
				foreach($shortcode['options'] as $sub_shortcode) {
					echo '<option value="'.$sub_shortcode['value'].'">'.$sub_shortcode['name'].'</option>';
				}
				echo '</select></td></tr></tbody></table></div>';
				foreach($shortcode['options'] as $sub_shortcode) {
					echo '<div id="sub_sc_'.$sub_shortcode['value'].'" class="sub_second_step"><table cellspacing="0"><tbody>';
					foreach($sub_shortcode['options'] as $option){
						
					echo '<tr>';
					echo '<th scope="row">'.$option['name'].'</th>';
					
					echo '<td>';
					$option['id']='kaya_sc_'.$shortcode['value'].'_'.$sub_shortcode['value'].'_'.$option['id'];
					
					shortcode_show_metabox($option);
					
					echo '</td>';
					echo '</tr>';
                      
					}
					echo '</tbody></table></div>';
				}
			}else{
			    // primary array values
				echo '<table cellspacing="0" class="sc_table"><tbody>';
				foreach($shortcode['options'] as $option){
					echo '<tr>';
					echo '<th scope="row">'.$option['name'].'</th>';
					echo '<td>';
					$option['id']='kaya_sc_'.$shortcode['value'].'_'.$option['id'];
					
					shortcode_show_metabox($option);
					
					echo '</td>';
					echo '</tr>';
					
					
				}
				echo '</tbody></table>';
			}
			
			echo '</div>';
		}
		echo '</div>';
		echo '<div class="button"><input type="button" id="shortcode_sendto_editor" class="button" value="Send to Editor"/></div>';
}


function shortcode_show_metabox($options){
	
	    $out='';
	
		switch($options['type']){
		case 'select':
			$out .= '<select  name="'. $options['id'] .'" id="'. $options['id'] .'" class="kaya-shortcode-input">';
		
			$select_value = get_option($options['id']);
			 
			foreach ($options['options'] as $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($options['std'] == $option) { $selected = ' selected="selected"'; }
				 }
				  
				 $out .= '<option'. $selected .'>';
				 $out .= $option;
				 $out .= '</option>';
			 
			 } 
			 $out .= '</select>';

			
		break;
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($options['std'])) {
				
				$ta_value = $options['std']; 
				
				if(isset($options['options'])){
					$ta_options = $options['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($options['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$out .= '<textarea style="width:400px; height:100px;" class="of-input" name="'. $options['id'] .'" id="'. $options['id'] .'" cols="'. $cols .'" rows="8">'.$meta_box_value.'</textarea>';
			
			
		break;
		case "color":

			$out .= '<div id="' . $opt['id'] . '_picker" class="colorSelector"><div></div></div>';
			$out .= '<input class="of-color" name="'. $opt['id'] .'" id="'. $opt['id'] .'" type="text" />';
		break;   
	
	}
	
	echo $out;
}

?>