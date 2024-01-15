<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        // register a block.
        acf_register_block_type(array(
            'name'            => 'mk_enquire_form_area',
            'title'           => __('Climavent enquire form area'),
            'description'     => __(''),
            'render_callback' => 'mk_enquire_form_area_callback',
            'category'        => 'formatting',
        ));
    }
});

if (!function_exists('mk_enquire_form_area_callback')) {

    function mk_enquire_form_area_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {
?>
        <section id="contact-us" class="contact-us bg-secondary position-relative sec-heading--padding">
            <div class="container">
                <div class="section__heading--absolute">
                    <h4><?php echo __("Contact us"); ?></h4>
                </div>
                <div class="contact-us__heading">
                    <h2><?php echo __("Let’s talk about the project"); ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo do_shortcode('[contact-form-7 id="7eec666" title="Contact form 1"]'); ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
