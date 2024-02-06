<?php

// Register Custom Post Type
function custom_project_post_type()
{
    $labels = array(
        'name' => _x('Projects', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Project', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Projects', 'text_domain'),
        'all_items' => __('All Projects', 'text_domain'),
        'view_item' => __('View Project', 'text_domain'),
        'add_new_item' => __('Add New Project', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'edit_item' => __('Edit Project', 'text_domain'),
        'update_item' => __('Update Project', 'text_domain'),
        'search_items' => __('Search Projects', 'text_domain'),
        'not_found' => __('Not Found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
    );

    $args = array(
        'label' => __('project', 'text_domain'),
        'description' => __('Projects Description', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'taxonomies' => array('post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'show_in_graphql' => true,
        'graphql_single_name' => 'project',
        'graphql_plural_name' => 'projects',
        'menu_icon'           => 'dashicons-edit', // Change this to the Dashicon you want
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );

    register_post_type('project', $args);
}

// Register custom taxonomy for Projects
function create_project_taxonomy()
{
    $args = array(
        'label' => __('Categories', 'text_domain'),
        'rewrite' => array('slug' => 'project-category'),
        'hierarchical' => true,
    );
    register_taxonomy('project_category', 'project', $args);
}

add_action('init', 'custom_project_post_type', 0);
add_action('init', 'create_project_taxonomy');
