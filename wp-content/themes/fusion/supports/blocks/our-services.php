<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        // register a block.
        acf_register_block_type(array(
            'name'            => 'mk_our_services_area',
            'title'           => __('Climavent Our Services'),
            'description'     => __(''),
            'render_callback' => 'mk_our_services_area_callback',
            'category'        => 'formatting',
        ));
    }
});

if (!function_exists('mk_our_services_area_callback')) {
    function mk_our_services_area_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {
        $ourServices = [];
        $ourServices[] = array(
            'img' => MK_ASSETS_DIR_URL . 'img/col-strategy.png',
            'title' => 'Strategy.',
            'desc' => "Ship it user story iterate engaging
            co-working intuitive pitch deck
            hacker prototype SpaceTeam user
            centered design big data.",
        );

        $ourServices[] = array(
            'img' => MK_ASSETS_DIR_URL . 'img/col-branding.png',
            'title' => 'Branding.',
            'desc' => "Ship it user story iterate engaging
            co-working intuitive pitch deck
            hacker prototype SpaceTeam user
            centered design big data.",
        );

        $ourServices[] = array(
            'img' => MK_ASSETS_DIR_URL . 'img/col-design.png',
            'title' => 'Design.',
            'desc' => "Ship it user story iterate engaging
            co-working intuitive pitch deck
            hacker prototype SpaceTeam user
            centered design big data.",
        );
?>
        <!-- Our Services -->
        <section class="our-services sec-heading--padding bg-secondary" id="our-services">
            <div class="container">
                <div class="section__heading--absolute">
                    <h4>
                        <?php echo __('Our Services'); ?>
                    </h4>
                </div>
                <div class="our-services__heading">
                    <h2>
                        <?php echo __('Our team will take your business
                        presence to new level'); ?>
                    </h2>
                </div>
                <div class="our-services__row">
                    <div class="row">
                        <?php
                        foreach ($ourServices as $eachService) {
                        ?>
                            <div class="col-md-4">
                                <!-- Single Column -->
                                <div class="our-services__col">
                                    <img src="<?php echo $eachService['img'];?>" alt="<?php echo $eachService['title'];?>" class="our-services__col-img">
                                    <h3>
                                    <?php echo $eachService['title'];?>
                                    </h3>
                                    <p>
                                    <?php echo $eachService['desc'];?>
                                    </p>

                                    <a href="javascript:void(0)" class="linkable">
                                        <?php echo __('See Details');?> <img src="<?php echo MK_ASSETS_DIR_URL; ?>img/right-arrow.png" alt="See Details" />
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
