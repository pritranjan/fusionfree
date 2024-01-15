<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {

        // register a block.
        acf_register_block_type(array(
            'name'            => 'slx_our_products',
            'title'           => __('Climavent Our products'),
            'description'     => __(''),
            'render_callback' => 'slx_our_products_callback',
            'category'        => 'formatting',
        ));
    }
});

if (!function_exists('slx_our_products_callback')) {

    function slx_our_products_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {

        // $highlight_heading = $block['data']['highlight_heading'];
        $products = array();
        $products['post_type'] = 'product';
        $products['posts_per_page'] = 12;
        $products['meta_key'] = 'sorting';
        $products['meta_type'] = 'NUMERIC';
        $products['orderby'] = 'meta_value_num';
        $products['order'] = 'ASC';
        $products = mk_get_posts($products);
        if (empty($products)) {
            return;
        }

?>
        <!-- Case Section Start -->
        <section id="products" class="case-wrap pb-75-bk">
            <div class="container">
                <div class="section-title style1 text-center mb-50">
                    <span>OUR PRODUCTS</span>
                    <h2>Explore our range of products</h2>
                </div>
                <div class="case-slider-two owl-carousel">
                    <?php
                    while ($products->have_posts()) {
                        $products->the_post();
                        $whatsAppLink = "https://api.whatsapp.com/send?phone=" . mk_get_admin_mobile() . "&text=Hi, i have an enquiry regarding " . get_the_title() . " product.";
                        $product = array(
                            'title' => get_the_title(),
                            'img' => get_the_post_thumbnail_url()
                        );;
                        $link = $whatsAppLink;
                        $brochure = get_field('brochure', get_the_ID());
                    ?>
                        <div class="case-card style2">
                            <a href="<?php echo $link; ?>" class="case-img">
                                <img src="<?php echo $product['img'] ?>" alt="Image">
                            </a>
                            <div class="case-info">
                                <ul class="case-category list-style d-none">
                                    <li class="text-uppercase"><a href="<?php echo $link; ?>"><?php echo $product['title'] ?></a></li>
                                    <li class="text-uppercase"><a href="<?php echo $link; ?>">Download Brochure</a></li>
                                </ul>
                                <h3 class=""><a target="_blank" href="<?php echo $link; ?>"><?php echo $product['title'] ?></a></h3>
                                <button style="padding: 6px 9px;" class="btn btn-sm btn-primary" onclick="scrollDownToForm('<?php echo $product['title'] ?>')"><?php echo __("Download brochure"); ?></button>
                                <!-- <button class="btn btn-sm btn-secondary">
										<i class="ri-file-download-line"></i>
								</button>
								<button class="btn btn-sm btn-secondary">
										<i class="ri-file-download-line"></i>
								</button> -->
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>


                </div>
            </div>

        </section>
        <!-- Case Section End -->

        <script>
            function scrollDownToForm(form_title) {
                var targetElement = document.getElementById('product-form');

                var offset = 0;
                window.scrollTo({
                    top: targetElement.offsetTop - offset,
                    behavior: 'smooth' // Optional: Add smooth scrolling animation.
                });
                var selectElement = document.getElementById("subject");

                // Loop through all the options in the select element
                for (var i = 0; i < selectElement.options.length; i++) {
                    var option = selectElement.options[i];

                    // Check if the option's value matches the desired value
                    if (option.value === form_title) {
                        // Set the option as selected
                        option.selected = true;
                    } else {
                        // Deselect any other options
                        option.selected = false;
                    }
                }
            }
        </script>
<?php
    }
}
