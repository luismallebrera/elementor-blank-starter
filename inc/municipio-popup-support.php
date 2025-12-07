<?php
/**
 * Municipio Popup Support
 * Simple page reload approach with municipio_id parameter
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * JavaScript to auto-open popup and modify entry list links
 */
function elementor_blank_popup_auto_open_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Modify Entry List links to add municipio_id and reload page
        $('.entry-list-item a, .elementor-post a').each(function() {
            var $link = $(this);
            var postId = $link.closest('[data-id]').attr('data-id') || $link.attr('data-id');
            
            if (postId) {
                var currentUrl = window.location.pathname;
                $link.attr('href', currentUrl + '?municipio_id=' + postId);
            }
        });
        
        // Auto-open popup if municipio_id is in URL
        const urlParams = new URLSearchParams(window.location.search);
        const municipioId = urlParams.get('municipio_id');
        
        if (municipioId && typeof elementorProFrontend !== 'undefined') {
            setTimeout(function() {
                elementorProFrontend.modules.popup.showPopup({ id: 7468 });
            }, 500);
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'elementor_blank_popup_auto_open_script');
