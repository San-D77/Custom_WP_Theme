<?php
    get_header();
?>
<div class="sidebar-overlay"></div>
<main class="container content">
    <?php if (have_posts()) : ?>
        <div class="featured mt-1">
            <div class="featured-top row">
                <?php while (have_posts()) : the_post();
                    if ($wp_query->current_post == 0) :
                        // Author slug
                        $author_id = get_the_author_meta('ID');
                        $author_slug = get_author_posts_url($author_id);
                ?>
                        <div class="col-md-8 top-left">
                            <div class="image-div col-md-9">
                                <a href="<?php the_permalink(); ?>">
                                    <img loading="lazy" width="590" height="400" src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                                        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                                        echo $alt_text; ?>" />
                                </a>
                            </div>
                            <div class="title-div col-lg-3">
                                <a href="<?php the_permalink(); ?>">
                                    <h2><?php the_title(); ?></h2>
                                </a>
                                <p>
                                    <?php the_excerpt(); ?>
                                </p>
                                <p class="meta">By <a href="<?php echo $author_slug; ?>"><?php the_author(); ?></a></p>
                            </div>
                        </div>
                <?php endif;
                endwhile; ?>
                <div class="col-md-4 top-right">
                    <?php while (have_posts()) : the_post();
                        if ($wp_query->current_post > 0 && $wp_query->current_post < 4) :
                            // Author slug
                            $author_id = get_the_author_meta('ID');
                            $author_slug = get_author_posts_url($author_id);
                    ?>

                            <div class="single-article">
                                <div class="image-div">
                                    <a href="<?php the_permalink(); ?>">
                                        <img loading="lazy" width="220" height="110" src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                                            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                                            echo $alt_text; ?>" />
                                    </a>
                                </div>
                                <div class="title-div">
                                    <a href="<?php the_permalink(); ?>">
                                        <h2><?php the_title(); ?></h2>
                                    </a>
                                    <div class="meta">By <a href="<?php $author_slug ?>"><?php the_author(); ?></a></div>
                                </div>
                            </div>
                    <?php endif;
                    endwhile; ?>
                </div>

            </div>
        </div>

        <section class="related-articles-section">
            <div class="row">
                <?php while (have_posts()) : the_post();
                    if ($wp_query->current_post > 3) :
                        // Author slug
                        $author_id = get_the_author_meta('ID');
                        $author_slug = get_author_posts_url($author_id);
                ?>
                        <div class="related-post-wrap col-md-4 col-lg-3 col-sm-6">
                            <div class="related-post">
                                <div class="image-div">
                                    <a href="<?php the_permalink() ?>"><img loading="lazy" width="300" height="200" src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                                                                            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                                                                            echo $alt_text; ?>"></a>
                                </div>
                                <div class="description-div">
                                    <div class="upper-div">
                                        <div class="title">
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                        </div>
                                    </div>
                                    <div class="author">
                                        By <a href="<?php echo $author_slug; ?>"><?php the_author(); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endif;
                endwhile; ?>
            </div>
        </section>
    <?php endif; ?>
    <?php the_posts_pagination(); ?>
</main>
<?php
get_footer();
?>

<?php
wp_footer();
?>