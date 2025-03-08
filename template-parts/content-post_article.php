<div class="sidebar-overlay"></div>
<main class="container content">
    <div class="row">
        <article class="col-lg-8 mt-3">
            <?php get_template_part('template-parts/content', 'post_breadcrumb'); ?>

            <section class="head">
                <!-- <div class="category-section"><?php $category = get_the_category();
                                                    echo ($category ? $category[0]->cat_name : ''); ?></div> -->
                <div class="heading">
                    <h1><?php the_title(); ?></h1>
                    <?php
                    $post_id = get_the_ID();  // Assuming you're within The Loop, get the current post's ID
                    $summary = get_post_meta($post_id, 'summary', true);  // Replace 'summary' with your actual meta key

                    if (!empty($summary)) {
                        echo "<p class='summary'>" . esc_html($summary) . "</p>";
                    }
                    ?>
                    <div class="tags">
                        <?php
                        $post_tags = get_the_tags(); // Get the tags for the current post

                        if ($post_tags) {
                            echo '<div class="tag-wrapper">'; // Wrap the tags in a container div

                            foreach ($post_tags as $tag) {
                                $tag_link = get_tag_link($tag->term_id); // Get the URL for the tag
                                echo '<a class="tag" href="' . esc_url($tag_link) . '">' . '#' . $tag->name . '</a>'; // Wrap the span with an anchor tag
                            }

                            echo '</div>'; // Close the container div
                        }
                        ?>

                    </div>
                </div>


                <!-- <div class="facts-verification">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svgs/correct-success-tick-svgrepo-com.svg' ?>" alt="">
                    Facts checked by editors at <?php bloginfo('name'); ?>
                </div> -->

            </section>
            <section class="featured-image">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                    $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                    echo $alt_text; ?>">
            </section>
            <div class="meta-section">
                <span>By <a href="<?php
                                    $author_id = get_the_author_meta('ID');
                                    $author_slug = get_author_posts_url($author_id);
                                    echo $author_slug;
                                    ?>"><?php the_author(); ?></a> &nbsp;| &nbsp;Updated on <?php echo get_the_modified_date(); ?>
                </span>
                <?php get_template_part('template-parts/content', 'social_share') ?>
            </div>

            <section class="content-wrap row">
                <div class="col-lg-12" style="padding:0px;">
                    <?php
                    get_template_part('template-parts/content', 'post_facts');
                    ?>
                    <?php get_template_part('template-parts/content', 'post_table_of_content'); ?>
                </div>

                <div class="article-content col-lg-12">
                    <?php the_content(); ?>
                    <?php
                    // Get the author's description
                    $author_description = get_the_author_meta('description');

                    // Check if the description is not empty
                    if (!empty($author_description)) : ?>
                        <div class="author-bio">
                            <?php echo get_avatar(get_the_author_meta('ID'), 96); ?>
                            <p class="author-name">About Author: <?php the_author(); ?></p>
                            <div class="desc">
                                <?php echo $author_description; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </section>

        </article>

        <?php get_template_part('template-parts/content', 'post_read_more'); ?>

    </div>

</main>