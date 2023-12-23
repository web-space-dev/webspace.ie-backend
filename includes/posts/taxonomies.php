<?php
function registerTaxonomies()
{
    $p = 'Skills';
    $s = 'Skill';
    $slug = 'skills';

    $post_type = 'skills';

    $labels = array(
        'name' => __($p, 'taxonomy general name'),
        'singular_name' => __($s, 'taxonomy singular name'),
        'search_items' =>  __('Search ' . $p),
        'popular_items' => __('Popular ' . $p),
        'all_items' => __('All ' . $p),
        'parent_item' => __('Parent ' . $s . ''),
        'parent_item_colon' => __('Parent ' . $s . ':'),
        'edit_item' => __('Edit ' . $s),
        'update_item' => __('Update ' . $s),
        'add_new_item' => __('Add New ' . $s),
        'new_item_name' => __('New ' . $s),
        'separate_items_with_commas' => __('Separate ' . $p . ' with commas'),
        'add_or_remove_items' => __('Add or remove ' . $p),
        'choose_from_most_used' => __('Choose from the most used ' . $p),
    );

    register_taxonomy($slug, array($post_type), array(
        'label' => __($p),
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'show_in_graphql' => true,
        'graphql_single_name' => 'skillTag',
        'graphql_plural_name' => 'skillTags',
        'rewrite' => array(
            'slug' => $post_type,
            'with_front' => false,
        ),
        //'show_in_menu' => 'resources'
        'capabilities'      => array(
            'manage_terms'  => 'edit_posts',
            'edit_terms'    => 'edit_posts',
            'delete_terms'  => 'edit_posts',
            'assign_terms'  => 'edit_posts'
        )
    ));

    // function filter_post_type_link( $link, $id = 0 ) {
    //     $post = get_post($id);
    //     if ( $post->post_type !== $post_type ){
    //         return $link;
    //     }

    //     if ( $cats = get_the_terms($post->ID,  $slug ) ){
    //         $link = str_replace('%'. $slug .'%', array_pop($cats)->slug, $link);
    //     }

    //     return $link;
    // }
    // add_filter('post_type_link', 'filter_post_type_link', 1,3);

}
