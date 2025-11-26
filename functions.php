<?php
/**
 * Elementor Blank Starter Theme
 * Tema optimizado para construir todo con Elementor
 */

// Soporte para Elementor
add_action('after_setup_theme', 'elementor_blank_setup');
function elementor_blank_setup() {
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para título del sitio
    add_theme_support('title-tag');
    
    // Soporte para Elementor
    add_theme_support('elementor');
    
    // Soporte para editor de bloques
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
}

// Registrar áreas de widgets para Elementor
add_action('widgets_init', 'elementor_blank_widgets_init');
function elementor_blank_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'elementor-blank-starter'),
        'id'            => 'sidebar-1',
        'description'   => __('Widget area for sidebar', 'elementor-blank-starter'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}

// Cargar estilos y scripts
add_action('wp_enqueue_scripts', 'elementor_blank_scripts');
function elementor_blank_scripts() {
    // Estilo principal
    wp_enqueue_style('elementor-blank-style', get_stylesheet_uri(), array(), '1.0');
    
    // Script personalizado
    wp_enqueue_script('elementor-blank-script', get_template_directory_uri() . '/scripts.js', array(), '1.0', true);
    
    // Smooth Scrolling con Lenis
    if (get_theme_mod('enable_smooth_scrolling', false)) {
        // Cargar Lenis desde CDN
        wp_enqueue_script('lenis', 'https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/dist/lenis.min.js', array(), '1.0.42', true);
        
        // Cargar GSAP y ScrollTrigger si está habilitado
        if (get_theme_mod('smooth_scrolling_gsap', false)) {
            wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
            wp_enqueue_script('scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);
        }
        
        // Cargar nuestro script de smooth scrolling
        wp_enqueue_script(
            'elementor-blank-smooth-scrolling',
            get_template_directory_uri() . '/js/smooth-scrolling.js',
            array('lenis'),
            '1.0',
            true
        );
        
        // Pasar parámetros al JavaScript
        wp_localize_script('elementor-blank-smooth-scrolling', 'elementorBlankSmoothScrollingParams', array(
            'smoothWheel'   => get_theme_mod('smooth_scrolling_disable_wheel', false) ? 0 : 1,
            'anchorOffset'  => intval(get_theme_mod('smooth_scrolling_anchor_offset', 0)),
            'lerp'          => floatval(get_theme_mod('smooth_scrolling_lerp', 0.07)),
            'duration'      => floatval(get_theme_mod('smooth_scrolling_duration', 1.2)),
            'anchorLinks'   => get_theme_mod('smooth_scrolling_anchor_links', false),
            'gsapSync'      => get_theme_mod('smooth_scrolling_gsap', false),
        ));
    }
    
    // Page Transitions
    if (get_theme_mod('enable_page_transitions', false)) {
        $transition_duration = intval(get_theme_mod('page_transitions_duration', 900));
        $transition_animation = get_theme_mod('page_transitions_animation', 'slide-down');
        $transition_color = get_theme_mod('page_transitions_color', '#000000');
        $transition_borders_color = get_theme_mod('page_transitions_borders_color', '#121e50');
        
        // Page Transitions CSS
        wp_enqueue_style(
            'elementor-blank-page-transitions',
            get_template_directory_uri() . '/css/page-transitions.css',
            array(),
            '5.1'
        );
        
        // Add inline CSS for dynamic settings
        $duration_seconds = ($transition_duration / 1000);
        
        // Define transform based on animation type
        $transform_from = 'scaleY(0)'; // Default slide-down
        $transform_origin = 'top';
        
        if ($transition_animation === 'slide-up') {
            $transform_from = 'scaleY(0)';
            $transform_origin = 'bottom';
        } elseif ($transition_animation === 'fade') {
            $transform_from = 'scaleY(1)';
            $transform_origin = 'top';
        }
        
        // Get transition position and set z-index accordingly
        $transition_position = get_theme_mod('page_transitions_position', 'under');
        $panel_z_index = ($transition_position === 'above') ? '99999' : '801';
        $borders_z_index = ($transition_position === 'above') ? '99998' : '800';
        
        // Build border CSS conditionally
        $enable_borders = get_theme_mod('enable_page_transitions_borders', true);
        $borders_css = '';
        if ($enable_borders) {
            $borders_css = "
                .transition-borders-bg {
                    background-color: {$transition_borders_color};
                    transition-duration: {$duration_seconds}s;
                    z-index: {$borders_z_index};
                }
            ";
        }
        
        // Build dynamic CSS based on animation type
        if ($transition_animation === 'fade') {
            // Fade needs opacity animation
            $custom_css = "
                .transition-pannel-bg {
                    background: {$transition_color};
                    transform: scaleY(1);
                    transform-origin: {$transform_origin};
                    opacity: 0;
                    z-index: {$panel_z_index};
                    transition-property: transform, opacity, visibility;
                    transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1), ease-in-out, step-end;
                    transition-duration: {$duration_seconds}s, {$duration_seconds}s, 0s;
                    transition-delay: 0s, 0s, {$duration_seconds}s;
                }
                .transition-pannel-bg.active {
                    opacity: 1;
                    visibility: visible;
                    transition-delay: 0s, 0s, 0s;
                }
                .transition-pannel-bg.initial-load {
                    opacity: 1 !important;
                    visibility: visible !important;
                    transform: scaleY(1) !important;
                    transition: none !important;
                }
                body.fade-entrance:not(.page-loaded) .transition-pannel-bg:not(.active) {
                    opacity: 1 !important;
                    visibility: visible !important;
                    transform: scaleY(1);
                    transition-property: transform, opacity, visibility;
                    transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1), ease-in-out, step-end;
                    transition-duration: {$duration_seconds}s, {$duration_seconds}s, 0s;
                }
                body.fade-entrance.page-loaded .transition-pannel-bg:not(.active) {
                    opacity: 0;
                    visibility: hidden;
                    transition-property: transform, opacity, visibility;
                    transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1), ease-in-out, step-end;
                    transition-duration: {$duration_seconds}s, {$duration_seconds}s, 0s;
                }
                {$borders_css}
            ";
        } else {
            // Slide animations without opacity
            // Inverted transform-origin for entrance
            $entrance_origin = ($transition_animation === 'slide-down') ? 'bottom' : 'top';
            
            $custom_css = "
                .transition-pannel-bg {
                    background: {$transition_color};
                    transform: {$transform_from};
                    transform-origin: {$transform_origin};
                    z-index: {$panel_z_index};
                    transition-duration: {$duration_seconds}s, 0s;
                    transition-delay: 0s, {$duration_seconds}s;
                }
                .transition-pannel-bg.active {
                    transition-delay: 0s, 0s;
                }
                .transition-pannel-bg.initial-load {
                    visibility: visible !important;
                    transform: scaleY(1) !important;
                    transition: none !important;
                }
                body.{$transition_animation}-entrance:not(.page-loaded) .transition-pannel-bg:not(.active) {
                    visibility: visible;
                    transform: scaleY(1);
                    transform-origin: {$entrance_origin};
                }
                body.{$transition_animation}-entrance.page-loaded .transition-pannel-bg:not(.active) {
                    transform: scaleY(0);
                    transform-origin: {$entrance_origin};
                }
                {$borders_css}
            ";
        }
        wp_add_inline_style('elementor-blank-page-transitions', $custom_css);
        
        wp_enqueue_script(
            'elementor-blank-page-transitions',
            get_template_directory_uri() . '/js/page-transitions.js',
            array('jquery'),
            '2.0',
            true
        );
        
        // Pasar parámetros al JavaScript
        wp_localize_script('elementor-blank-page-transitions', 'elementorBlankPageTransitions', array(
            'enabled'   => true,
            'duration'  => $transition_duration,
            'selectors' => get_theme_mod('page_transitions_selectors', '.menu li a, .elementor-widget-image > a, .soda-post-nav-next a, .soda-post-nav-prev a'),
            'animation' => $transition_animation,
            'enableEntrance' => get_theme_mod('enable_page_transitions_entrance', true),
        ));
    }
}

/**
 * Add body class for entrance animations
 */
add_filter('body_class', 'elementor_blank_entrance_body_class');
function elementor_blank_entrance_body_class($classes) {
    if (get_theme_mod('enable_page_transitions', false)) {
        $animation_type = get_theme_mod('page_transitions_animation', 'slide-down');
        $classes[] = $animation_type . '-entrance';
    }
    return $classes;
}

/**
 * Incluir Animate on Scroll plugin
 */
/**
 * Incluir Animate on Scroll plugin
 */
if (get_theme_mod('enable_animate_on_scroll', false)) {
    $aos_plugin = get_template_directory() . '/inc/animate-on-scroll/plugin.php';
    if (file_exists($aos_plugin)) {
        include_once $aos_plugin;
    }
    
    /**
     * Incluir Elementor Custom Class & Attributes Extension
     * Solo se carga cuando AOS está activado
     */
    $elementor_custom_class = get_template_directory() . '/inc/elementor-custom-class-attributes.php';
    if (file_exists($elementor_custom_class)) {
        include_once $elementor_custom_class;
    }
}

/**
 * Incluir Custom Post Types
 */
$custom_post_types = get_template_directory() . '/inc/custom-post-types.php';
if (file_exists($custom_post_types)) {
    include_once $custom_post_types;
}

/**
 * Incluir Kirki Framework
 * Incluimos Kirki directamente en el tema
 * Descarga el plugin desde: https://wordpress.org/plugins/kirki/
 * Copia la carpeta 'kirki' en inc/kirki-plugin/
 */
$kirki_main_file = get_template_directory() . '/inc/kirki-plugin/kirki.php';
if (file_exists($kirki_main_file)) {
    include_once $kirki_main_file;
}

// Verificar que Kirki esté disponible
if (class_exists('Kirki')) {
    /**
     * Configuración de Kirki
     */
    Kirki::add_config('elementor_blank_config', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
    ));

    /**
     * Añadir paneles y opciones de Kirki
     */
    require_once get_template_directory() . '/inc/customizer.php';
} else {
    /**
     * Mostrar aviso si Kirki no está disponible
     */
    add_action('admin_notices', 'elementor_blank_kirki_notice');
    function elementor_blank_kirki_notice() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><strong>Elementor Blank Starter:</strong> Kirki Framework no está incluido en el tema. 
            <br>Descarga el plugin desde <a href="https://wordpress.org/plugins/kirki/" target="_blank">WordPress.org</a> 
            y copia la carpeta 'kirki' en <code>inc/kirki-plugin/</code></p>
        </div>
        <?php
    }
}

/**
 * Output Grid Line CSS when enabled
 */
add_action('wp_head', 'elementor_blank_grid_line_styles');
function elementor_blank_grid_line_styles() {
    $grid_line_enable = get_theme_mod('grid_line_enable', false);
    
    if (!$grid_line_enable) {
        return;
    }

    // Get all grid line settings
    $line_color                = get_theme_mod('grid_line_line_color', '#eeeeee');
    $column_color              = get_theme_mod('grid_line_column_color', 'transparent');
    $columns                   = get_theme_mod('grid_line_columns', 12);
    $outline                   = get_theme_mod('grid_line_outline', false);
    $max_width                 = get_theme_mod('grid_line_max_width', '100%');
    $width_desktop             = get_theme_mod('grid_line_width_desktop', '100%');
    $width_tablet              = get_theme_mod('grid_line_width_tablet', '100%');
    $width_mobile_landscape    = get_theme_mod('grid_line_width_mobile_landscape', '100%');
    $width_mobile              = get_theme_mod('grid_line_width_mobile', '100%');
    $line_width                = get_theme_mod('grid_line_line_width', '1px');
    $direction                 = get_theme_mod('grid_line_direction', 90);
    $z_index                   = get_theme_mod('grid_line_z_index', 0);
    
    // Get breakpoints
    $breakpoint_desktop         = get_theme_mod('grid_line_breakpoint_desktop', 1024);
    $breakpoint_tablet          = get_theme_mod('grid_line_breakpoint_tablet', 768);
    $breakpoint_mobile_landscape = get_theme_mod('grid_line_breakpoint_mobile_landscape', 420);

    // Build outline styles
    $outline_style = '';
    if ($outline) {
        $outline_style = 'outline: ' . $line_width . ' solid ' . $line_color . ';';
    }

    ?>
    <style type="text/css">
        :root {
            --grid-line-color: <?php echo esc_attr($line_color); ?>;
            --grid-line-column-color: <?php echo esc_attr($column_color); ?>;
            --grid-line-columns: <?php echo (int) $columns; ?>;
            --grid-line-max-width: <?php echo esc_attr($max_width); ?>;
            --grid-line-thickness: <?php echo esc_attr($line_width); ?>;
            --grid-line-direction: <?php echo (int) $direction; ?>deg;
            --grid-line-z-index: <?php echo (int) $z_index; ?>;
        }
        
        /* Desktop */
        @media (min-width: <?php echo (int) $breakpoint_desktop; ?>px) {
            :root {
                --grid-line-width: <?php echo esc_attr($width_desktop); ?>;
            }
        }
        
        /* Tablet */
        @media (min-width: <?php echo (int) $breakpoint_tablet; ?>px) and (max-width: <?php echo ((int) $breakpoint_desktop - 1); ?>px) {
            :root {
                --grid-line-width: <?php echo esc_attr($width_tablet); ?>;
            }
        }
        
        /* Mobile Landscape */
        @media (min-width: <?php echo (int) $breakpoint_mobile_landscape; ?>px) and (max-width: <?php echo ((int) $breakpoint_tablet - 1); ?>px) {
            :root {
                --grid-line-width: <?php echo esc_attr($width_mobile_landscape); ?>;
            }
        }
        
        /* Mobile */
        @media (max-width: <?php echo ((int) $breakpoint_mobile_landscape - 1); ?>px) {
            :root {
                --grid-line-width: <?php echo esc_attr($width_mobile); ?>;
            }
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            margin-right: auto;
            margin-left: auto;
            pointer-events: none;
            z-index: var(--grid-line-z-index, 0);
            min-height: 100vh;
            width: calc(var(--grid-line-width) - (2 * 0px));
            max-width: var(--grid-line-max-width, 100%);
            background-size: calc(100% + var(--grid-line-thickness, 1px)) 100%;
            background-image: repeating-linear-gradient(var(--grid-line-direction, 90deg), var(--grid-line-column-color, transparent), var(--grid-line-column-color, transparent) calc((100% / var(--grid-line-columns, 12)) - var(--grid-line-thickness, 1px)), var(--grid-line-color, #eee) calc((100% / var(--grid-line-columns, 12)) - var(--grid-line-thickness, 1px)), var(--grid-line-color, #eee) calc(100% / var(--grid-line-columns, 12)));
            <?php echo $outline_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        }
    </style>
    <?php
}
