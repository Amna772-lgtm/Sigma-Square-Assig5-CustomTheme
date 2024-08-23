<?php
/* Template Name: Contact Page Template */

get_template_part('template-parts/header');
get_template_part('template-parts/feature-showcase');
?>

<div class="contact-page-content">
    <div class="content-column">
        <h2 class="wp-block-heading">Get In Touch!!</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
    </div>
    <?php the_content(); ?>
</div>

<?php
get_template_part('template-parts/footer');
?>