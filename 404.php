<?php
/*
Template Name: Not Found Page
*/
?>
<?php
get_header();
?>


<div class="sidebar-overlay"></div>
<main class="container">
    <div class="not-found-container">
        <div class="not-found">
            <h1>404</h1>
            <h2>Oops! Page not found.</h2>
            <p>We can't seem to find the page you're looking for.</p>
            <a href="<?php echo home_url(); ?>" class="home-link">Back to Homepage</a>
        </div>
    </div>
</main>
<?php
get_footer();
?>
<?php
wp_footer();
?>