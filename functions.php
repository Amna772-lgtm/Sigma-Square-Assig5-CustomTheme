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

