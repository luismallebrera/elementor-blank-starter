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
    
    // Script personalizado (si lo necesitas)
    wp_enqueue_script('elementor-blank-script', get_template_directory_uri() . '/scripts.js', array(), '1.0', true);
}

// Remover la barra de administración del frontend si lo deseas
// add_filter('show_admin_bar', '__return_false');

/**
 * Incluir Kirki Framework
 * https://github.com/themeum/kirki
 */
require_once get_template_directory() . '/inc/kirki/kirki.php';

/**
 * Configuración de Kirki
 */
add_action('after_setup_theme', 'elementor_blank_kirki_config');
function elementor_blank_kirki_config() {
    Kirki::add_config('elementor_blank_config', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
    ));
}

/**
 * Añadir paneles y opciones de Kirki
 */
require_once get_template_directory() . '/inc/customizer.php';
