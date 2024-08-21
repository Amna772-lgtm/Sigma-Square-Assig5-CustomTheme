<?php
get_template_part('template-parts/header');
?>

<div class="single-post-wrapper">
    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>
            <div class="single-post">
                <h1 class="single-post-title"><?php the_title(); ?></h1>
                <div class="post-meta-content">
                    <div class="post-meta">
                        <span class="post-author">
                            by <span class="author-name"><?php the_author(); ?></span>
                        </span>
                        <span class="post-date">on <?php echo get_the_date(); ?></span>
                        <span class="post-comments"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></span>
                    </div>
                    <hr class="horizontal-line">
                </div>
                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="comments-section">
                <?php comments_template('template-parts/comments.php'); ?>
            </div>
        <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.', 'wp-blog-theme'); ?></p>
    <?php endif; ?>
</div>

<?php
get_template_part('template-parts/footer');
?>