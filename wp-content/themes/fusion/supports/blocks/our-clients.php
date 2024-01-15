<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        // register a block.
        acf_register_block_type(array(
            'name'            => 'mk_our_clients',
            'title'           => __('Climavent Our clients'),
            'description'     => __(''),
            'render_callback' => 'mk_our_clients_callback',
            'category'        => 'formatting',
        ));
    }
});
if (!function_exists('mk_our_clients_callback')) {
    /**
     * mk_our_clients_callback
     * Render data 
     */
    function mk_our_clients_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {

        // get clients data 
        $clients = array();
        $clients['post_type'] = 'client';
        $clients['posts_per_page'] = 12;
        $clients = mk_get_posts($clients);
        // end get clients data 

        // get testimonials data 
        $testimonials = array();
        $testimonials['post_type'] = 'testimonial';
        $testimonials['posts_per_page'] = 12;
        $testimonials = mk_get_posts($testimonials);
        // end get testimonials data 
?>
        <!-- Section Start -->
        <div id="our-clients" class="our-clients bg-secondary sec-heading--padding position-relative">
            <div class="container">
                <div class="section__heading--absolute">
                    <h4>
                        <?php echo __("Testimonials"); ?>
                    </h4>
                </div>
                <div class="our-clients__heading">
                    <h2>
                        <?php echo __('We have worked with some amazing companies around the world'); ?>
                    </h2>
                </div>
                <?php
                // Clients loop start
                if ($clients->have_posts()) {
                ?>
                    <!-- Slider main container -->
                    <div class="swiper js-our-clients-slider w-100">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            while ($clients->have_posts()) {
                                $clients->the_post();
                            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php
                }
                // end client loop here
                ?>

                <?php
                // Testimonials loop start
                if ($testimonials->have_posts()) {
                ?>
                    <div class="testimonial-wrapper w-100">
                        <div class="swiper js-testimonial-slider w-100">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <?php
                                while ($testimonials->have_posts()) {
                                    $testimonials->the_post();
                                ?>
                                    <div class="swiper-slide">
                                        <div class="testimonial-card">
                                            <img class="img-fluid profile-img" src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title(); ?>">
                                            <p class="brief">
                                            <i class="fa fa-quote-left" aria-hidden="true"></i><?php echo get_field('brief', get_the_ID()); ?><i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                            <h3 class="name">
                                                <?php echo get_the_title(); ?>
                                            </h3>
                                            <p class="designation"><?php echo get_field('designation', get_the_ID()); ?></p>
                                        </div>
                                    </div>
                                <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="testimonials-pagination-wrapper">
                        <!-- If we need pagination -->
                        <div class="swiper-pagination js-testimonials-pagination"></div>
                    </div>
                <?php
                }
                // end Testimonials loop here
                ?>
            </div>
        </div>
        <!-- Section End -->
<?php
    }
}
