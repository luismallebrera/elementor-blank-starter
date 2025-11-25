<?php
/**
 * Customizer Settings usando Kirki
 */

/**
 * Panel General del Tema
 */
Kirki::add_panel('theme_options', array(
    'priority'    => 10,
    'title'       => esc_html__('Theme Options', 'elementor-blank-starter'),
    'description' => esc_html__('Opciones generales del tema', 'elementor-blank-starter'),
));

/**
 * Sección: Colores
 */
Kirki::add_section('colors_section', array(
    'title'       => esc_html__('Colores', 'elementor-blank-starter'),
    'description' => esc_html__('Personaliza los colores del tema', 'elementor-blank-starter'),
    'panel'       => 'theme_options',
    'priority'    => 10,
));

// Color primario
Kirki::add_field('elementor_blank_config', array(
    'type'        => 'color',
    'settings'    => 'primary_color',
    'label'       => esc_html__('Color Primario', 'elementor-blank-starter'),
    'description' => esc_html__('Selecciona el color primario del tema', 'elementor-blank-starter'),
    'section'     => 'colors_section',
    'default'     => '#0073aa',
    'output'      => array(
        array(
            'element'  => ':root',
            'property' => '--primary-color',
        ),
    ),
));

// Color secundario
Kirki::add_field('elementor_blank_config', array(
    'type'        => 'color',
    'settings'    => 'secondary_color',
    'label'       => esc_html__('Color Secundario', 'elementor-blank-starter'),
    'description' => esc_html__('Selecciona el color secundario del tema', 'elementor-blank-starter'),
    'section'     => 'colors_section',
    'default'     => '#23282d',
    'output'      => array(
        array(
            'element'  => ':root',
            'property' => '--secondary-color',
        ),
    ),
));

/**
 * Sección: Tipografía
 */
Kirki::add_section('typography_section', array(
    'title'       => esc_html__('Tipografía', 'elementor-blank-starter'),
    'description' => esc_html__('Personaliza la tipografía del tema', 'elementor-blank-starter'),
    'panel'       => 'theme_options',
    'priority'    => 20,
));

// Fuente del cuerpo
Kirki::add_field('elementor_blank_config', array(
    'type'        => 'typography',
    'settings'    => 'body_typography',
    'label'       => esc_html__('Tipografía del Cuerpo', 'elementor-blank-starter'),
    'section'     => 'typography_section',
    'default'     => array(
        'font-family'    => 'Arial',
        'variant'        => 'regular',
        'font-size'      => '16px',
        'line-height'    => '1.6',
        'letter-spacing' => '0',
    ),
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
));

// Fuente de encabezados
Kirki::add_field('elementor_blank_config', array(
    'type'        => 'typography',
    'settings'    => 'heading_typography',
    'label'       => esc_html__('Tipografía de Encabezados', 'elementor-blank-starter'),
    'section'     => 'typography_section',
    'default'     => array(
        'font-family'    => 'Georgia',
        'variant'        => 'bold',
        'line-height'    => '1.2',
        'letter-spacing' => '0',
    ),
    'output'      => array(
        array(
            'element' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
        ),
    ),
));

/**
 * Sección: Layout
 */
Kirki::add_section('layout_section', array(
    'title'       => esc_html__('Layout', 'elementor-blank-starter'),
    'description' => esc_html__('Opciones de diseño y estructura', 'elementor-blank-starter'),
    'panel'       => 'theme_options',
    'priority'    => 30,
));

// Ancho del contenedor
Kirki::add_field('elementor_blank_config', array(
    'type'        => 'slider',
    'settings'    => 'container_width',
    'label'       => esc_html__('Ancho del Contenedor', 'elementor-blank-starter'),
    'description' => esc_html__('Ancho máximo del contenedor en píxeles', 'elementor-blank-starter'),
    'section'     => 'layout_section',
    'default'     => 1200,
    'choices'     => array(
        'min'  => 960,
        'max'  => 1920,
        'step' => 10,
    ),
    'output'      => array(
        array(
            'element'  => ':root',
            'property' => '--container-width',
            'units'    => 'px',
        ),
    ),
));

/**
 * Sección: Custom CSS
 */
Kirki::add_section('custom_css_section', array(
    'title'       => esc_html__('CSS Personalizado', 'elementor-blank-starter'),
    'description' => esc_html__('Añade tu CSS personalizado', 'elementor-blank-starter'),
    'panel'       => 'theme_options',
    'priority'    => 40,
));

// CSS personalizado
Kirki::add_field('elementor_blank_config', array(
    'type'        => 'code',
    'settings'    => 'custom_css',
    'label'       => esc_html__('CSS Personalizado', 'elementor-blank-starter'),
    'description' => esc_html__('Añade tu código CSS personalizado aquí', 'elementor-blank-starter'),
    'section'     => 'custom_css_section',
    'default'     => '',
    'choices'     => array(
        'language' => 'css',
    ),
));

/**
 * Añadir CSS personalizado al head
 */
add_action('wp_head', 'elementor_blank_custom_css_output');
function elementor_blank_custom_css_output() {
    $custom_css = get_theme_mod('custom_css', '');
    if (!empty($custom_css)) {
        echo '<style type="text/css">' . wp_strip_all_tags($custom_css) . '</style>';
    }
}

/**
 * Sección: Smooth Scrolling
 */
new \Kirki\Section(
    'smooth_scrolling_section',
    array(
        'title'    => esc_html__('Smooth Scrolling (Lenis)', 'elementor-blank-starter'),
        'priority' => 50,
    )
);

/**
 * Sección: Animate on Scroll
 */
new \Kirki\Section(
    'animate_on_scroll_section',
    array(
        'title'    => esc_html__('Animate on Scroll', 'elementor-blank-starter'),
        'priority' => 51,
    )
);

/**
 * Enable Animate on Scroll
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'enable_animate_on_scroll',
        'label'       => esc_html__('Enable Animate on Scroll', 'elementor-blank-starter'),
        'description' => esc_html__('Enable the animate on scroll plugin functionality.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Enabled', 'elementor-blank-starter'),
            'off' => esc_html__('Disabled', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Enable Smooth Scrolling
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'enable_smooth_scrolling',
        'label'       => esc_html__('Enable Smooth Scrolling', 'elementor-blank-starter'),
        'description' => esc_html__('Enable Lenis smooth scrolling on your website.', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Enabled', 'elementor-blank-starter'),
            'off' => esc_html__('Disabled', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Disable Mouse Wheel
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'smooth_scrolling_disable_wheel',
        'label'       => esc_html__('Disable Mouse Wheel', 'elementor-blank-starter'),
        'description' => esc_html__('Disable smooth scrolling for mouse wheel.', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Smooth Anchor Links
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'smooth_scrolling_anchor_links',
        'label'       => esc_html__('Smooth Anchor Links', 'elementor-blank-starter'),
        'description' => esc_html__('Enable smooth scrolling for anchor links.', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Synchronize with GSAP/ScrollTrigger
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'smooth_scrolling_gsap',
        'label'       => esc_html__('Synchronize with GSAP/ScrollTrigger', 'elementor-blank-starter'),
        'description' => esc_html__('Enable GSAP ScrollTrigger synchronization.', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Anchor Link Offset
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'smooth_scrolling_anchor_offset',
        'label'       => esc_html__('Smooth Anchor Link Offset (px)', 'elementor-blank-starter'),
        'description' => esc_html__('Offset for smooth anchor links in pixels.', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => 0,
        'choices'     => array(
            'min'  => 0,
            'max'  => 500,
            'step' => 1,
        ),
    )
);

/**
 * Linear Interpolation (lerp)
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'smooth_scrolling_lerp',
        'label'       => esc_html__('Linear Interpolation (lerp) Intensity', 'elementor-blank-starter'),
        'description' => esc_html__('Between 0 and 1. Lower = smoother. Set to 0 to use duration instead. Default: 0.07', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => 0.07,
        'choices'     => array(
            'min'  => 0,
            'max'  => 1,
            'step' => 0.01,
        ),
    )
);

/**
 * Duration of Scroll Animation
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'smooth_scrolling_duration',
        'label'       => esc_html__('Duration of Scroll Animation (seconds)', 'elementor-blank-starter'),
        'description' => esc_html__('Set lerp to 0 to use this value. Default: 1.2', 'elementor-blank-starter'),
        'section'     => 'smooth_scrolling_section',
        'default'     => 1.2,
        'choices'     => array(
            'min'  => 0,
            'max'  => 5,
            'step' => 0.1,
        ),
    )
);

