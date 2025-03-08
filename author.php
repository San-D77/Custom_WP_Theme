<?php
/*
Template Name: Author Archive
*/
?>
<?php
get_header();

$current_author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>


<div class="sidebar-overlay"></div>
<main class="container content">
    <?php if ($current_author->user_description) { ?>
        <section class="author-bio">
            <div class="description col-md-12">
                <div class="intro">
                    About <span class="colored"><?php echo $current_author->display_name; ?></span>
                </div>
                <div class="desc">
                    <?php echo $current_author->user_description;  ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <section class="category-div">
        <div class="container category-title">
            <h3 class="text-capitalize mb-4 mt-4">All Posts from
                <span class="colored">
                    <?php echo $current_author->display_name; ?>
                </span>
            </h3>
            <section class="related-articles-section">
                <div class="row">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="related-post-wrap col-md-4 col-lg-3">
                            <div class="related-post">
                                <div class="image-div">
                                    <a href="<?php the_permalink() ?>"><img  src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                                                                            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                                                                            echo $alt_text; ?>"></a>
                                </div>
                                <div class="description-div">
                                    <div class="upper-div">
                                        <div class="title">
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            $category_link = get_category_link($categories[0]->term_id);
                                            echo '<a href="' . esc_url($category_link) . '">' . esc_html($categories[0]->name) . '</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php the_posts_pagination(); ?>
                </div>

            </section>
        </div>
    </section>

</main <?php
        get_footer();
        ?> <?php
    wp_footer();
    ?>