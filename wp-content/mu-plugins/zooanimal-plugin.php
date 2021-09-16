<?php

	function zooanimal_post_types() {
		
		//Event post type
		register_post_type('event', array(
			'supports'=>array('title','editor','excerpt'),
			'rewrite' => array('slug' => 'events'),
			'has_archive' => true,
			'public' => true,
			'labels' => array(
				'name' => 'Events',
				'add_new_item' => 'Add New Event',
				'edit_item' => 'Edit Event',
				'all_items' => 'All Events',
				'singular_name' => 'Event'
			),
			'menu_icon' => 'dashicons-calendar-alt'
		));
		
		//Captivity post type
		register_post_type('captivity', array(
			'supports'=>array('title','editor','excerpt'),
			'rewrite' => array('slug' => 'captivities'),
			'has_archive' => true,
			'public' => true,
			'labels' => array(
				'name' => 'Captivities',
				'add_new_item' => 'Add New Captivity',
				'edit_item' => 'Edit Captivity',
				'all_items' => 'All Captivity',
				'singular_name' => 'Captivity'
			),
			'menu_icon' => 'dashicons-groups'
		));
		
		//Animal post type
		register_post_type('animal', array(
			'supports'=>array('title','editor','excerpt'),
			'rewrite' => array('slug' => 'animals'),
			'public' => true,
			'labels' => array(
				'name' => 'Animals',
				'add_new_item' => 'Add New Animal',
				'edit_item' => 'Edit Animal',
				'all_items' => 'All Animals',
				'singular_name' => 'Animal'
			),
			'menu_icon' => 'dashicons-awards'
		));
		
		//Ticket post type
		register_post_type('ticket', array(
			'capability_type'=>'ticket',
			'map_meta_cap'=>true,
			'supports'=>array('title'),
			'public' => false,
			'show_ui'=>true,
			'labels' => array(
				'name' => 'Tickets',
				'add_new_item' => 'Add New Ticket',
				'edit_item' => 'Edit Ticket',
				'all_items' => 'All Tickets',
				'singular_name' => 'Ticket'
			),
			'menu_icon' => 'dashicons-tag'
		));
		
	}
	
	add_action('init', 'zooanimal_post_types');