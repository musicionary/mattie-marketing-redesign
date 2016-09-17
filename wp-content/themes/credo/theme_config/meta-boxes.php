<?php 
return array(
	'metaboxes'	=>	array(
		array(
			'id'             => 'event_metabox',            // meta box id, unique per meta box
			'title'          => _x('Event Date & Time','meta boxes','credo'),   // meta box title
			'post_type'      => array('events'),		// post types, accept custom post types as well, default is array('post'); optional
			'taxonomy'       => array(),    // taxonomy name, accept categories, post_tag and custom taxonomies
			'context'		 => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
			'priority'		 => 'high',						// order of meta box: high (default), low; optional
			'input_fields'   => array(          			// list of meta fields 
				'event_start'=> array(
					'name'=> '',
					'type'=>'datetime',
					'std' => time()
				),
			)
		),
		array(
			'id'             => 'page_metabox',            // meta box id, unique per meta box
			'title'          => _x('Page Settings','meta boxes','credo'),   // meta box title
			'post_type'      => array('page'),		// post types, accept custom post types as well, default is array('post'); optional
			'taxonomy'       => array(),    // taxonomy name, accept categories, post_tag and custom taxonomies
			'context'		 => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
			'priority'		 => 'low',						// order of meta box: high (default), low; optional
			'input_fields'   => array(          			// list of meta fields 
				'sidebar_position'=>array(
					'name'=> _x('Sidebar Position','meta boxes','credo'),
					'type'=>'select',
					'values'=>array(
							'full_width'=>_x('No Sidebar/Full Width','meta boxes','credo'),
							'right'=>_x('Right','meta boxes','credo'),
							'left'=>_x('Left','meta boxes','credo'),
					),
				'std'=>'right'  //default value selected
				),
			)
		),

		array(
			'id'             => 'post_metabox',            // meta box id, unique per meta box
			'title'          => _x('Post Settings','meta boxes','credo'),   // meta box title
			'post_type'      => array('post'),		// post types, accept custom post types as well, default is array('post'); optional
			'taxonomy'       => array(),    // taxonomy name, accept categories, post_tag and custom taxonomies
			'context'		 => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
			'priority'		 => 'low',						// order of meta box: high (default), low; optional
			'input_fields'   => array(            			// list of meta fields 
				'sidebar_position'=>array(
					'name'=> _x('Sidebar Position','meta boxes','credo'),
					'type'=>'select',
					'values'=>array(
							'as_blog'=>_x('Same as Blog Page','meta boxes','credo'),
							'full_width'=>_x('No Sidebar/Full Width','meta boxes','credo'),
							'right'=>_x('Right','meta boxes','credo'),
							'left'=>_x('Left','meta boxes','credo'),
						),
					'std'=>'as_blog'  //default value selected
					)
				)
			),
		),
	);