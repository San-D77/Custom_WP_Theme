<?php
function create_gallery_post_type()
{
    register_post_type(
        'gallery',
        array(
            'labels'      => array(
                'name'          => __('Galleries', 'textdomain'),
                'singular_name' => __('Gallery', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'galleries'),
            'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon'   => 'dashicons-format-gallery',
        )
    );
}
add_action('init', 'create_gallery_post_type');
