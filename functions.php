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
            'lerp'          => floatval(get_theme_mod('smooth_scrolling_lerp', 0.1)),
            'duration'      => floatval(get_theme_mod('smooth_scrolling_duration', 1.2)),
            'anchorLinks'   => get_theme_mod('smooth_scrolling_anchor_links', false),
            'gsapSync'      => get_theme_mod('smooth_scrolling_gsap', false),
        ));
    }
}

// Remover la barra de administración del frontend si lo deseas
// add_filter('show_admin_bar', '__return_false');

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
