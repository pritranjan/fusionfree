<?php
add_action('acf/init', 'slx_register_block_text_content');
function slx_register_block_text_content()
{

    // check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a block.
        acf_register_block_type(array(
            'name'            => 'slx_text_content',
            'title'           => __('Climavent Text Editor'),
            'description'     => __(''),
            'render_callback' => 'slx_text_content_render',
            'category'        => 'formatting',
        ));
    }
}


function slx_text_content_render($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
{
?>
    <section class="terms-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php echo @$block['data']['text_content']; ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
