<?php
// Enable featured images
add_theme_support('post-thumbnails');

// Elementor compatibility
add_action('after_setup_theme', function() {
    add_theme_support('elementor');
});

// Enqueue scripts.js
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script(
        'blank-starter-script',
        get_template_directory_uri() . '/scripts.js',
        array(),    // No dependencies
        false,      // No versioning
        true        // Load in footer
    );
});