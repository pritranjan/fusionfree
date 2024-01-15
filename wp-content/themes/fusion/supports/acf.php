<?php
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));  
}

include __DIR__ . '/blocks/main-banner.php';
include __DIR__ . '/blocks/our-services.php';
include __DIR__ . '/blocks/our-products.php';
include __DIR__ . '/blocks/our-clients.php';
include __DIR__ . '/blocks/our-projects.php';
include __DIR__ . '/blocks/projects.php';
include __DIR__ . '/blocks/text-content.php';
include __DIR__ . '/blocks/enquiry-form.php';
include __DIR__ . '/blocks/our-team.php';

