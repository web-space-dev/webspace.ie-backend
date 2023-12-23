<?php

/**
 * Updates all terms within a post type
 * 
 * Takes in a plural and singular of the word to use
 */
function nameLabels($p, $s)
{
  $labels = array(
    'name' => __($p, 'textdomain'),
    'singular_name' => __($s, 'textdomain'),
    'search_items' =>  __('Search ' . $p),
    'popular_items' => __('Popular ' . $p),
    'all_items' => __('All ' . $p),
    'parent_item' => __('Parent ' . $s),
    'parent_item_colon' => __('Parent ' . $s . ':'),
    'edit_item' => __('Edit ' . $s),
    'update_item' => __('Update ' . $s),
    'add_new_item' => __('Add New ' . $s),
    'new_item_name' => __('New $s Name'),
    'separate_items_with_commas' => __('Separate ' . $p . ' with commas'),
    'add_or_remove_items' => __('Add or remove ' . $p),
    'choose_from_most_used' => __('Choose from the most used ' . $p),
    'menu_name' => __($p),
  );

  return $labels;
}

function registerTypes()
{
  /**
   * Change default post name to News
   */
  $get_post_type = get_post_type_object('post');
  $labels = $get_post_type->labels;
  $labels->name = 'News';
  $labels->singular_name = 'News';
  $labels->add_new = 'Add News';
  $labels->add_new_item = 'Add News';
  $labels->edit_item = 'Edit News';
  $labels->new_item = 'News';
  $labels->view_item = 'View News';
  $labels->search_items = 'Search News';
  $labels->not_found = 'No News found';
  $labels->not_found_in_trash = 'No News found in Trash';
  $labels->all_items = 'All News';
  $labels->menu_name = 'News';
  $labels->name_admin_bar = 'News';

  /**
   * Register skill post type
   */
  register_post_type(
    'skill',
    [
      'labels' => nameLabels('Skill', 'Skill'),
      'public' => true,
      'show_in_rest_api' => true,
      'exclude_from_search' => false,
      'hierarchical' => true,
      'menu_position' => 27,
      'show_in_graphql' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'graphql_single_name' => 'skill_item',
      'graphql_plural_name' => 'skill_items',
      'taxonomies' => array('sections'),
      'menu_icon' => 'dashicons-clipboard',
      // 'rewrite' => ['slug' => 'skill'],
      'capability_type' => 'post',
      'has_archive' => 'sections',
      'rewrite' => array('slug' => 'skill/%sections%', 'with_front' => false),
      'supports' => ['title', 'editor', 'page-attributes', 'revisions', 'thumbnail'],
    ]
  );

  /**
   * Set admin stickies for the 'foodmenu' custom post type 
   */
  // add_action('init', function () {
  //   if (function_exists('wpse_cpt_stickies'))
  //     wpse_cpt_stickies($cpt = 'skill', $ids = array(629));
  // });

  // Add taxonmy to slug
  function wpa_show_permalinks($post_link, $post)
  {


    if (/* is_object( $post ) &&*/$post->post_type == 'skill') {
      $terms = wp_get_object_terms($post->ID, 'sections');
      if ($terms) {
        return str_replace('%' . 'sections' . '%', $terms[0]->slug, $post_link);
      }
    }
    return $post_link;
  }
  add_filter('post_type_link', 'wpa_show_permalinks', 1, 2);

  /**
   * Register Board post type
   */
  register_post_type(
    'board',
    [
      'labels' => nameLabels('Board Members', 'Board Member'),
      'public' => true,
      'show_in_rest_api' => true,
      'exclude_from_search' => false,
      'has_archive' => false,
      'hierarchical' => true,
      'menu_position' => 29,
      'show_in_graphql' => true,
      'graphql_single_name' => 'board_item',
      'graphql_plural_name' => 'board_items',
      'menu_icon' => 'dashicons-businessperson',
      'rewrite' => ['slug' => 'board-member'],
      'supports' => ['title', 'page-attributes', 'revisions'],
    ]
  );
}
