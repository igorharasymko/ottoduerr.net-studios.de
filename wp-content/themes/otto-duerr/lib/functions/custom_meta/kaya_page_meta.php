<?php
 $prefix = '';
// Page Fields
 $meta_boxes['page']= array(
	'id' => 'my-meta-box',
	'title' => 'Page Title Options',
	'pages' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Sub Header Background Image',
			'desc' => 'Upload "Subheader" image, which displays just bellow the top main header.',
			'id' => $prefix . 'kaya_subheaderbg_image',
			'type' => 'upload',
			'std' => ''
		),
		
		array(
			'name' => 'Page Custom Text',
			'desc' => 'Enter Custom short Description for this page',
			'id' => $prefix . 'kaya_pagedesc',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Choose Page Title Display Style',
			'desc' => 'Select Page Title.',
			'id' => $prefix . 'subheader_titleoptions',
			'type' => 'radio',
			'options' => array("title" => "Title Only", "customtext" => "Customtext Only", 'titlecustomtext'=>'Title & Customtext','disable'=>'Disable'),
			'std' => 'title'
		),

	)
);