<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-container">
            <!-- Logo -->
            <div class="site-logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
                ?>
            </div>

            <!-- Navigation menu -->
            <nav class="site-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'main-menu',
                ));
                ?>
                <!-- Search form -->
                <?php get_template_part('template-parts/search-form') ?>
            </nav>
        </div>
    </header>

    <main>