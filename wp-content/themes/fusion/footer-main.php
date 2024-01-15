<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="footer-column first">
                    <img src="<?php echo mk_get_theme_logo_url();
                                ?>" alt="Footer logo">
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-sm-4 col-6">
                        <div class="footer-column">
                            <?php dynamic_sidebar('footer_column_1'); ?>
                        </div>
                    </div>

                    <div class="col-sm-4 col-6">
                        <div class="footer-column">
                            <?php dynamic_sidebar('footer_column_2'); ?>
                        </div>
                    </div>

                    <div class="col-sm-4 col-12">
                        <div class="footer-column last">
                            <?php
                            dynamic_sidebar('footer_column_3');
                            // Show Social Media 
                            if (function_exists('mk_get_social_media_links_html')) {
                                echo mk_get_social_media_links_html();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>