<?php
// Slider Fields
$prefix = '';
$meta_boxes['slider'] = array(

	'id' => 'my-meta-box1',

	'title' => 'Slider Page Title Options',

	'pages' => 'slider',

	'context' => 'normal',

	'priority' => 'high',

	'fields' => array(
	
	
	
	array(

			'name' => 'Custom link',

			'desc' => 'Add Custom Link Like: http://www.Yourdomain.com',

			'id' => $prefix . 'customlink',

			'type' => 'text',

			'std' => ''

		),
			array(

			'name' => 'Video',

			'desc' => 'Paste Your embed Video Code Here Ex: &lt;iframe src=&quot;http://player.vimeo.com/video/20174757?title=0&byline=0&portrait=0" width="960" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen&gt;&lt;/iframe&gt;',

			'id' => $prefix . 'sudo_video',

			'type' => 'textarea',

			'std' => ''

		),
	
		array(
			'name' => 'Enable Comment Section',
			'desc' => 'Check the box to enable the Comments on this page, <em>Note: Bydefault the comments are disabled for Slider Pages.</em>',
			'id' => $prefix . 'commentsection',
			'type' => 'checkbox',
			'std' => ''
		),
		

		
	)

);