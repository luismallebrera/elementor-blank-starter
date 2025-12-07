<?php
/**
 * Municipio Filter Widget
 * Two dropdowns: provincia -> municipio -> open popup
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode to display provincia and municipio filters
 */
function elementor_blank_municipio_filter_shortcode() {
    ob_start();
    ?>
    <div class="municipio-filter-wrapper">
        <div class="filter-row">
            <label for="provincia-select">Provincia:</label>
            <select id="provincia-select" class="municipio-filter-select">
                <option value="">Selecciona una provincia</option>
                <?php
                $provincias = get_terms(array(
                    'taxonomy' => 'provincia',
                    'hide_empty' => false,
                ));
                
                if ($provincias && !is_wp_error($provincias)) {
                    foreach ($provincias as $provincia) {
                        echo '<option value="' . esc_attr($provincia->term_id) . '">' . esc_html($provincia->name) . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        
        <div class="filter-row" style="display:none;" id="municipio-select-wrapper">
            <label for="municipio-select">Municipio:</label>
            <select id="municipio-select" class="municipio-filter-select">
                <option value="">Selecciona un municipio</option>
            </select>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // When provincia changes, load municipios
        $('#provincia-select').on('change', function() {
            const provinciaId = $(this).val();
            const $municipioWrapper = $('#municipio-select-wrapper');
            const $municipioSelect = $('#municipio-select');
            
            if (!provinciaId) {
                $municipioWrapper.hide();
                $municipioSelect.html('<option value="">Selecciona un municipio</option>');
                return;
            }
            
            // Load municipios via AJAX
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'get_municipios_by_provincia',
                    provincia_id: provinciaId
                },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        let options = '<option value="">Selecciona un municipio</option>';
                        response.data.forEach(function(municipio) {
                            options += '<option value="' + municipio.id + '">' + municipio.title + '</option>';
                        });
                        $municipioSelect.html(options);
                        $municipioWrapper.show();
                    } else {
                        $municipioSelect.html('<option value="">No hay municipios</option>');
                        $municipioWrapper.show();
                    }
                }
            });
        });
        
        // When municipio changes, reload page with municipio_id to open popup
        $('#municipio-select').on('change', function() {
            const municipioId = $(this).val();
            
            if (municipioId) {
                // Reload page with municipio_id parameter (will auto-open popup)
                const url = new URL(window.location);
                url.searchParams.set('municipio_id', municipioId);
                window.location.href = url.toString();
            }
        });
    });
    </script>
    
    <style>
    .municipio-filter-wrapper {
        margin: 20px 0;
    }
    .filter-row {
        margin-bottom: 15px;
    }
    .filter-row label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }
    .municipio-filter-select {
        width: 100%;
        max-width: 400px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('municipio_filter', 'elementor_blank_municipio_filter_shortcode');

/**
 * AJAX handler to get municipios by provincia
 */
function elementor_blank_get_municipios_by_provincia() {
    $provincia_id = isset($_GET['provincia_id']) ? absint($_GET['provincia_id']) : 0;
    
    if (!$provincia_id) {
        wp_send_json_success(array());
    }
    
    // Get all municipios with this provincia
    $municipios = get_posts(array(
        'post_type' => 'municipio',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_municipio_provincia',
                'value' => $provincia_id,
                'compare' => '='
            )
        )
    ));
    
    $result = array();
    foreach ($municipios as $municipio) {
        $result[] = array(
            'id' => $municipio->ID,
            'title' => $municipio->post_title
        );
    }
    
    wp_send_json_success($result);
}
add_action('wp_ajax_get_municipios_by_provincia', 'elementor_blank_get_municipios_by_provincia');
add_action('wp_ajax_nopriv_get_municipios_by_provincia', 'elementor_blank_get_municipios_by_provincia');
