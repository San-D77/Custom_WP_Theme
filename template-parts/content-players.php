<?php
$post_id = get_the_ID();
?>
<div class="sidebar-overlay"></div>
<main class="container content">
    <div class="row">
        <article class="col-lg-10">
            <?php get_template_part('template-parts/content', 'post_breadcrumb'); ?>


            <section class="image-and-facts row">
                <div class="col-lg-8 featured-image">

                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php $image_id = get_post_thumbnail_id();
                                                                        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                                        echo $alt_text; ?>">

                </div>
                <div class="col-lg-4 facts">
                    <section class="head">

                        <div class="heading">
                            <div class="player-status <?php echo (get_post_meta($post_id, "status", true) == 'Active' ? 'active' : 'retired') ?>">
                                <?php echo get_post_meta($post_id, "status", true); ?>
                            </div>
                            <h1><?php the_title(); ?></h1>

                            <div class="heading-meta">
                            
                                <span class="position">
                                    <?php echo get_post_meta($post_id, "position", true); ?>
                                </span>
                                <span class="jersey-number">
                                     <?php
                                        $jersey_number = get_post_meta($post_id, "jersey-number", true);
                                        $jersey_number ? print '#'.$jersey_number :'' 
                                     ?>
                                </span>
                                <span class="team-name">
                                    <?php
                                    $team = get_post_meta($post_id, "team", true);
                                    $team_link = get_post_meta($post_id, "team-link", true);

                                    if (!empty($team_link)) {
                                        // If team-link has a value, wrap the team in an anchor tag
                                        echo '<a href="' . esc_url($team_link) . '">' . esc_html($team) . '</a>';
                                    } else {
                                        // If team-link is empty, just display the team
                                        echo esc_html($team);
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>

                    </section>
                    <?php get_template_part('template-parts/content', 'players_facts') ?>
                </div>
            </section>

            <section class="content-wrap row">

                <div class="article-content">
                  
                    <?php the_content(); ?>
                    <div class="tags">
                    <i class="fa-solid fa-football"></i>
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
                    <div class="author-bio">
                        <p> About Author: </p>
                        <div class="desc">
                            <?php echo get_the_author_meta('description'); ?>
                        </div>
                    </div>
                </div>
            </section>

        </article>
    </div>
    <?php get_template_part('template-parts/content', 'post_read_more'); ?>
</main>