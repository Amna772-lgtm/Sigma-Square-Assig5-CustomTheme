<?php
/**
 * Register navigation menus in header
 */
register_nav_menus(
    array('primary-menu' => 'Header menu')
);


/**
 * function to add things in admin side of theme 
 */
function wp_blog_theme_setup()
{
    add_theme_support('custom-logo'); //add custom logo
    add_theme_support('post-thumbnails'); //add featured image
}
add_action('after_setup_theme', 'wp_blog_theme_setup');


/**
 * Enqueue the theme's stylesheet
 */
function wp_blog_theme_enqueue_styles() {
    wp_enqueue_style('wp-blog-theme-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'wp_blog_theme_enqueue_styles');


/**
 *Include the portfolio shortcode file
 */
require get_template_directory() . '/template-parts/portfolio-shortcode.php';


/**
 * register sidebar
 */
function wp_blog_theme_register_sidebars(){
    register_sidebar(array(
        'name'=>'Main Sidebar',
        'id'=>'main-sidebar',
    ));
}
add_action('widgets_init', 'wp_blog_theme_register_sidebars');


/**
 *Custom call back function for comments list
 */
function custom_comments_format( $comment, $args, $depth ) {
    static $first_comment = true; 
	// Fetching comment details
	$comment_author = get_comment_author();
	$comment_date = get_comment_date();
	$comment_time = get_comment_time();
	$comment_content = get_comment_text();

	// Building the custom comment HTML
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-container">
        <?php if ( $first_comment ) : ?>
                <h2><hr><?php _e('Comments', 'wp-blog-theme'); ?><hr></h2>
                <?php $first_comment = false; // Set to false after the first comment is rendered ?>
            <?php endif; ?>
			<div class="comment-meta">
				<i class="fas fa-comments"></i> <!-- Font Awesome comment icon -->
				<span class="comment-author"><?php echo $comment_author; ?></span>
				<span class="comment-said-on"><?php _e('said on', 'wp-blog-theme'); ?></span>
				<span class="comment-date"><?php echo $comment_date; ?></span>
				<span class="comment-at"><?php _e('at', 'wp-blog-theme'); ?></span>
				<span class="comment-time"><?php echo $comment_time; ?></span>
			</div>
			<div class="comment-content">
				<?php echo $comment_content; ?>
			</div>
			<div class="comment-reply">
				<?php
				comment_reply_link( array_merge( $args, array(
					'reply_text' => '<i class="fas fa-reply"></i> ' . __( 'reply', 'wp-blog-theme' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
				) ) );
				?>
			</div>
		</div>
	</li>
	<?php
}
