<?php

require_once(__DIR__ . '/includes/posts/skills.php');
// require_once(__DIR__ . '/includes/email/email.php');

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

if (!function_exists('webspace_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function webspace_setup()
    {
        // registerTypes();
        // registerTaxonomies();
    }
}




function theme_setup()
{
    add_theme_support('post-thumbnails');

    /*** Register Menus */
    if (function_exists('register_nav_menus')) {
        register_nav_menus(
            array(
                'main-menu'         => __('Main Menu', 'site'),
                'footer-menu'       => __('Footer Menu', 'site'),
            )
        );
    }
}




add_action('init', 'webspace_setup');
add_action('after_setup_theme', 'theme_setup');


// add_action('admin_head', 'admin_js');
