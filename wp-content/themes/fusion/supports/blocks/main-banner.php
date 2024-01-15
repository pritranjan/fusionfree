<?php
add_action('acf/init', 'slx_register_block_main_slider');
function slx_register_block_main_slider()
{
    // check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a block.
        acf_register_block_type(array(
            'name'            => 'slx_main_banner',
            'title'           => __('Climavent Home Main Banner'),
            'description'     => __(''),
            'render_callback' => 'slx_main_banner_render',
            'category'        => 'formatting',
        ));
    }
}
function slx_main_banner_render($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
{
?>
    <!-- Home's Fusion Section -->
    <section class="fusion">
        <div class="container">
            <div class="fusion__content">
                <!-- Main Heading -->
                <h1>
                    We're <span>Fusion</span><?php echo __(', We Build
                    Things For Human');?>
                </h1>

                <!-- Navigation Links -->
                <ul class="fusion__nav">
                    <li class="fusion__nav__item">
                        <a href="javascript:void(0)">
                            <?php echo __("Design");?>
                        </a>
                    </li>
                    <li class="fusion__nav__item">
                        <a href="javascript:void(0)">
                            <?php echo __("Strategy");?>
                        </a>
                    </li>
                    <li class="fusion__nav__item">
                        <a href="javascript:void(0)">
                            <?php echo __("Branding");?>
                        </a>
                    </li>
                </ul>

                <!-- Scroll-down Button -->
                <a href="#our-services" class="btn p-0 scroll-down__btn">
                    <img src="<?php echo MK_ASSETS_DIR_URL ?>img/arrow.png" alt="<?php echo __('Arrow');?>" />
                </a>
            </div>

            <!-- Fusion's bottom Elems -->
            <div class="fusion__in-touch">
                <a href="<?php echo home_url();?>" class="fusion__link">
                    <img src="<?php echo MK_ASSETS_DIR_URL ?>img/fusion__icon.png" alt="<?php echo __("Fusion");?>" />
                </a>

                <a href="#contact-us" class="fusion__in-touch__link linkable">
                    <?php echo __('Get In Touch');?> <img src="<?php echo MK_ASSETS_DIR_URL ?>img/right-arrow.png" alt="<?php echo __("Get In Touch");?>" />
                </a>
            </div>
        </div>
    </section>
<?php

}
