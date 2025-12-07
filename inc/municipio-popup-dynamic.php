<?php
/**
 * Municipio Popup Dynamic Content
 * Makes popup load dynamic content based on municipio_id parameter
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Override post ID for Elementor dynamic content based on municipio_id URL parameter
 */
function elementor_blank_municipio_popup_override_post_id($post_id) {
    // Check if municipio_id is in URL
    if (isset($_GET['municipio_id']) && !empty($_GET['municipio_id'])) {
        $municipio_id = absint($_GET['municipio_id']);
        
        // Verify it's a valid municipio post
        $post = get_post($municipio_id);
        if ($post && $post->post_type === 'municipio' && $post->post_status === 'publish') {
            return $municipio_id;
        }
    }
    
    return $post_id;
}
add_filter('elementor/theme/get_the_content_post_id', 'elementor_blank_municipio_popup_override_post_id', 10, 1);
add_filter('elementor/documents/get/post_id', 'elementor_blank_municipio_popup_override_post_id', 10, 1);

/**
 * Also override for get_the_ID() calls
 */
function elementor_blank_override_get_the_id($post_id) {
    if (isset($_GET['municipio_id']) && !empty($_GET['municipio_id'])) {
        $municipio_id = absint($_GET['municipio_id']);
        $post = get_post($municipio_id);
        
        if ($post && $post->post_type === 'municipio' && $post->post_status === 'publish') {
            return $municipio_id;
        }
    }
    
    return $post_id;
}
add_filter('the_post', 'elementor_blank_override_the_post_for_municipio', 10, 2);

function elementor_blank_override_the_post_for_municipio($post, $query) {
    if (isset($_GET['municipio_id']) && !empty($_GET['municipio_id'])) {
        $municipio_id = absint($_GET['municipio_id']);
        $municipio_post = get_post($municipio_id);
        
        if ($municipio_post && $municipio_post->post_type === 'municipio') {
            return $municipio_post;
        }
    }
    
    return $post;
}

/**
 * JavaScript to handle popup links properly
 */
function elementor_blank_municipio_popup_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Clean up href attributes that have municipio_id parameter
        $('a[href*="#popup-7468?municipio_id="]').each(function() {
            var href = $(this).attr('href');
            var matches = href.match(/municipio_id=(\d+)/);
            
            if (matches && matches[1]) {
                // Store municipio ID in data attribute
                $(this).attr('data-municipio-id', matches[1]);
                // Clean href to just the popup anchor
                $(this).attr('href', '#popup-7468');
            }
        });
        
        // Handle clicks on popup links
        $(document).on('click', 'a[href="#popup-7468"][data-municipio-id]', function(e) {
            e.preventDefault();
            
            var municipioId = $(this).attr('data-municipio-id');
            
            if (municipioId) {
                // Update URL with municipio_id parameter
                var newUrl = window.location.pathname + '?municipio_id=' + municipioId + '#popup-7468';
                window.history.pushState({}, '', newUrl);
                
                // Open popup
                if (typeof elementorProFrontend !== 'undefined') {
                    elementorProFrontend.modules.popup.showPopup({ id: 7468 });
                } else {
                    window.location.href = newUrl;
                }
            }
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'elementor_blank_municipio_popup_script');
