<?php
get_template_part('template-parts/header');
get_template_part('template-parts/feature-showcase');

?>
<div class="blog-posts">
    <!-- Add Heading and Horizontal Line -->

    <div class="blog-heading">
        <h1>LET'S BLOG</h1>
        <hr class="horizontal-line">
    </div>
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'paged' => $paged,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="post-item">
                <div class="post-header">
                    <div class="post-date-title">
                        <span class="post-date"><?php echo strtoupper(date_i18n('j M')); ?></span>
                        <span class="post-title-separator">|</span>
                        <h2 class="post-title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } ?>
                    </div>
                    <div class="post-meta-content">
                        <div class="post-meta">
                            <span class="post-author">
                                by <span class="author-name"><?php the_author(); ?></span>
                            </span>
                            <span class="post-date">on <?php echo get_the_date(); ?></span>
                            <span
                                class="post-comments"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></span>
                        </div>
                        <hr class="horizontal-line">
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="read-more-button">Read More</a>
                        </div>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>
        <!-- Pagination -->
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $query->max_num_pages,
                'current' => $paged,  // Set the current page
                'format' => '?paged=%#%', // Pagination format
                'prev_text' => __('<i class="fas fa-chevron-left"></i>'), // Font Awesome icon for previous
                'next_text' => __('<i class="fas fa-chevron-right"></i>'), // Font Awesome icon for next
            ));
            ?>
        </div>


    <?php else: ?>
        <p><?php _e('No posts found.', 'wp-blog-theme'); ?></p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</div>

<?php
get_template_part('template-parts/footer');
?>