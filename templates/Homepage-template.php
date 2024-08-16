<?php
/* Template Name: Homepage Template */

get_header();
?>

<main id="main-content">
    <div class="page-container">
        <?php
        // Start the loop.
        while (have_posts()):
            the_post();
            if (has_post_thumbnail()) { ?>
                <div class="featured-image-container">
                    <?php the_post_thumbnail('full'); ?>
                    <div class="overlay-text">
                        <h1>Gearing up the ideas</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non urna eros.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            <?php }
           
            the_content(); // Display the page content.
        endwhile;
        ?>

        <!-- Include the feature-showcase template part -->
        <?php get_template_part('template-parts/feature-showcase'); ?>

    </div>
</main>

<?php
get_template_part('template-parts/footer-main'); // First footer
get_footer(); // Default footer
?>

