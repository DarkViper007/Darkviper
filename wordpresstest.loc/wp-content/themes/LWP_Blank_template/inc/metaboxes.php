<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = THEME_OPT;

if ( !function_exists( "redux_add_metaboxes" ) ):
	function redux_add_metaboxes($metaboxes) {
	
	$page_options = array();

	$metaSection = array(
		'title' => 'Page meta',
		'icon_class'    => 'icon-large',
		'icon'          => 'el-icon-list-alt',
		'fields' => array(
			array(
				'id'     => 'meta',
				'type'   => 'text',
				'title'  => __( 'Metafield')
			),
		)

	);

	$slides = array(
		'title' => 'Page meta slides',
		'icon_class'    => 'icon-large',
		'icon'          => 'el-icon-list-alt',
		'fields' => array(
			array(
				'id'     => 'opt-slides',
				'type'   => 'slides',
				'title'  => __( 'Slides Options'),
				'subtitle'    => __('Unlimited slides with drag and drop sortings.'),
				'placeholder' => array(
        			'title'           => __('This is a title'),
        			'description'     => __('Description Here'),
        			
    				)
			),
		)

	);
	$slides2 = array(
		'title' => 'Page meta slides2',
		'icon_class'    => 'icon-large',
		'icon'          => 'el-icon-list-alt',
		'fields' => array(
			array(
				'id'     => 'opt-slides2',
				'type'   => 'slides',
				'title'  => __( 'Slides2 Options'),
				'subtitle'    => __('Unlimited slides with drag and drop sortings.'),
				'placeholder' => array(
        			'title'           => __('This is a title'),
        			'description'     => __('Description Here'),
        			
    				)
			),
		)

	);
	
// 	$slides = array(
//     'id'          => 'opt-slides',
//     'type'        => 'slides',
//     'title'       => __('Slides Options'),
//     'subtitle'    => __('Unlimited slides with drag and drop sortings.'),
//     'desc'        => __('This field will store all slides values into a multidimensional array to use into a foreach loop.')
//     'placeholder' => array(
//         'title'           => __('This is a title'),
//         'description'     => __('Description Here'),
//         'url'             => __('Give us a link!')
//     ),
// );
	
	$page_options[] = $metaSection;
	$page_options[] = $slides;
	$page_options[] = $slides2;
	$metaboxes[] = array(
		'id'            => 'page-options',
		'title'         => __( 'Page options', THEME_OPT ),
		'post_types'    => array( 'page' ),
		'page_template' => array('home.php'),
		'position'      => 'normal', // normal, advanced, side
		'priority'      => 'high', // high, core, default, low
		'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		'sections'      => $page_options,
	);

	return $metaboxes;
  }
  add_action("redux/metaboxes/{$redux_opt_name}/boxes", 'redux_add_metaboxes');
endif;

