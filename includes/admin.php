<?php
/**
 * WP Admin Customization
*/
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png) !important;
			height: 66px !important;
			width: auto !important;
			background-size: contain !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login',  get_stylesheet_directory_uri() . '/css/style-login.css', array(), filemtime( get_stylesheet_directory().'/css/style-login.css' ), 'all');
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
?>