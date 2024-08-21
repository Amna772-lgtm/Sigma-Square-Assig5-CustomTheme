<?php
/* Template Name: Homepage Template */

get_template_part('template-parts/header');
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non urna eros.Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            <?php }

        endwhile;
        ?>
        
        <!-- Include the feature-showcase template part -->
        <?php get_template_part('template-parts/feature-showcase'); ?>
        
        <!-- Portfolio section using shortcode-->
        <?php echo do_shortcode('[portfolio_grid]'); ?>

    </div>
</main>

<?php
get_template_part('template-parts/footer');
// Default footer
?>