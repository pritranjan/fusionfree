<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        // register a block.
        acf_register_block_type(array(
            'name'            => 'mk_our_team',
            'title'           => __('Climavent Our Team'),
            'description'     => __(''),
            'render_callback' => 'mk_our_team_callback',
            'category'        => 'formatting',
        ));
    }
});

if (!function_exists('mk_our_team_callback')) {
    /**
     * mk_our_team_callback
     * Render data
     */
    function mk_our_team_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {

        $teamMembers = array();
        $teamMembers['post_type'] = 'team';
        $teamMembers['posts_per_page'] = 8;
        $teamMembers = mk_get_posts($teamMembers);
        if (empty($teamMembers)) {
            return;
        }
?>
        <!-- Section Start -->
        <section id="our-team" class="our-team bg--dark position-relative sec-heading--padding">
            <div class="container">
                <div class="section__heading--absolute">
                    <h4><?php echo __("Our Team"); ?></h4>
                </div>
                <div class="our-team__heading">
                    <h2><?php echo __("Our Amazing Team"); ?></h2>
                </div>
                <div class="our-team__row row">
                    <?php
                    while ($teamMembers->have_posts()) {
                        $teamMembers->the_post();
                    ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="team-member-card">
                                <img class="img-fluid team-member-card__profile-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image">
                                <h3 class="team-member-card__name">
                                    <?php echo get_the_title(); ?>
                                </h3>
                                
                                <p class="team-member-card__designation"><?php echo get_field('designation', get_the_ID()); ?></p>

                                <div class="team-member-card--hoverable">
                                    <div class="team-member-card--hoverable__user">
                                        <div class="team-member-card--hoverable__user-img">
                                            <img class="img-fluid team-member-card__profile-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image">
                                        </div>
                                        <div class="team-member-card--hoverable__user-content">
                                            <h3 class="team-member-card__name">
                                                <?php echo get_the_title(); ?>
                                            </h3>

                                            <p class="team-member-card__designation"><?php echo get_field('designation', get_the_ID()); ?></p>
                                        </div>
                                    </div>
                                    <p class="team-member-card__brief"><?php echo get_field('brief', get_the_ID()); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            </div>
        </section>
        <!-- Section End -->
<?php
    }
}
