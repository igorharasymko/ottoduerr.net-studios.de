<?php
// Post Fields
 $prefix = '';
$meta_boxes['post']= array(

	'id' => 'post-meta-box1',

	'title' => 'Post Title Options',

	'pages' => 'post',

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
			'name' => 'Page Title Description',
			'desc' => 'Enter Page Title Description',
			'id' => $prefix . 'kaya_pagedesc',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Choose Page Title Display Style',
			'desc' => '',
			'id' => $prefix . 'subheader_titleoptions',
			'type' => 'radio',
			'options' => array("title" => "Title Only", "customtext" => "Customtext", 'titlecustomtext'=>'Title & Customtext','disable'=>'Disable'),
			'std' => 'title'
		),
		
		array(
			'name' => 'Disable Comments section',
			'desc' => 'Check the box to disable the comments on this page.',
			'id' => $prefix . 'commentsection',
			'type' => 'checkbox',
			'std' => ''
		),


	)

);
?>