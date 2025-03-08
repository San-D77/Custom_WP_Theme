<?php
get_header();
?>
<style>
    body {
        background: #000;
    }

    .splide {
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    @media(min-width:968px) {
        #slider {
            display: flex;
            justify-content: center;
        }

        #glider {
            width: 600px;
        }

        #slider #glider figure {
            height: 100%;
        }
    }
    figure{
        height: 100%;
    }
</style>
<div class="sidebar-overlay"></div>
<div class="container">
    <?php the_content() ?>
</div>

<?php
wp_footer();
get_footer();
?>