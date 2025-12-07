<?php
/**
 * Municipio Popup Support
 * Auto-open popup when municipio_id is in URL
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * JavaScript to auto-open popup when municipio_id is in URL
 */
function elementor_blank_popup_auto_open_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
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
