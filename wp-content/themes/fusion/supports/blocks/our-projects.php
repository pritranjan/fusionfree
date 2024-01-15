<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {

        // register a block.
        acf_register_block_type(array(
            'name'            => 'slx_our_projects',
            'title'           => __('Climavent Our projects'),
            'description'     => __(''),
            'render_callback' => 'slx_our_projects_callback',
            'category'        => 'formatting',
        ));
    }
});

if (!function_exists('slx_our_projects_callback')) {

    function slx_our_projects_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {

        $projects = array();
        $projects['post_type'] = 'project';
        $projects['posts_per_page'] = 5;
        $projects = mk_get_posts($projects);
        if (empty($projects)) {
            return;
        }

?>
        <!-- Section Start -->
        <section id="our-projects" class="our-project bg--dark position-relative sec-heading--padding">
            <div class="container">
                <div class="our-project__slider-two">
                    <div class="section-title">
                        <span><?php echo __('Branding & design'); ?></span>
                    </div>
                    <div class="swiper js-projects-slider project__swiper">
                        <div class="swiper-wrapper">
                            <?php
                            while ($projects->have_posts()) {
                                $projects->the_post();
                            ?>
                                <div class="swiper-slide project__slide">
                                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo __('Image');?>">
                                    <h3 class="service-title">
                                        <?php echo get_the_title(); ?>
                                    </h3>
                                </div>
                                <!-- <div class="col-md-4">
                                </div> -->
                            <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <div class="more__links">
                        <a href="javascript:void(0)" class="linkable">
                            <?php echo __('Project Details');?>
                            <img decoding="async" src="<?php echo MK_ASSETS_DIR_URL?>img/right-arrow.png" alt="<?php echo __('See Details');?>">
                        </a>

                        <a href="javascript:void(0)" class="linkable linkable__elem js-view-next-project-slide">
                            <span>
                                <?php echo __("View Slides");?>
                                <img decoding="async" src="<?php echo MK_ASSETS_DIR_URL?>img/right-arrow.png" alt="<?php echo __("Next Slide");?>">
                            </span>
                        </a>
                    </div>

                </div>
            </div>
            </div>
        </section>
        <!-- Section End -->
<?php
    }
}
