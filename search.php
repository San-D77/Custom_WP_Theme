<?php
/*
Template Name: Search Result Page
*/
?>
<?php
    get_header();
?>


<div class="sidebar-overlay"></div>
<main class="container content">

<form action="/" method="get" class="col-lg-6 form">
    <input value="<?php echo $_GET['s']; ?>" type="text" name="s" id="" class="form-control search-place">
    <button type="submit" style="background:rgb(48, 48, 48); color:white; height: 30px; border-radius:10px; position:relative; right:0; top:23px;">Search</button>
</form>



<section class="search-results col-lg-8 col-md-11">
    <?php if(have_posts()){ ?>
        <section class="category-div mt-3 mb-3">
        <div class="container category-title">
            <h3 class="text-capitalize">Search Results On <span class="colored">
                    <?php echo $_GET['s']; ?>
                </span></h3>
        </div>
        </section>
       <?php while(have_posts()){ the_post(); ?>

            <div class="single-article">
                <div class="image-section">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" width="300" alt="">
                    </a>
                </div>
                <div class="title-section">
                    <a href="<?php the_permalink(); ?>">
                        <h2 class="article-title"><?php the_title(); ?></h2>
                    </a>
                    <p class="summary"><?php echo wp_trim_words(get_the_excerpt(),40,null); ?></p>
                </div>
            </div>

    <?php }
    } else{ ?>
        <p>There is no posts on your search!!!</p>
    <?php } ?>
</section>
</main>
</main>

<?php
        wp_footer();
    ?>
<?php 
    get_footer();
?>