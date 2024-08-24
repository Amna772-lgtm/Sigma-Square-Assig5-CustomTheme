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
function wp_blog_theme_enqueue_styles()
{
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'wp_blog_theme_enqueue_styles');


/**
 *Include the portfolio shortcode file
 */
require get_template_directory() . '/template-parts/portfolio-shortcode.php';


/**
 *Custom call back function for comments list
 */
function custom_comments_format($comment, $args, $depth)
{
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
			<?php if ($first_comment): ?>
				<h2>
					<hr><?php _e('Comments', 'wp-blog-theme'); ?>
					<hr>
				</h2>
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
				comment_reply_link(array_merge($args, array(
					'reply_text' => '<i class="fas fa-reply"></i> ' . __('reply', 'wp-blog-theme'),
					'depth' => $depth,
					'max_depth' => $args['max_depth'],
				)));
				?>
			</div>
		</div>
	</li>
	<?php
}


/**
 * Function to register Blog page sidebar
 */
add_action('widgets_init', 'wp_blog_theme_sidebars');
function wp_blog_theme_sidebars()
{
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id' => 'blog-sidebar',
			'name' => __('Blog Sidebar'),
			'description' => __('Blog sidebar of custom theme '),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	register_sidebar(
		array(
			'id' => 'single-post-sidebar',
			'name' => __('Single Post Sidebar'),
			'description' => __('Single post sidebar of custom theme '),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

}


// Register the custom widget
function wp_blog_theme_custom_portfolio_widget()
{
	register_widget('Featured_Images_Widget');
}
add_action('widgets_init', 'wp_blog_theme_custom_portfolio_widget');

// Define the custom widget
class Featured_Images_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'featured_images_widget',
			__('Featured Images Widget', 'wp-blog-theme'),
			array('description' => __('Displays featured images of recent posts.', 'wp-blog-theme'))
		);
	}

	// Widget front-end display
	public function widget($args, $instance)
	{
		echo $args['before_widget'];

		// Query for recent posts with featured images
		$query_args = array(
			'posts_per_page' => 8, // Number of posts to display
			'meta_key' => '_thumbnail_id', // Ensure only posts with featured images are included
		);
		$query = new WP_Query($query_args);

		if ($query->have_posts()) {
			echo '<ul class="featured-images-widget">';
			while ($query->have_posts()) {
				$query->the_post();
				?>
				<li class="featured-image-item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('small'); // Adjust size as needed ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
		} else {
			echo '<p>' . __('No featured images found.', 'wp-blog-theme') . '</p>';
		}

		// Restore original Post Data
		wp_reset_postdata();

		echo $args['after_widget'];
	}


	// Update widget settings
	public function update($new_instance, $old_instance)
	{
		// Update widget settings if needed
		return $new_instance;
	}
}


/**
 * use the template_include filter to use files from the templates folder.
 */
function wp_blog_theme_custom_templates($template)
{

	// Check if it's the posts page (blog page)
	if (is_home() && !is_front_page()) {
		$new_template = locate_template(array('templates/index.php'));
		if ($new_template) {
			return $new_template;
		}
	}

	// Check if it's the single post page
	if (is_single()) {
		$new_template = locate_template(array('templates/single.php'));
		if ($new_template) {
			return $new_template;
		}
	}

	// Check if it's the archive page 
	if (is_archive()) {
		$new_template = locate_template(array('templates/archive.php'));
		if ($new_template) {
			return $new_template;
		}
	}

	
	if (is_search()) {
		$new_template = locate_template(array('template-parts/search.php'));
		if ($new_template) {
			return $new_template;
		}
	}

	return $template;
}
add_filter('template_include', 'wp_blog_theme_custom_templates');


/**
 * function to add custom theme settings page
 */
function wp_blog_theme_add_admin_menu() {
    // Add a new top-level menu
    add_menu_page(
        __('Blog Theme Settings', 'wp-blog-theme'),  // Page title
        __('Blog Theme Settings', 'wp-blog-theme'),  // Menu title
        'manage_options',                       // Capability
        'wp-blog-theme-settings',               // Menu slug
        'wp_blog_theme_settings_page',          // Function to display the page content
        'dashicons-admin-generic',              // Icon URL or Dashicon class
        100                                     // Position
    );
}
add_action('admin_menu', 'wp_blog_theme_add_admin_menu');

function wp_blog_theme_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Blog Theme Settings', 'wp-blog-theme'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wp_blog_theme_options');
            do_settings_sections('wp-blog-theme-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Setting Option for changing theme mode
 */
function wp_blog_theme_settings_init() {
    // Register a new setting for "wp-blog-theme-settings" page
    register_setting('wp_blog_theme_options', 'wp_blog_theme_options');

    // Add a new section in the "wp-blog-theme-settings" page
    add_settings_section(
        'wp_blog_theme_section',                     // Section ID
        __('General Settings', 'wp-blog-theme'),     // Title
        'wp_blog_theme_section_callback',            // Callback function
        'wp-blog-theme-settings'                     // Page slug
    );

    // Add the theme mode field
    add_settings_field(
        'wp_blog_theme_field_mode',                  // Field ID
        __('Theme Mode', 'wp-blog-theme'),           // Label
        'wp_blog_theme_field_mode_callback',         // Callback function
        'wp-blog-theme-settings',                    // Page slug
        'wp_blog_theme_section',                     // Section ID
        array(
            'label_for' => 'wp_blog_theme_field_mode',
            'class' => 'wp-blog-theme-row',           // For CSS styling
        )
    );

	// Add the font family field
    add_settings_field(
        'wp_blog_theme_field_font_family',            // Field ID
        __('Font Family', 'wp-blog-theme'),           // Label
        'wp_blog_theme_field_font_family_callback',   // Callback function
        'wp-blog-theme-settings',                    // Page slug
        'wp_blog_theme_section',                     // Section ID
        array(
            'label_for' => 'wp_blog_theme_field_font_family',
            'class' => 'wp-blog-theme-row',           // For CSS styling
        )
    );
}
add_action('admin_init', 'wp_blog_theme_settings_init');

// Callback function for the section description
function wp_blog_theme_section_callback() {
    echo '<p>' . __('Choose the mode for your theme.', 'wp-blog-theme') . '</p>';
}


// Callback function for the theme mode field
function wp_blog_theme_field_mode_callback($args) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option('wp_blog_theme_options', array()); // Ensure default value as an array

    // Ensure the 'mode' key exists in the array
    $selected_mode = isset($options['mode']) ? $options['mode'] : 'light'; // Default to 'light'

    ?>
    <select id="<?php echo esc_attr($args['label_for']); ?>" name="wp_blog_theme_options[mode]">
        <option value="light" <?php selected($selected_mode, 'light'); ?>><?php _e('Light', 'wp-blog-theme'); ?></option>
        <option value="dark" <?php selected($selected_mode, 'dark'); ?>><?php _e('Dark', 'wp-blog-theme'); ?></option>
    </select>
    <?php
}

/**
 * calback function for font settings
 */
function wp_blog_theme_field_font_family_callback($args) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option('wp_blog_theme_options', array()); // Ensure default value as an array

    // Ensure the 'font_family' key exists in the array
    $selected_font = isset($options['font_family']) ? $options['font_family'] : 'Arial'; // Default to 'Arial'

    ?>
    <select id="<?php echo esc_attr($args['label_for']); ?>" name="wp_blog_theme_options[font_family]">
        <option value="Arial" <?php selected($selected_font, 'Arial'); ?>><?php _e('Arial', 'wp-blog-theme'); ?></option>
        <option value="Georgia" <?php selected($selected_font, 'Georgia'); ?>><?php _e('Georgia', 'wp-blog-theme'); ?></option>
        <option value="Courier New" <?php selected($selected_font, 'Courier New'); ?>><?php _e('Courier New', 'wp-blog-theme'); ?></option>
    </select>
    <?php
}

function wp_blog_theme_apply_mode() {
    $options = get_option('wp_blog_theme_options');
    $theme_mode = isset($options['mode']) ? $options['mode'] : 'light';
	$font_family = isset($options['font_family']) ? $options['font_family'] : 'Arial';

    if ($theme_mode === 'dark') {
        wp_enqueue_style('wp-blog-theme-dark-mode', get_template_directory_uri() . '/assets/css/dark-mode.css');
    } else {
		wp_enqueue_style('wp-blog-theme-style', get_stylesheet_uri());
    }


	// Apply the selected font-family
    $custom_css = "
        body {
            font-family: $font_family;
        }
    ";
    wp_add_inline_style('wp-blog-theme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'wp_blog_theme_apply_mode');

