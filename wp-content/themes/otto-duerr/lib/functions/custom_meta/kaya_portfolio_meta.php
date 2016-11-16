<?php
$prefix = '';
// Portfolio Fields
$meta_boxes['portfolio'] = array(

	'id' => 'my-meta-box1',

	'title' => 'Portfolio Page Options',

	'pages' => 'portfolio',

	'context' => 'normal',

	'priority' => 'high',

	'fields' => array(
		
		array(

			'name' => 'Video',
		    'desc' => 'Paste src Video code here Ex: <strong>http://www.youtube.com/embed/1iIZeIy7TqM</strong>',
			'id' => $prefix . 'video',
			'type' => 'textarea',
			'std' => ''

		),

		array(
			'name' => 'Enable Comment Section',
			'desc' => 'Check the box to enable the Comments on this page, <em>Note: Bydefault the comments are disabled for Portfolio Pages.</em>',
			'id' => $prefix . 'commentsection',
			'type' => 'checkbox',
			'std' => ''
		),
		

	)

);