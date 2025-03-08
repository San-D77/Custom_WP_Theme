<?php
get_header();
?>
<div class="sidebar-overlay"></div>
<main class="container content">


    <?php
    function display_first_section($query)
    {
        if ($query instanceof WP_Query && $query->have_posts()) : ?>
            <!-- Slider -->
            <div id="slider">
                <section id="glider" class="my-4">
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <!-- Loop through each post -->
                                <?php
                                $counter = 0;
                                while ($query->have_posts()) : $query->the_post();
                                    // Category details
                                    $category = get_the_category();
                                    $category_name = !empty($category) ? esc_html($category[0]->name) : '';
                                    $category_slug = !empty($category) ? esc_url(get_category_link($category[0]->cat_ID)) : '';

                                    // Author details
                                    $author_id = get_the_author_meta('ID');
                                    $author_slug = get_author_posts_url($author_id); ?>

                                    <li class="splide__slide">
                                        <figure class="slider-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>" class="slider-image-img" width="" height="">
                                            </a>
                                            <div class="title-section">
                                                <p class="slider-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </p>

                                            </div>
                                        </figure>
                                    </li>
                                <?php
                                    $counter++;
                                endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        <?php
        endif;
        wp_reset_postdata();
    }

    // function display_second_section($args)
    // {

    //     // Create the custom query
    //     $articles_query = new WP_Query($args);

    //     if ($articles_query->have_posts()) : ?>
            <!-- <div class="horizontal-line"></div> -->
            <!-- <?php 
    //         if (isset($args['category_name']) && !empty($args['category_name'])) {
    //             echo '<h2 class="section-title">' . esc_html($args['category_name']) . '</h2>';
    //         }
             ?>
    //         <div class="horizontal-line"></div>
    //         <div class="display-wrap">
    //             <section class="under-slider-section">
    //                 <div class="row">
    //                     <?php
    //                     while ($articles_query->have_posts()) : $articles_query->the_post(); ?>
    //                         <div class="under-slider-section-post-wrap col-md-4 col-sm-6">
    //                             <div class="under-slider-section-post">
    //                                 <div class="image-div">
    //                                     <a href="<?php the_permalink(); ?>"><img loading="lazy" width="250" height="120" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"></a>
    //                                 </div>
    //                                 <div class="title">
    //                                     <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    //                                 </div>

    //                             </div>
    //                         </div>

    //                     <?php
    //                     endwhile; ?>
    //                 </div>
    //             </section>
    //         </div>
    //     <?php
    //     endif;
    //     wp_reset_postdata();
    // }

    function display_subsequent_sections($args)
    {
        // Create the custom query
        $articles_query = new WP_Query($args);

        if ($articles_query->have_posts()) : ?>
            <div class="horizontal-line"></div>
            <?php
            if (isset($args['category_name']) && !empty($args['category_name'])) {
                echo '<h2 class="section-title">' . esc_html($args['category_name']) . '</h2>';
            }
            ?>
            <div class="horizontal-line"></div>
            <div class="display-wrap">
                <section class="related-articles-section">
                    <div class="row">
                        <?php
                        while ($articles_query->have_posts()) : $articles_query->the_post(); ?>
                            <div class="related-post-wrap col-md-4 col-sm-6">
                                <div class="related-post">
                                    <div class="image-div">
                                        <a href="<?php the_permalink(); ?>"><img loading="lazy" width="250" height="120" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"></a>
                                    </div>
                                    <div class="description-div">
                                        <div class="upper-div">

                                            <div class="title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile; ?>
                    </div>
                </section>
            </div>
    <?php
        endif;
        wp_reset_postdata();
    }








    $category_1_id = get_theme_mod('pandora_theme_category_1');
     

    function replace_zero($value)
    {
        return $value === 0 ? '' : $value;
    }

    // Get category IDs from theme mod
    $category_ids = [
        get_theme_mod("pandora_theme_category_2"),
        get_theme_mod("pandora_theme_category_3"),
        get_theme_mod("pandora_theme_category_4"),
        get_theme_mod("pandora_theme_category_5"),
    ];

    // Replace zero with empty string
    $category_ids = array_map('replace_zero', $category_ids);


    // Filter out empty values
    $category_ids = array_filter($category_ids);
    $args1 = array(
        'post_type' => 'post',
        'meta_query' => array(
            array(
                'key' => 'is_featured',
                'value' => '1',
                'compare' => 'LIKE'
            )
        ),
        'posts_per_page' => 9,
        'meta_key' => 'date_featured',
        'orderby' => 'meta_value',
        'order' => 'DESC'
    );

    // The Query
    // $featured_query = new WP_Query($args1);

    // if ($featured_query->have_posts()) {
    //     display_first_section($featured_query);
    // } else {
    if ($category_1_id) {
        $category_args = array(
            'category__in' => array($category_1_id),
            'posts_per_page' => 9
        );
        $category_query = new WP_Query($category_args);
        display_first_section($category_query);
    } else {
        $args3 = array(
            'post_type' => 'post',
            'posts_per_page' => 9,
            'orderby' => 'date', // Order by post date
            'order' => 'DESC', // Order from newest to oldest
        );
        $new_query = new WP_Query($args3);
        display_first_section($new_query);
    }
    // }

    // if ($category_2_id) {

    //     $category = get_category($category_2_id);
    //     $category_name = $category ? $category->name : 'No Category';  // Safely retrieve the category name
    //     $args2 = array(
    //         'category__in' => array($category_2_id),
    //         'posts_per_page' => 6, // Change this as needed
    //         'category_name' => $category_name,  // Include the category name in the arguments
    //         'orderby' => 'date', // Order by post date
    //         'order' => 'DESC', // Order from newest to oldest
    //     );



    //     display_second_section($args2);
    // }

    if (empty($category_ids)) { // In case no category is selected
        // Define the custom query arguments

        $args_remaining = array(
            'post_type' => 'post', // Fetch posts only
            'posts_per_page' => 6, // Limit to 6 articles
            'orderby' => 'date', // Order by post date
            'order' => 'DESC', // Order from newest to oldest
            'offset' => 9, // Skip the first 9 posts
        );
        display_subsequent_sections($args_remaining);
    } else {

        foreach ($category_ids as $category_id) {

            if ($category_id) {
                $category = get_category($category_id);
                $category_name = $category ? $category->name : 'No Category';  // Safely retrieve the category name
                $args = array(
                    'category__in' => array($category_id),
                    'posts_per_page' => 6, // Change this as needed
                    'category_name' => $category_name,  // Include the category name in the arguments
                );
                display_subsequent_sections($args);
            }
        }
    }



    ?>

</main>
<script>

</script>
<?php
get_footer();
wp_footer();
?>