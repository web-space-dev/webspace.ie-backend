<?php

// Register Custom Post Type
function custom_skill_post_type()
{
    $labels = array(
        'name' => _x('Skills', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Skill', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Skills', 'text_domain'),
        'all_items' => __('All Skills', 'text_domain'),
        'view_item' => __('View Skill', 'text_domain'),
        'add_new_item' => __('Add New Skill', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'edit_item' => __('Edit Skill', 'text_domain'),
        'update_item' => __('Update Skill', 'text_domain'),
        'search_items' => __('Search Skills', 'text_domain'),
        'not_found' => __('Not Found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
    );

    $args = array(
        'label' => __('skill', 'text_domain'),
        'description' => __('Skills Description', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies' => array('skill_category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'show_in_graphql' => true,
        'menu_icon'           => 'dashicons-shortcode', // Change this to the Dashicon you want
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );

    register_post_type('skill', $args);
}
add_action('init', 'custom_skill_post_type', 0);

// Register Custom Taxonomy
function custom_skill_taxonomy()
{
    $labels = array(
        'name' => _x('Skill Categories', 'Taxonomy General Name', 'text_domain'),
        'singular_name' => _x('Skill Category', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name' => __('Skill Categories', 'text_domain'),
        'all_items' => __('All Skill Categories', 'text_domain'),
        'parent_item' => __('Parent Skill Category', 'text_domain'),
        'parent_item_colon' => __('Parent Skill Category:', 'text_domain'),
        'new_item_name' => __('New Skill Category Name', 'text_domain'),
        'add_new_item' => __('Add New Skill Category', 'text_domain'),
        'edit_item' => __('Edit Skill Category', 'text_domain'),
        'update_item' => __('Update Skill Category', 'text_domain'),
        'view_item' => __('View Skill Category', 'text_domain'),
        'separate_items_with_commas' => __('Separate skill categories with commas', 'text_domain'),
        'search_items' => __('Search Skill Categories', 'text_domain'),
        'add_or_remove_items' => __('Add or remove skill categories', 'text_domain'),
        'choose_from_most_used' => __('Choose from the most used skill categories', 'text_domain'),
        'popular_items' => __('Popular Skill Categories', 'text_domain'),
        'not_found' => __('Not Found', 'text_domain'),
        'no_terms' => __('No skill categories', 'text_domain'),
        'items_list' => __('Skill Categories list', 'text_domain'),
        'items_list_navigation' => __('Skill Categories list navigation', 'text_domain'),
    );

    $args = array(
        'label'               => __('skill', 'text_domain'),
        'description'         => __('Skills Description', 'text_domain'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail', 'custom-fields'),
        'taxonomies'          => array('skill_category'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'register_meta_box_cb' => 'custom_skill_add_logo_meta_box',
    );

    register_taxonomy('skill_category', array('skill'), $args);
}
add_action('init', 'custom_skill_taxonomy', 0);
