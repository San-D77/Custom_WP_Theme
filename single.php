<?php
get_header();
the_post();
$post_id = get_the_ID();
?>
    

        
    <?php

    if (has_category('players')) {
        // This is the layout for posts in the "players" category
        get_template_part('template-parts/content', 'players');
    } elseif (has_category('NPL')) {
        // This is the layout for posts in the "NPL" category
        get_template_part('template-parts/content','npl_stats');
        get_template_part('template-parts/content', 'post_article'); // Include the default post layout if needed

    } else {
        // This is the layout for posts in other categories
        get_template_part('template-parts/content', 'post_article');
    }

    wp_footer();
    ?>
<?php
get_footer();
?>