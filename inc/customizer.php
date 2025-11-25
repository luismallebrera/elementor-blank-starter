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
 * Sección: Animate on Scroll
 */
new \Kirki\Section(
    'animate_on_scroll_section',
    array(
        'title'       => esc_html__('Animate on Scroll', 'elementor-blank-starter'),
        'panel'       => 'theme_options',
        'priority'    => 45,
    )
);

/**
 * Sección: Smooth Scrolling
 */
new \Kirki\Section(
    'smooth_scrolling_section',
    array(
        'title'       => esc_html__('Smooth Scrolling (Lenis)', 'elementor-blank-starter'),
        'panel'       => 'theme_options',
        'priority'    => 50,
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

