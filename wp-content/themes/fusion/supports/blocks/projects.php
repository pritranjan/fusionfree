<?php
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {

        // register a block.
        acf_register_block_type(array(
            'name'            => 'slx_projects_area',
            'title'           => __('Climavent Projects area'),
            'description'     => __(''),
            'render_callback' => 'slx_projects_area_callback',
            'category'        => 'formatting',
        ));
    }
});

if (!function_exists('slx_projects_area_callback')) {

    function slx_projects_area_callback($block, $content = '', $is_preview = false, $post_id = 0, $wp_block = false, $context = false)
    {

        $projects_quotes = get_field('projects_quote');
?>
        <section class="project-quote pt-75">
            <div class="container">
                <div class="row">
                    <?php foreach ($projects_quotes as $projects_quote) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="service-card style2">
                                <div class="service-img p-0">
                                    <img src="<?php echo $projects_quote['quote_image'] ?>" alt="Image">
                                </div>
                                <div class="service-info">
                                    <h3><?php echo $projects_quote['quote_title'] ?></h3>
                                    <p><?php echo $projects_quote['quote_description'] ?></p>
                                    <a href="#quote-form" onclick="scrollDownToForm('<?php echo $projects_quote['quote_title'] ?>')" class="link btn style1 w-100">Get Quote <i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="appointment-wrap style3 pt-75 pb-75" id="quote-form">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5">
                        <div class="appointment-bg-1 bg-f h-100 d-none d-lg-block">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <form class="appointment-form" method="post" id="quoteForm">
                            <input type="hidden" name="action" value="send_quote_email">
                            <input type="hidden" name="page_url" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h4>Request A Callback</h4>
                                </div>
                            </div>
                            <!-- <p>It's our pleasure to have a chance to cooperate</p> -->
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="d-block mb-1" for="Name">Full Name <span class="text-danger">*</span></label>
                                    <input name="name" type="text" placeholder="Name">
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="d-block mb-1" for="Email">Email <span class="text-danger">*</span></label>
                                    <input name="email" type="email" id="user-email" placeholder="Email">
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="d-block mb-1" for="Mobile">Mobile <span class="text-danger">*</span></label>
                                    <input name="phoneNo" type="text" placeholder="Mobile No">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="d-block mb-1" for="Looking for">Looking for <span class="text-danger">*</span></label>
                                    <select name="subject" id="subject">
                                        <option value="">-- Select --</option>
                                        <?php foreach ($projects_quotes as $projects_quote) { ?>
                                            <option value="<?php echo $projects_quote['quote_title'] ?>">Enquiry for <?php echo $projects_quote['quote_title'] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="d-block mb-1" for="Message">Message</label>
                                    <textarea class="form-control" name="msg" id="msg" rows="3" placeholder="Enter your message/remarks here"></textarea>
                                </div>
                            </div>
                            <div class="g-recaptcha mb-3" data-sitekey="6Le5mEAoAAAAAFCsp3bRv-Xokduv3g76IWjsqlX2"></div>

                            <div class="d-none rounded pleaese-wait bg-info mb-4 text-white px-3 py-2 d-flex align-items-center gap-2">
                                <div class="spinner-border spinner-border-sm text-white" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> Please wait...
                            </div>
                            <p class="d-none" id="email-result">

                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn style1 w-100" onclick="sendEmailToUser(event)" type="submit">Submit</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn instant-enquiry w-100" href="<?php echo mk_get_whatsAppEnquiryLink();?>"  type="button">
                                    <i style="position: relative;top: 2px;" class="ri-whatsapp-line"></i> Instant Enquiry?</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function scrollDownToForm(form_title) {
                var targetElement = document.getElementById('quote-form');

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

            function sendEmailToUser(e) {
                e.preventDefault();
                $('.pleaese-wait').removeClass('d-none');
                $('#email-result').addClass('d-none');
                let formEL = $('#quoteForm');
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php', // URL to WordPress AJAX handler
                    data: formEL.serialize(),
                    success: function(response) {
                        if (response.succ == false) {
                            var errorMessage = response.error_string;
                            $('#email-result').html(errorMessage);
                            $('#email-result').removeClass('d-none');
                            $('#email-result').addClass('text-danger');
                            $('#email-result').removeClass('text-success');
                            $('.pleaese-wait').addClass('d-none');
                        } else {
                            $('#email-result').html(response.msg);
                            $('#email-result').removeClass('d-none');
                            $('#email-result').addClass('text-success');
                            $('#email-result').removeClass('text-danger');
                            $('.pleaese-wait').addClass('d-none');
                            formEL.trigger('reset');
                            // const myTimeout = setTimeout(hideFormResult, 2000);

                            function hideFormResult() {
                                $('#email-result').addClass('d-none');
                                window.location.reload();
                            }
                        }
                    },
                    error: function(response) {
                        // Handle errors if any
                        $('#email-result').html('Email sending failed. Please try again later.');
                    }
                });
            }
        </script>
<?php
    }
}
