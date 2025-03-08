<?php
/*
Template Name: Static Pages
*/

?>
<?php
get_header();
?>

<style>
    .splide.is-active .splide__list {
        display: flex;
        text-align: center;
        height: 800px !important;
    }

    .splide.is-active img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
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

    }
    #slider #glider figure {
        height: 100%;
    }
</style>
<div class="sidebar-overlay"></div>
<main class="container content">
    <div class="title" style="text-align: center; margin-bottom: 40px;">
        <h1> <?php the_title(); ?> </h1>
    </div>
    <div class="content-detail">
        <?php the_content(); ?>
    </div>
</main>
<script>

</script>
<?php
get_footer();
?>
<?php
wp_footer();
?>