<div class="title">
    <h1> <?php the_title(); ?> </h1>
    <div class="meta-section">
        <div class="meta-property">
            <span class="mx-1">
                <span class="published-on"><img src="<?php echo get_template_directory_uri().'/assets/images/svgs/clock-svgrepo-com.svg' ?>" alt="" style="width: 16px; margin-bottom:2px;" width="35" height="20"> </span><span class="published-date">
                    <?php echo get_the_date(); ?> &nbsp; |</span>
            </span>
            
            <span>
                <img src="<?php echo get_template_directory_uri().'/assets/images/svgs/edit-svgrepo-com.svg' ?>" width="35" height="20" alt="" style="width: 16px;"></span><span class="updated-date">
                <?php echo get_the_modified_date(); ?> &nbsp;|&nbsp;
            </span>
            
            <span class="article-author">
                <a
                    href="<?php
                        $author_id = get_the_author_meta('ID'); 
                        $author_slug = get_author_posts_url($author_id);
                        echo $author_slug;
                    ?>"><img src="<?php echo get_template_directory_uri().'/assets/images/svgs/person-svgrepo-com.svg' ?>" width="25" height="20" alt="" style="width: 16px;"><?php the_author(); ?>
                </a>
            </span>
        </div>
        <div class="social-share">
            
            Share:
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri().'/assets/images/svgs/facebook-svgrepo-com.svg' ?>" alt="" style="width: 30px; margin-bottom:2px;" width="30" height="25"></a>


            <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri().'/assets/images/svgs/twitter-svgrepo-com.svg' ?>" alt="" style="width: 30px; margin-bottom:2px;" width="30" height="25"></a>

            
            <a href="https://pinterest.com/pin-builder/?url=<?php echo get_permalink(); ?>/&media=<?php the_post_thumbnail_url(); ?>&description=<?php echo wp_trim_words(get_the_excerpt(),25); ?>" target="_blank"><img src="<?php echo get_template_directory_uri().'/assets/images/svgs/pinterest-1-svgrepo-com.svg' ?>" alt="" width="30" height="25" style="width: 30px; margin-bottom:2px;" ></a>
        </div>
    </div>
</div>