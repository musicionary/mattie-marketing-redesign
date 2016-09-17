<?php

return array(
	'events' => array(
		'name' => 'Events',
		'term' => 'event',
		'term_plural' => 'events',
		'order' => 'DESC',
		'post_options' => array('supports'=> array( 'title','editor','thumbnail')),
		'options' => array(
			'event_cover' => array(
				'type' => 'image',
				'description' => 'Event item cover/thumbnail (shown in the Event grids). If you use Event with columns you can upload smaller resolution images for the grid for a better website optimization',
				'title' => 'Image',
				'default' => 'holder.js/800x800/auto'
			),
		
			'event_location' => array(
				'type' => 'line',
				'description' => 'Provide here location of the event',
				'title' => 'Location',
			),

			'event_coordinates' => array(
				'type' => 'line',
				'description' => 'Provide here google map coordinates of the event in this format "lat,long" <br/><br/>
				Get the coordinates of a place you find on the map with your browser, like Chrome, Firefox, or Internet Explorer. <br/>
				1. Open <a href="https://maps.google.com/" target="_blank">Google Maps</a>.<br/>
				2. Right-click the place or area on the map.<br/>
				3. Select <b>Whats here?</b> <br/> 
				4. A card appears at the bottom of the screen with more info.',
				'title' => 'Map Coordinates',
			),

			'event_pin' => array(
				'type' => 'image',
				'title' => 'Custom Pin',
				'default' => 'holder.js/50x50/auto',
				'If you want to use a custom pin for google map, you can upload it here.'
			),

		),
		'icon' => 'icons/favicon.png',
		'output' => array(
			'main' => array(
				'shortcode' => 'tt_events',
				'view' => 'views/event-view',
				'shortcode_defaults' => array(
					'category' => '',
					'shortcode_type'	=>	'1',
					'nr'			=>	'5000',
					'columns'		=>	'3',
					'show_calendar'		=> 'yes',
					'page_url'	=> '',
					'el_class' => '', 
				)
			),	
		)
	),

	'sermons' => array(
		'name' => 'Sermons',
		'term' => 'sermon',
		'term_plural' => 'Sermons',
		'order' => 'DESC',
		'has_single' => true,
		'post_options' => array('supports'=> array( 'title','editor','thumbnail','post-formats')),
		'options' => array(
			'sermon_cover' => array(
				'type' => 'image',
				'description' => 'Insert Sermon Background Image',
				'title' => 'Background Image',
				'default' => 'holder.js/1920x1000/auto'
			),

			'sermon_thumb' => array(
				'type' => 'image',
				'description' => 'Sermon item thumbnail (shown in the Sermons grids). If you use Sermons with small columns you can upload smaller resolution images for the grid for a better website optimization',
				'title' => 'Thumbnail',
				'default' => 'holder.js/300x200/auto'
			),

			'sermon_speaker' => array(
				'type' => 'line',
				'description' => 'Provide here sermon author',
				'title' => 'Author',
			),

		),
		'icon' => 'icons/favicon.png',
		'output' => array(
			'main' => array(
				'shortcode' => 'tt_sermons',
				'view' => 'views/sermons-view',
				'shortcode_defaults' => array(
					'category' => '',
					'nr' =>	'',
					'columns' => '3',
					'el_class' => '',
				)
			),
			'single' => array(
				'view' => 'views/sermon-single-view',
				'shortcode_defaults' => array(

				)
			),	
		)
	),
);