<?php
/**
 * Animate On Scroll (AOS) Plugin
 * Loads AOS library and initializes animations
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Enqueue AOS library from CDN
 */
function aos_enqueue_scripts() {
    // AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
        array(),
        '2.3.4'
    );
    
    // AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
        array(),
        '2.3.4',
        true
    );
    
    // AOS Initialization
    wp_add_inline_script(
        'aos-js',
        'document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                duration: 800,
                easing: "ease-in-out",
                once: true,
                mirror: false,
                offset: 120,
                disable: false,
                startEvent: "DOMContentLoaded",
                animatedClassName: "aos-animate",
                initClassName: "aos-init"
            });
        });'
    );
}
add_action( 'wp_enqueue_scripts', 'aos_enqueue_scripts' );
