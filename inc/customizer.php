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

/**
 * Sección: Grid Line Overlay
 */
new \Kirki\Section(
    'grid_line_section',
    array(
        'title'       => esc_html__('Grid Line Overlay', 'elementor-blank-starter'),
        'panel'       => 'theme_options',
        'priority'    => 60,
    )
);

/**
 * Enable Grid Line
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'grid_line_enable',
        'label'       => esc_html__('Enable Grid Line', 'elementor-blank-starter'),
        'description' => esc_html__('Display a grid line overlay on the page.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Enabled', 'elementor-blank-starter'),
            'off' => esc_html__('Disabled', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Line Color
 */
new \Kirki\Field\Color(
    array(
        'settings'    => 'grid_line_line_color',
        'label'       => esc_html__('Line Color', 'elementor-blank-starter'),
        'description' => esc_html__('Color of the grid lines.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '#eeeeee',
        'choices'     => array(
            'alpha' => true,
        ),
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-color',
            ),
        ),
    )
);

/**
 * Column Color
 */
new \Kirki\Field\Color(
    array(
        'settings'    => 'grid_line_column_color',
        'label'       => esc_html__('Column Color', 'elementor-blank-starter'),
        'description' => esc_html__('Background color between lines.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 'transparent',
        'choices'     => array(
            'alpha' => true,
        ),
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-column-color',
            ),
        ),
    )
);

/**
 * Number of Columns
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'grid_line_columns',
        'label'       => esc_html__('Number of Columns', 'elementor-blank-starter'),
        'description' => esc_html__('Number of grid columns to display.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 12,
        'choices'     => array(
            'min'  => 1,
            'max'  => 24,
            'step' => 1,
        ),
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-columns',
            ),
        ),
    )
);

/**
 * Grid Outline
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings' => 'grid_line_outline',
        'label'    => esc_html__('Grid Outline', 'elementor-blank-starter'),
        'section'  => 'grid_line_section',
        'default'  => false,
        'choices'  => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Grid Max Width
 */
new \Kirki\Field\Dimension(
    array(
        'settings'    => 'grid_line_max_width',
        'label'       => esc_html__('Grid Max Width', 'elementor-blank-starter'),
        'description' => esc_html__('Maximum width of the grid overlay.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '100%',
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-max-width',
            ),
        ),
    )
);

/**
 * Grid Width
 */
new \Kirki\Field\Dimensions(
    array(
        'settings'    => 'grid_line_the_width',
        'label'       => esc_html__('Grid Width', 'elementor-blank-starter'),
        'description' => esc_html__('Width of the grid container.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'responsive'  => true,
        'default'     => array(
            'desktop' => array(
                'width' => '100%',
            ),
            'tablet'  => array(
                'width' => '100%',
            ),
            'mobile'  => array(
                'width' => '100%',
            ),
        ),
        'choices'     => array(
            'labels' => array(
                'width' => esc_html__('Width', 'elementor-blank-starter'),
            ),
        ),
        'output'      => array(
            array(
                'element'     => 'body',
                'property'    => '--grid-line-width',
                'media_query' => array(
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 767px)',
                ),
            ),
        ),
    )
);

/**
 * Line Width
 */
new \Kirki\Field\Dimension(
    array(
        'settings'    => 'grid_line_line_width',
        'label'       => esc_html__('Line Width', 'elementor-blank-starter'),
        'description' => esc_html__('Thickness of each grid line.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '1px',
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-thickness',
            ),
        ),
    )
);

/**
 * Line Direction
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'grid_line_direction',
        'label'       => esc_html__('Line Direction (degrees)', 'elementor-blank-starter'),
        'description' => esc_html__('Angle of the grid lines.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 90,
        'choices'     => array(
            'min'  => -360,
            'max'  => 360,
            'step' => 15,
        ),
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-direction',
                'suffix'   => 'deg',
            ),
        ),
    )
);

/**
 * Z-Index
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'grid_line_z_index',
        'label'       => esc_html__('Z-Index', 'elementor-blank-starter'),
        'description' => esc_html__('Stacking order of the grid overlay.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 0,
        'choices'     => array(
            'min'  => -9999,
            'max'  => 9999,
            'step' => 1,
        ),
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => '--grid-line-z-index',
            ),
        ),
    )
);
