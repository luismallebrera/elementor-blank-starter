<?php
/**
 * Municipio Popup Support
 * Load municipio content dynamically via AJAX
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * AJAX handler to get municipio data
 */
function elementor_blank_get_municipio_data() {
    $municipio_id = isset($_GET['municipio_id']) ? absint($_GET['municipio_id']) : 0;
    
    if (!$municipio_id) {
        wp_send_json_error('No municipio ID provided');
    }
    
    $post = get_post($municipio_id);
    
    if (!$post || $post->post_type !== 'municipio') {
        wp_send_json_error('Invalid municipio ID');
    }
    
    $galgdr_id = get_post_meta($municipio_id, '_municipio_galgdr_asociado', true);
    $provincia_id = get_post_meta($municipio_id, '_municipio_provincia', true);
    
    $galgdr_name = $galgdr_id ? get_the_title($galgdr_id) : '';
    $provincia_name = '';
    
    if ($provincia_id) {
        $term = get_term($provincia_id, 'provincia');
        if ($term && !is_wp_error($term)) {
            $provincia_name = $term->name;
        }
    }
    
    wp_send_json_success(array(
        'id' => $municipio_id,
        'title' => get_the_title($municipio_id),
        'content' => apply_filters('the_content', $post->post_content),
        'galgdr_id' => $galgdr_id,
        'galgdr_name' => $galgdr_name,
        'provincia_id' => $provincia_id,
        'provincia_name' => $provincia_name,
    ));
}
add_action('wp_ajax_get_municipio_data', 'elementor_blank_get_municipio_data');
add_action('wp_ajax_nopriv_get_municipio_data', 'elementor_blank_get_municipio_data');

/**
 * JavaScript to load municipio data and populate popup
 */
function elementor_blank_popup_dynamic_loader() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // When popup opens, load municipio data
        $(document).on('elementor/popup/show', function(event, id, instance) {
            if (id == 7468) { // Your popup ID
                const urlParams = new URLSearchParams(window.location.search);
                const municipioId = urlParams.get('municipio_id');
                
                if (municipioId) {
                    // Load municipio data via AJAX
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        data: {
                            action: 'get_municipio_data',
                            municipio_id: municipioId
                        },
                        success: function(response) {
                            if (response.success) {
                                const data = response.data;
                                
                                // Update popup content with municipio data
                                // You'll need to add classes/IDs to your popup elements
                                $('.municipio-title').text(data.title);
                                $('.municipio-content').html(data.content);
                                $('.municipio-galgdr').text(data.galgdr_name);
                                $('.municipio-provincia').text(data.provincia_name);
                            }
                        }
                    });
                }
            }
        });
        
        // Auto-open popup if municipio_id in URL
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
add_action('wp_footer', 'elementor_blank_popup_dynamic_loader');
