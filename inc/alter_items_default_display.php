<?php

/* 
    ======================================================
      Change the way image displayed in a post
      wrapping the image with figure block
    ======================================================
*/


function custom_img_caption_shortcode($output, $attr, $content) {
    // Get Caption
    $caption = $attr['caption'];

    // Create a custom HTML output
    $custom_output = '<figure class="image">';

    // Get the image HTML
    preg_match('/<img[^>]+src="([^"]+)"[^>]+>/', $content, $matches);
    $image_html = $matches[0];
    $image_src = $matches[1]; // Extract src from the image tag

    // Add lazy loading attribute to the image HTML
    $image_html = str_replace('<img ', '<img loading="lazy" ', $image_html);
    
    // Pinterest link with SVG icon
    // Append image HTML to the custom output
    $pinterest_link = '<a href="https://www.pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&media=' . urlencode($image_src) . '&description="" target="_blank" class="pinterest-pin-it-button" > 
    <svg width="26" height="26" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 4.99 3.06 9.27 7.42 11.11-.1-.94-.19-2.39.04-3.42.22-.98 1.45-6.22 1.45-6.22s-.37-.74-.37-1.83c0-1.71 1-2.99 2.24-2.99 1.06 0 1.57.8 1.57 1.75 0 1.07-.68 2.67-1.03 4.16-.28 1.18.59 2.14 1.76 2.14 2.11 0 3.74-2.23 3.74-5.45 0-2.85-2.05-4.84-4.99-4.84-3.4 0-5.4 2.55-5.4 5.18 0 1.03.4 2.14 0.9 2.74.1.12.11.22.08.34-.1.37-.32 1.18-.36 1.34-.05.22-.18.27-.42.16-1.52-.68-2.47-2.82-2.47-4.54 0-3.7 2.69-7.1 7.78-7.1 4.09 0 7.26 2.91 7.26 6.81 0 4.06-2.56 7.33-6.12 7.33-1.2 0-2.32-.62-2.71-1.35l-.74 2.82c-.27 1.01-1 2.27-1.5 3.04C9.5 23.39 10.7 24 12 24c6.63 0 12-5.37 12-12S18.63 0 12 0z"/></svg>
    </a>';

    $custom_output .= $image_html .''. $pinterest_link;

    

    if ($caption) {
        $custom_output .= '<figcaption>' . $caption . '</figcaption>';
    }

    $custom_output .= '</figure>';

    return $custom_output;
}
add_filter('img_caption_shortcode', 'custom_img_caption_shortcode', 10, 3);



/* 
    ======================================================
      Wrap table in a div so we can handle the layout
    ======================================================
*/


function wrap_tables_with_div($content)
{
    // Only proceed if there's a <table> tag in the content
    if (strpos($content, '<table') !== false) {
        // Use a regular expression to match <table> elements and wrap them with a <div>
        // Be aware that this basic regex might not handle all edge cases, especially with nested tables or complex attributes
        $content = preg_replace('/<table(.*?)>/i', '<div class="table-container"><table$1>', $content);
        $content = str_replace('</table>', '</table></div>', $content);
    }

    return $content;
}

add_filter('the_content', 'wrap_tables_with_div');



/* 
    ======================================================
      Change how default gallery in the frontend
      is displayed to implement slider in gallery
    ======================================================
*/


function pandoratheme_custom_gallery_output($output, $atts, $instance) {
    global $post;

    // Retrieve the gallery images IDs and ensure the order is maintained
    $ids = explode(',', $atts['ids']);
    
    // Get the posts in the order of provided IDs
    $images = get_posts(array(
        'include'        => $ids,
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'post_mime_type' => 'image',
        'orderby'        => 'post__in', // Ensures order is based on the 'include' array
        'nopaging'       => true       // Get all posts, no paging
    ));
    
    // Begin the custom slider structure
    $slider_html = '<div id="slider"><section id="glider" class="my-4"><div class="splide"><div class="splide__track"><ul class="splide__list">';

    // Loop through the images and build the custom slider markup
    foreach ($images as $image) {
        $img_url = wp_get_attachment_url($image->ID);
        $img_caption = $image->post_excerpt; // Using the caption as the title
        $slider_html .= '<li class="splide__slide"><figure class="slider-image">';
        $slider_html .= '<img src="' . $img_url . '" alt="' . $img_caption . '" class="slider-image-img">';
        // Add more details to each slide as needed
        $slider_html .= '</figure></li>';
    }

    // Close the custom slider structure
    $slider_html .= '</ul></div></div></section></div>';

    return $slider_html;
}

add_filter('post_gallery', 'pandoratheme_custom_gallery_output', 10, 3);



/* 
    ======================================================
       Limit maximum file upload size to 100KB
    ======================================================
*/

// function custom_limit_upload_size($file)
// {
//     $max_size_kb = 100; // Set the maximum size in KB
//     $max_size_bytes = $max_size_kb * 1024;
//     $file_size = $file['size'];

//     if ($file_size > $max_size_bytes) {
//         $file['error'] = 'File size exceeds the maximum allowed limit of ' . $max_size_kb . 'KB.';
//     }

//     return $file;
// }
// add_filter('wp_handle_upload_prefilter', 'custom_limit_upload_size');
