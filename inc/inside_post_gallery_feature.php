<?php


// Ajax request handeling
add_action('wp_ajax_nopriv_fetch_gallery', 'mytheme_fetch_gallery_ajax');
add_action('wp_ajax_fetch_gallery', 'mytheme_fetch_gallery_ajax');


function mytheme_fetch_gallery_ajax()
{
    // Check if the URL (or ID) is passed and valid
    $post_url = isset($_POST['postUrl']) ? esc_url($_POST['postUrl']) : '';
    if (empty($post_url)) {
        wp_send_json_error('Post URL is missing.');
    }

    // Convert URL to post ID (If you're passing ID directly, you can skip this step)
    $post_id = url_to_postid($post_url);
    if (!$post_id) {
        wp_send_json_error('Invalid post.');
    }

    // Fetch the gallery images (Assuming images are stored as a custom field or similar)
    // This is where you'll need to adjust the code based on how your galleries are stored.
    $gallery_image_ids = get_post_gallery($post_id, false)['ids'];  // Get the IDs of the gallery images
    if (empty($gallery_image_ids)) {
        wp_send_json_error('No gallery found.');
    }

    // Convert the list of IDs to an array
    $gallery_image_ids = explode(',', $gallery_image_ids);

    // Initialize HTML variable
    $html = '';

    // Loop through each image ID and create the Splide list items
    foreach ($gallery_image_ids as $image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'full'); // Get the URL of the image
        $image_caption = get_post_field('post_excerpt', $image_id); // Get the caption from the excerpt of the attachment

        // Construct HTML for each slide with image and caption
        $html .= '<li class="splide__slide">';
        $html .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_caption) . '">';
        $html .= '<div class="slide-caption">' . esc_html($image_caption) . '</div>';  // Include the caption below the image
        $html .= '</li>';
    }

    // Return the HTML
    wp_send_json_success($html);
}
