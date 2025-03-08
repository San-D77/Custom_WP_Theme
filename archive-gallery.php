<?php
get_header();
?>
<div class="sidebar-overlay"></div>
<main class="container content">
    <?php if (have_posts()) : ?>
        <div class="featured-bottom row g-3">
            <?php
            while (have_posts()) : the_post();
            ?>
                <div class="col-md-4 single-item">
                    <div class="image-div">
                        <a href="<?php the_permalink(); ?>">
                            <img loading="lazy" width="250" height="120" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                                                                                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                                                                                echo $alt_text; ?>" />
                        </a>

                    </div>
                    <div class="title-div">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                        </a>
                    </div>
                </div>
            <?php
            endwhile; ?>
        </div>
    <?php endif; ?>
    <?php the_posts_pagination(); ?>
</main>
<?php
get_footer();
?>

<?php
wp_footer();
?>