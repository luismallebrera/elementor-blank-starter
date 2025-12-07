<?php
/**
 * Municipio Popup Support
 * Ensures popup content loads with correct municipio context
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Override the_ID() and get_the_ID() for popup with municipio_id parameter
 */
function elementor_blank_override_post_id_for_popup() {
    if (isset($_GET['municipio_id']) && !empty($_GET['municipio_id'])) {
        add_filter('the_post', 'elementor_blank_set_popup_municipio_post', 10, 2);
    }
}
add_action('wp', 'elementor_blank_override_post_id_for_popup');

function elementor_blank_set_popup_municipio_post($post, $query = null) {
    if (isset($_GET['municipio_id']) && !empty($_GET['municipio_id'])) {
        $municipio_id = absint($_GET['municipio_id']);
        $municipio_post = get_post($municipio_id);
        
        if ($municipio_post && $municipio_post->post_type === 'municipio') {
            global $post;
            $post = $municipio_post;
            setup_postdata($post);
            return $post;
        }
    }
    
    return $post;
}

/**
 * JavaScript to auto-open popup when municipio_id is in URL
 */
function elementor_blank_popup_auto_open_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Check if municipio_id is in URL
        const urlParams = new URLSearchParams(window.location.search);
        const municipioId = urlParams.get('municipio_id');
        
        if (municipioId && typeof elementorProFrontend !== 'undefined') {
            // Auto-open popup 7468 when municipio_id is present
            setTimeout(function() {
                elementorProFrontend.modules.popup.showPopup({ 
                    id: 7468,
                    toggle: false 
                });
            }, 500);
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'elementor_blank_popup_auto_open_script');
