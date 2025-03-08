<?php

/* 
======================================================
    Provide Options to User to select five
    categories to be displayed in homepage
======================================================
*/
function pandoratheme_customize_homepage_categories($wp_customize)
{
    // Adding a section in the Customizer
    $wp_customize->add_section('pandora_theme_category_options', array(
        'title' => __('Category Options', 'pandora_theme'),
        'description' => __('Customize category options.', 'pandora_theme'),
        'priority' => 160,
    ));

    // Adding settings and controls for each category select
    for ($i = 1; $i <= 5; $i++) {
        // Setting
        $wp_customize->add_setting("pandora_theme_category_$i", array(
            'default' => '',
            'sanitize_callback' => 'absint', // Ensuring the value is an integer (category ID)
            'type' => 'theme_mod', // or 'option'
        ));

        // Control
        $wp_customize->add_control("pandora_theme_category_$i", array(
            'label' => sprintf(__('Category %s', 'pandora_theme'), $i),
            'section' => 'pandora_theme_category_options',
            'type' => 'select',
            'choices' => pandora_theme_get_category_choices(),
        ));
    }
}

add_action('customize_register', 'pandoratheme_customize_homepage_categories');


// Helper function to get categories in a format that the customizer control expects
function pandora_theme_get_category_choices()
{
    $categories = get_categories(array('hide_empty' => false));
    $choices = array(
        '' => __('Select a Category', 'pandora_theme'), // Default option
    );
    foreach ($categories as $category) {
        $choices[$category->term_id] = $category->name;
    }
    return $choices;
}

