<?php

/* 
    ======================================================
        Include Theme Support
    ======================================================
*/

function pandoratheme_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}


add_action('after_setup_theme', 'pandoratheme_theme_support');

/* 
    ======================================================
        Register navigation menus
    ======================================================
*/

function pandoratheme_menus()
{
    $locations = array(
        'primary' => "Main Navigation Menu",
        'footer' => "Footer Menu"
    );

    register_nav_menus($locations);
}


add_action('init', 'pandoratheme_menus');

/* 
======================================================
    Remove default stylesheets from wordpress
======================================================
*/

function remove_default_styles()
{
    wp_dequeue_style('wp-block-library'); // Remove block library styles
    wp_dequeue_style('wp-block-library-theme'); // Remove block library theme styles
    wp_dequeue_style('dashicons'); // Remove dashicons, which are used in the WordPress admin
    wp_dequeue_style('classic-theme-styles'); // Remove classic theme styles
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_default_styles');

/* 
    ======================================================
        Register custom CSS files
    ======================================================
*/

function pandoratheme_register_styles()
{

    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('pandoratheme-style', get_template_directory_uri() . "/style.css", array('pandoratheme-bootstrap'), $version, 'all');

    wp_enqueue_style('pandoratheme-bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.min.css", array(), '5.2.1', 'all');

    if (is_home()) {
        wp_enqueue_style('pandoratheme-homepage', get_template_directory_uri() . "/assets/css/homepage.css", array(), '5.0.1', 'all');
        wp_enqueue_style('pandoratheme-splide', get_template_directory_uri()."/assets/css/splide.css",array(),'5.0.1','all');
        
    }

    if (is_single()) {
        if (has_category('players')) {
            // Enqueue the 'players.css' file for posts in the 'players' category
            wp_enqueue_style('pandoratheme-single-players', get_template_directory_uri() . "/assets/css/players.css", array(), $version, 'all');
        } else {
            // Enqueue the 'articles.css' file for posts in other categories
            wp_enqueue_style('pandoratheme-single-article-page', get_template_directory_uri() . "/assets/css/article.css", array(), $version, 'all');
        }
    }
    if (is_page()) {
        wp_enqueue_style('pandoratheme-single-article-page', get_template_directory_uri() . "/assets/css/article.css", array(), $version, 'all');
    }

    if (is_archive()) {
        wp_enqueue_style('pandoratheme-category', get_template_directory_uri() . "/assets/css/category.css", array(), '5.0.1', 'all');
    }
    global $wp_query;
    if (isset($wp_query->query_vars['fact_key']) && isset($wp_query->query_vars['fact_value'])) {
        wp_enqueue_style('pandoratheme-category', get_template_directory_uri() . "/assets/css/category.css", array(), '5.0.1', 'all');

        wp_dequeue_style('pandoratheme-homepage');
        // wp_dequeue_style('pandoratheme-splide');
    }

    if (is_search()) {
        wp_enqueue_style('pandoratheme-search-page', get_template_directory_uri() . "/assets/css/search.css", array(), $version, 'all');
    }
}

add_action('wp_enqueue_scripts', 'pandoratheme_register_styles');




/* 
    ======================================================
        Register custom Javascript files
    ======================================================
*/

function pandoratheme_register_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('pandoratheme-splide', get_template_directory_uri() . "/assets/js/splide.min.js", array(), '1.0', true);
    wp_enqueue_script('pandoratheme-script', get_template_directory_uri() . "/assets/js/script.min.js", array(), '1.0', true);

    if (is_single()) {
        wp_enqueue_script('pandoratheme-article', get_template_directory_uri() . "/assets/js/article.min.js", array(), '1.0', true);
    }
}

add_action('wp_enqueue_scripts', 'pandoratheme_register_scripts');

/* 
    ======================================================
        Register custom scripts for gallery
    ======================================================
*/


/* 
    ======================================================
        Include helper files
    ======================================================
*/
require get_template_directory() . '/inc/walker.php';
require get_template_directory() . '/inc/custom_post_types.php';
require get_template_directory() . '/inc/inside_post_gallery_feature.php';
require get_template_directory() . '/inc/alter_items_default_display.php';
require get_template_directory() . '/inc/custom_utility_shortcodes.php';
require get_template_directory() . '/inc/theme_customizer.php';



