<?php

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('fontawesom-icons', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
    wp_enqueue_style('iconpicker-style', plugin_dir_url(__FILE__) . 'assets/css/fontawesome-iconpicker.min.css');
    wp_enqueue_script('iconpicker-script', plugin_dir_url(__FILE__) . 'assets/js/fontawesome-iconpicker.min.js');
    wp_enqueue_script('admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin.js');
});