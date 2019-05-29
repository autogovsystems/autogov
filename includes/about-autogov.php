<?php
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/
add_action('init', 'create_autogov_pages'); // Add our HTML5 Blank Custom Post Type

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_autogov_pages()
{
    register_post_type('aboutautogov', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('About Autogov', 'autogov'), // Rename these to suit
            'singular_name' => __('About Autogov', 'autogov'),
            'add_new' => __('Add New', 'autogov'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'autogov'),
            'edit' => __('Edit', 'autogov'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'autogov'),
            'new_item' => __('New HTML5 Blank Custom Post', 'autogov'),
            'view' => __('View HTML5 Blank Custom Post', 'autogov'),
            'view_item' => __('View HTML5 Blank Custom Post', 'autogov'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'autogov'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'autogov'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'autogov')
        ),
        'public' => true,
        'show_ui' => true,
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
    ));
}
