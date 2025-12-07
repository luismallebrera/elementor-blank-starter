<?php
/**
 * Municipio Search Widget for Elementor
 * Two-step search: Province → Municipality
 */

if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Municipio_Search_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'municipio_search';
    }

    public function get_title() {
        return __('Buscador de Municipios', 'elementor-blank-starter');
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Configuración', 'elementor-blank-starter'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'popup_id',
            [
                'label' => __('ID del Popup', 'elementor-blank-starter'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '7468',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $popup_id = $settings['popup_id'];
        
        // Get all provincias
        $provincias = get_terms([
            'taxonomy' => 'provincia',
            'hide_empty' => false,
        ]);
        
        ?>
        <div class="municipio-search-widget">
            <div class="search-step search-provincia">
                <label for="provincia-select"><?php _e('Selecciona Provincia:', 'elementor-blank-starter'); ?></label>
                <select id="provincia-select" class="provincia-select">
                    <option value=""><?php _e('-- Selecciona una provincia --', 'elementor-blank-starter'); ?></option>
                    <?php foreach ($provincias as $provincia): ?>
                        <option value="<?php echo esc_attr($provincia->term_id); ?>">
                            <?php echo esc_html($provincia->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="search-step search-municipio" style="display: none; margin-top: 20px;">
                <label for="municipio-select"><?php _e('Selecciona Municipio:', 'elementor-blank-starter'); ?></label>
                <select id="municipio-select" class="municipio-select">
                    <option value=""><?php _e('-- Selecciona un municipio --', 'elementor-blank-starter'); ?></option>
                </select>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            var popupId = <?php echo intval($popup_id); ?>;
            
            // When provincia changes, load municipios
            $('#provincia-select').on('change', function() {
                var provinciaId = $(this).val();
                
                if (!provinciaId) {
                    $('.search-municipio').hide();
                    return;
                }
                
                // Load municipios for selected provincia
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        action: 'get_municipios_by_provincia',
                        provincia_id: provinciaId
                    },
                    success: function(response) {
                        if (response.success) {
                            var $select = $('#municipio-select');
                            $select.empty();
                            $select.append('<option value=""><?php _e('-- Selecciona un municipio --', 'elementor-blank-starter'); ?></option>');
                            
                            $.each(response.data, function(i, municipio) {
                                $select.append('<option value="' + municipio.id + '">' + municipio.title + '</option>');
                            });
                            
                            $('.search-municipio').show();
                        }
                    }
                });
            });
            
            // When municipio is selected, redirect with parameter and open popup
            $('#municipio-select').on('change', function() {
                var municipioId = $(this).val();
                
                if (municipioId) {
                    // Redirect to current page with municipio_id parameter
                    window.location.href = window.location.pathname + '?municipio_id=' + municipioId;
                }
            });
        });
        </script>
        
        <style>
        .municipio-search-widget {
            padding: 20px;
        }
        .search-step {
            margin-bottom: 15px;
        }
        .search-step label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .search-step select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        </style>
        <?php
    }
}

/**
 * AJAX handler to get municipios by provincia
 */
function elementor_blank_get_municipios_by_provincia() {
    $provincia_id = isset($_GET['provincia_id']) ? absint($_GET['provincia_id']) : 0;
    
    if (!$provincia_id) {
        wp_send_json_error('No provincia ID provided');
    }
    
    // Get all municipios with this provincia
    $municipios = get_posts([
        'post_type' => 'municipio',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => '_municipio_provincia',
                'value' => $provincia_id,
                'compare' => '='
            ]
        ],
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
    
    $data = [];
    foreach ($municipios as $municipio) {
        $data[] = [
            'id' => $municipio->ID,
            'title' => $municipio->post_title
        ];
    }
    
    wp_send_json_success($data);
}
add_action('wp_ajax_get_municipios_by_provincia', 'elementor_blank_get_municipios_by_provincia');
add_action('wp_ajax_nopriv_get_municipios_by_provincia', 'elementor_blank_get_municipios_by_provincia');

/**
 * Register widget
 */
function elementor_blank_register_municipio_search_widget($widgets_manager) {
    require_once(__FILE__);
    $widgets_manager->register_widget_type(new Elementor_Municipio_Search_Widget());
}
add_action('elementor/widgets/widgets_registered', 'elementor_blank_register_municipio_search_widget');
