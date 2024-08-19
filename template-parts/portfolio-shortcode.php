<?php
// Function to display the portfolio grid and create the shortcode
function wp_blog_theme_portfolio_grid($atts) {
    ob_start();

    // Portfolio showcase heading section
    ?>
    <div class="portfolio-page">
        <div class="heading-row">
            <h2>D'SIGN IS THE SOUL</h2>
            <a href="#" class="view-all-button">View All</a>
        </div>
        <hr class="section-divider">
    </div>
    <?php

    // Set up the query for posts with featured images
    $args = array(
        'posts_per_page' => 6, // Default to 6 posts, but can be overridden with the shortcode attribute
        'meta_key' => '_thumbnail_id', // Ensures only posts with featured images are included
    );
    $portfolio_query = new WP_Query($args);

    // Loop through the posts and display featured images
    if ($portfolio_query->have_posts()) :
        echo '<div class="portfolio-grid">';
        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
            ?>
            <div class="portfolio-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); // Adjust size as needed ?>
                </a>
            </div>
            <?php
        endwhile;
        echo '</div>';
    else :
        echo '<p>No posts found.</p>';
    endif;

    // Reset Post Data
    wp_reset_postdata();

    return ob_get_clean();
}

// Register the shortcode
add_shortcode('portfolio_grid', 'wp_blog_theme_portfolio_grid');
