<?php

// Add custom columns to the Skills list page
function set_custom_edit_skill_columns($columns)
{
    $columns['skill_category'] = __('Skill Category', 'text_domain');
    return $columns;
}
add_filter('manage_skill_posts_columns', 'set_custom_edit_skill_columns');

// Make the custom column sortable
function custom_skill_sortable_columns($columns)
{
    $columns['skill_category'] = 'skill_category';
    return $columns;
}
add_filter('manage_edit-skill_sortable_columns', 'custom_skill_sortable_columns');


// Add sorting functionality for the custom column
function custom_skill_orderby($query)
{
    if (!is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');
    if ('skill_category' == $orderby) {
        $query->set('meta_key', 'skill_category');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'custom_skill_orderby');

// Populate the custom column with the Skills category
function custom_skill_column($column, $post_id)
{
    switch ($column) {
        case 'skill_category':
            $terms = get_the_terms($post_id, 'skill_category');
            if (!empty($terms)) {
                foreach ($terms as $term) {
                    echo esc_html($term->name) . ' ';
                }
            } else {
                _e('No Skill Category', 'text_domain');
            }
            break;
    }
}
add_action('manage_skill_posts_custom_column', 'custom_skill_column', 10, 2);

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
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'show_in_graphql' => true,
        'graphql_single_name' => 'skill',
        'graphql_plural_name' => 'skills',
        'menu_icon'           => 'dashicons-shortcode', // Change this to the Dashicon you want
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );

    register_post_type('skill', $args);
}

// Register custom taxonomy for Skills
function create_skill_taxonomy()
{
    $args = array(
        'label' => __('Categories', 'text_domain'),
        'rewrite' => array('slug' => 'skill-category'),
        'hierarchical' => true,
        'show_in_graphql' => true, // Make taxonomy available in GraphQL
        'graphql_single_name' => 'skillCategory', // Single name for GraphQL
        'graphql_plural_name' => 'skillCategories', // Plural name for GraphQL
    );
    register_taxonomy('skill_category', 'skill', $args);
}

add_action('init', 'custom_skill_post_type', 0);
add_action('init', 'create_skill_taxonomy');
