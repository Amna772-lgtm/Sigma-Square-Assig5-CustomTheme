<!-- Main Footer -->
<footer class="main-footer">
    <hr class="footer-divider">
    <div class="footer-container">
        <div class="footer-column">
            <h2>Welcome to D'SIGNfly</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.Lorem
                ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.Lorem ipsum
                dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum</p>
            <a href="#" class="read-more-button">Read More</a>
        </div>
        <div class="footer-column">
            <h2>Contact Us</h2>
            <p>Address: 123 Street Name, City, Country</p>
            <p>Phone: (123) 456-7890</p>
            <p>Email: <span class="email">info@example.com</span></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a> 
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>

        </div>
    </div>
</footer>

<!-- Footer for copyright -->
<footer class="site-footer">
    <div class="container">
        <hr class="footer-line">
        <p>&copy; <?php echo date('Y'); ?>-D'SIGNfly | Designed by <span
                class="author-name"><?php the_author(); ?></span></p>
    </div>
</footer>
<!-- serve as a hook that allows WordPress, plugins, and themes to insert scripts, styles, and other content  -->
<?php wp_footer(); ?>
</body>

</html>