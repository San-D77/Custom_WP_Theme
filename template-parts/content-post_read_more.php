<?php

$current_post_id = get_the_ID();
$tags = get_the_tags();

if ($tags) {
    $tag_ids = array();

    foreach ($tags as $tag) {
        $tag_ids[] = $tag->term_id;
    }
}

$args = array(
    'tag__in' => isset($tag_ids) ? $tag_ids : '',
    'posts_per_page' => 12,
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' =>  (array) $current_post_id,
);

$query = new WP_Query($args);

$unique_posts = array(); // Array to store unique post IDs

if ($query->have_posts()) { ?>
    <aside class="related-articles-section col-lg-4 mt-3">
        <div class="related-post-heading">Related Articles</div>
        <div class="row">
        <?php while ($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();

            if (!in_array($post_id, $unique_posts)) {
                $unique_posts[] = $post_id;
                $post_id = get_the_ID();
                $post_slug = get_post_field('post_name');
        ?>

                <div class="related-post col-sm-6 col-lg-12">
                    <div class="image-div">
                        <a href="<?php the_permalink(); ?>"><img height="320" width="100%" loading="lazy" src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                                                                                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                                                                                echo $alt_text; ?>"></a>
                    </div>
                    <div class="description-div">
                        <div class="upper-div">
                            <div class="category">
                                <?php
                                $category = get_the_category();
                                if (!empty($category)) {
                                    // Get the URL of the category archive page
                                    $category_link = get_category_link($category[0]->cat_ID);
                                    // Create a hyperlink around the category name
                                    echo '<a href="' . esc_url($category_link) . '">' . esc_html($category[0]->cat_name) . '</a>';
                                } else {
                                    echo ''; // Optional: Display a default message or leave empty if no category
                                }
                                ?>
                            </div>
                            <div class="title">
                                <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                            </div>
                        </div>
                        <div class="author">
                            By <a href="<?php
                                        $author_id = get_the_author_meta('ID');
                                        $author_slug = get_author_posts_url($author_id);
                                        echo $author_slug;
                                        ?>">
                                <?php the_author(); ?>
                            </a>
                        </div>
                    </div>
                </div>
                                
        <?php }
        } ?>
</div>

    </aside>
<?php

} else {
    // No posts found
}

wp_reset_postdata(); // Reset the query

?>