<?php
add_action('init', 'create_thiscommunity_pages'); // Add our HTML5 Blank Custom Post Type
add_action( 'init', 'create_aboutcommunity_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_aboutcommunity_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories community', 'taxonomy general name', 'autogov' ),
		'singular_name'     => _x( 'Category community', 'taxonomy singular name', 'autogov' ),
		'search_items'      => __( 'Search Categories community', 'autogov' ),
		'all_items'         => __( 'All Categories community', 'autogov' ),
		'parent_item'       => __( 'Parent Category community', 'autogov' ),
		'parent_item_colon' => __( 'Parent Categories community:', 'autogov' ),
		'edit_item'         => __( 'Edit Category community', 'autogov' ),
		'update_item'       => __( 'Update Category community', 'autogov' ),
		'add_new_item'      => __( 'Add New Category community', 'autogov' ),
		'new_item_name'     => __( 'New Category community Name', 'autogov' ),
		'menu_name'         => __( 'Categories community', 'autogov' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'about' ),
	);

	register_taxonomy( 'aboutcommunity', array( 'aboutcommunity' ), $args );
}


// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_thiscommunity_pages()
{
    register_post_type('aboutcommunity', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('About community', 'autogov'), // Rename these to suit
            'singular_name' => __('About community', 'autogov'),
            'add_new' => __('Add New', 'autogov'),
            'add_new_item' => __('Add New About this community Post', 'autogov'),
            'edit' => __('Edit', 'autogov'),
            'edit_item' => __('Edit About this community Post', 'autogov'),
            'new_item' => __('New About this community Post', 'autogov'),
            'view' => __('View About this community Post', 'autogov'),
            'view_item' => __('View About this community Post', 'autogov'),
            'search_items' => __('Search About this community Post', 'autogov'),
            'not_found' => __('No About this community posts found', 'autogov'),
            'not_found_in_trash' => __('No About this community Posts found in Trash', 'autogov')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-page',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array('aboutcommunity')
    ));
}
