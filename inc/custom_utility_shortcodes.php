<?php

/* 
    ======================================================
      Calculate age or time duration
    ======================================================
*/
function calculate_age($atts)
{
    // Extract attributes (in this case, 'birthdate')
    extract(shortcode_atts(array(
        'birthdate' => ''
    ), $atts));

    // Check if a valid birthdate is provided
    if (empty($birthdate) || !strtotime($birthdate)) {
        return 'Invalid or missing birthdate.';
    }

    // Calculate the age
    $birth_date = new DateTime($birthdate);
    $today = new DateTime();
    $age = $today->diff($birth_date)->y;

    return $age;
}
add_shortcode('calculate_age', 'calculate_age');

/* 
    ======================================================
      To use the current year
    ======================================================
*/
function write_full_year_shortcode()
{
    $current_year = date('Y');
    return "$current_year";
}
add_shortcode('write_year', 'write_full_year_shortcode');

/* 
    ======================================================
      To use current year and month
    ======================================================
*/
function write_year_and_month_shortcode()
{
    $current_year = date('Y');
    $current_month = date('F');
    return "$current_month $current_year";
}
add_shortcode('write_year_and_month', 'write_year_and_month_shortcode');

/* 
    ======================================================
       Gallery Shortcode to insert gallery inside a post
    ======================================================
*/
function pandoratheme_gallery_feature_shortcode($atts)
{
    // Extract the attributes passed to the shortcode
    $atts = shortcode_atts(
        array(
            'url' => '', // Expecting a URL instead of an ID now
        ),
        $atts,
        'gallery_feature'
    );

    // Check if a URL is provided
    if (empty($atts['url'])) {
        return 'Gallery URL is required.';
    }

    // Get the post ID based on the URL
    $post_id = url_to_postid($atts['url']);

    // Check if a valid post ID was found
    if (!$post_id) {
        return 'No gallery found for this URL.';
    }

    // Get the URL of the featured image
    $featured_img_url = get_the_post_thumbnail_url($post_id, 'full');

    // Check if the featured image exists
    if (!$featured_img_url) {
        return 'No featured image found for this gallery.';
    }

    // Return the HTML for the clickable image
    $html = '<div data-post-url="' . $atts['url'] . '" class="gallery-feature-link">';
    $html .= '<div class="gallery-wrap">
        <img loading="lazy" src="' . esc_url($featured_img_url) . '" alt="" style="cursor:pointer;">
        <div class="content-wrap">
            <span class="title">' . get_the_title($post_id) . '</span>
            <span class="launch-gallery">Click to View Images
                <svg role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#fff" d="M12 22C6.5 22 2 12 2 12s6.5-10 10-10v.7c-5.1 0-9.3 4.15-9.3 9.3 0 5.1 4.15 9.3 9.3 9.3s9.3-4.15 9.3-9.3c0-5.1-4.15-9.3-9.3-9.3V2c5.5 0 10 4.5 10 10s-4.5 10-10 10zm-2-12h6v6h-6v-6zm4-1H9v5H8V8h6v1z"></path>
                </svg>
            </span>
        </div>
    </div>';
    $html .= '</div>';

    return $html;
}

add_shortcode('gallery_feature', 'pandoratheme_gallery_feature_shortcode');


/* 
    ======================================================
       Also Read Short code to insert also read post
       inside a post
    ======================================================
*/

function pandoratheme_also_read_shortcode($atts)
{
    // Extract the attributes passed to the shortcode
    $atts = shortcode_atts(
        array(
            'url' => '', // Expecting a URL instead of an ID now
            'title' => '', // Optional custom title
        ),
        $atts,
        'also_read'
    );

    // Check if a URL is provided
    if (empty($atts['url'])) {
        return 'Also read post URL is required.';
    }

    // Get the post ID based on the URL
    $post_id = url_to_postid($atts['url']);

    // Check if a valid post ID was found
    if (!$post_id) {
        return 'No post found for this URL.';
    }

    // Get the URL of the featured image
    $featured_img_url = get_the_post_thumbnail_url($post_id, 'full');

    // Check if the featured image exists
    if (!$featured_img_url) {
        return 'No featured image found for this post.';
    }

    // Get the title to display
    $display_title = !empty($atts['title']) ? $atts['title'] : get_the_title($post_id);

    // Generate the HTML output
    $html = '<div class="also-read-section">';
    $html .= '<a href="' . esc_url($atts['url']) . '" class="also-read-link"><div class="also-read-wrap">';
    $html .= '<div class="also-read-img-div"><img height="450" width="250" loading="lazy" src="' . esc_url($featured_img_url) . '" alt="' . esc_attr($display_title) . '" class="also-read-img"></div>';
    $html .= '<div class="also-read-content">';
    $html .= '<span class="also-read-title"> <span class="also-read-trigger">Don\'t Miss: </span>' . esc_html($display_title) . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</a></div>';

    return $html;
}

add_shortcode('also_read', 'pandoratheme_also_read_shortcode');


function display_random_posts_by_tag_or_category($atts)
{
    // Extract the tag or category name from the shortcode attributes
    $atts = shortcode_atts(
        array(
            'tag' => '',
            'category' => '',
        ),
        $atts,
        'random_posts'
    );

    $tag_name = sanitize_text_field($atts['tag']);
    $category_name = sanitize_text_field($atts['category']);
    $current_post_id = get_the_ID();

    // Initialize an empty array to store query arguments
    $query_args = array(
        'posts_per_page' => 5,
        'orderby'        => 'rand',
        'post__not_in'   => array($current_post_id), // Exclude the current post
    );

    // Check if a tag name is provided and fetch its slug
    if (!empty($tag_name)) {
        $tag = get_term_by('name', $tag_name, 'post_tag');
        if ($tag) {
            $query_args['tag'] = $tag->slug;
        } else {
            return '<p>No related posts found. Tag not found.</p>';
        }
    }
    // Check if a category name is provided and fetch its slug
    elseif (!empty($category_name)) {
        $category = get_term_by('name', $category_name, 'category');
        if ($category) {
            $query_args['category_name'] = $category->slug;
        } else {
            return '<p>No related posts found. Category not found.</p>';
        }
    }

    // Query the posts based on the arguments
    $query = new WP_Query($query_args);

    // Check if any posts were found
    if ($query->have_posts()) {
        $output = '<aside class="more-read">';
        $output .= '<span>Don\'t Miss</span>';
        $output .= '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<li><a href="' . get_permalink() . '" target="_blank">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
        $output .= '</aside>';
        wp_reset_postdata(); // Reset the global post data
    } else {
        $output = '<p>No related posts found.</p>';
    }

    return $output;
}

// Register the shortcode
add_shortcode('random_posts', 'display_random_posts_by_tag_or_category');


/**
 * ==================================================================================
 *  Read in Nepali shortcode
 * ==================================================================================
 * 
*/
function read_in_nepali_button_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'url' => '',  // URL for the Nepali version of the article
        ),
        $atts,
        'read_in_nepali'
    );

    if (empty($atts['url'])) {
        return '';  // If no URL, output nothing
    }

    return '<a href="' . esc_url($atts['url']) . '" class="floating-nepali-button" >नेपालीमा पढ्नुहाेस्</a>';
}
add_shortcode('read_in_nepali', 'read_in_nepali_button_shortcode');

function read_in_english_button_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'url' => '',  // URL for the English version of the article
        ),
        $atts,
        'read_in_english'
    );

    if (empty($atts['url'])) {
        return '';  // If no URL, output nothing
    }

    return '<a href="' . esc_url($atts['url']) . '" class="floating-nepali-button" >Read in English</a>';
}
add_shortcode('read_in_english', 'read_in_english_button_shortcode');
