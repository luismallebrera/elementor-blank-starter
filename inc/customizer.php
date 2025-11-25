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
 * Sección: Page Transitions
 */
new \Kirki\Section(
    'page_transitions_section',
    array(
        'title'       => esc_html__('Page Transitions', 'elementor-blank-starter'),
        'panel'       => 'theme_options',
        'priority'    => 55,
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
 * AOS Duration
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'aos_duration',
        'label'       => esc_html__('Animation Duration (ms)', 'elementor-blank-starter'),
        'description' => esc_html__('Duration of animations in milliseconds.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => 800,
        'choices'     => array(
            'min'  => 100,
            'max'  => 3000,
            'step' => 50,
        ),
    )
);

/**
 * AOS Easing
 */
new \Kirki\Field\Select(
    array(
        'settings'    => 'aos_easing',
        'label'       => esc_html__('Animation Easing', 'elementor-blank-starter'),
        'description' => esc_html__('Easing function for animations.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => 'ease-in-out',
        'choices'     => array(
            'linear'        => esc_html__('Linear', 'elementor-blank-starter'),
            'ease'          => esc_html__('Ease', 'elementor-blank-starter'),
            'ease-in'       => esc_html__('Ease In', 'elementor-blank-starter'),
            'ease-out'      => esc_html__('Ease Out', 'elementor-blank-starter'),
            'ease-in-out'   => esc_html__('Ease In Out', 'elementor-blank-starter'),
            'ease-in-back'  => esc_html__('Ease In Back', 'elementor-blank-starter'),
            'ease-out-back' => esc_html__('Ease Out Back', 'elementor-blank-starter'),
            'ease-in-out-back' => esc_html__('Ease In Out Back', 'elementor-blank-starter'),
        ),
    )
);

/**
 * AOS Once
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'aos_once',
        'label'       => esc_html__('Animate Once', 'elementor-blank-starter'),
        'description' => esc_html__('Animation occurs only once when scrolling down.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => true,
        'choices'     => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
        ),
    )
);

/**
 * AOS Mirror
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'aos_mirror',
        'label'       => esc_html__('Mirror Animation', 'elementor-blank-starter'),
        'description' => esc_html__('Whether elements should animate out while scrolling past them.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
        ),
    )
);

/**
 * AOS Offset
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'aos_offset',
        'label'       => esc_html__('Animation Offset (px)', 'elementor-blank-starter'),
        'description' => esc_html__('Offset (in px) from the original trigger point.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => 120,
        'choices'     => array(
            'min'  => 0,
            'max'  => 500,
            'step' => 10,
        ),
    )
);

/**
 * AOS Disable on Mobile
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'aos_disable_mobile',
        'label'       => esc_html__('Disable on Mobile', 'elementor-blank-starter'),
        'description' => esc_html__('Disable animations on mobile devices for better performance.', 'elementor-blank-starter'),
        'section'     => 'animate_on_scroll_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Yes', 'elementor-blank-starter'),
            'off' => esc_html__('No', 'elementor-blank-starter'),
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
 * Enable Page Transitions
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'enable_page_transitions',
        'label'       => esc_html__('Enable Page Transitions', 'elementor-blank-starter'),
        'description' => esc_html__('Enable smooth transitions between page navigation.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => false,
        'choices'     => array(
            'on'  => esc_html__('Enabled', 'elementor-blank-starter'),
            'off' => esc_html__('Disabled', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Transition Duration
 */
new \Kirki\Field\Slider(
    array(
        'settings'    => 'page_transitions_duration',
        'label'       => esc_html__('Transition Duration (ms)', 'elementor-blank-starter'),
        'description' => esc_html__('Duration of the transition animation in milliseconds.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => 900,
        'choices'     => array(
            'min'  => 100,
            'max'  => 3000,
            'step' => 50,
        ),
    )
);

/**
 * Transition Animation Type
 */
new \Kirki\Field\Select(
    array(
        'settings'    => 'page_transitions_animation',
        'label'       => esc_html__('Animation Type', 'elementor-blank-starter'),
        'description' => esc_html__('Choose the animation style for page transitions.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => 'slide-down',
        'choices'     => array(
            'slide-down'        => esc_html__('Slide Down (from top)', 'elementor-blank-starter'),
            'slide-up'          => esc_html__('Slide Up (from bottom)', 'elementor-blank-starter'),
            'fade'              => esc_html__('Fade', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Transition Panel Color
 */
new \Kirki\Field\Color(
    array(
        'settings'    => 'page_transitions_color',
        'label'       => esc_html__('Panel Color', 'elementor-blank-starter'),
        'description' => esc_html__('Background color of the transition panel.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => '#000000',
    )
);

/**
 * Enable Transition Borders
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'enable_page_transitions_borders',
        'label'       => esc_html__('Enable Transition Borders', 'elementor-blank-starter'),
        'description' => esc_html__('Enable border frame animation during page transitions.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => true,
        'choices'     => array(
            'on'  => esc_html__('Enabled', 'elementor-blank-starter'),
            'off' => esc_html__('Disabled', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Enable Entrance Animation
 */
new \Kirki\Field\Checkbox_Switch(
    array(
        'settings'    => 'enable_page_transitions_entrance',
        'label'       => esc_html__('Enable Entrance Animation', 'elementor-blank-starter'),
        'description' => esc_html__('Enable entrance animation on page load.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => true,
        'choices'     => array(
            'on'  => esc_html__('Enabled', 'elementor-blank-starter'),
            'off' => esc_html__('Disabled', 'elementor-blank-starter'),
        ),
    )
);

/**
 * Transition Borders Color
 */
new \Kirki\Field\Color(
    array(
        'settings'    => 'page_transitions_borders_color',
        'label'       => esc_html__('Borders Color', 'elementor-blank-starter'),
        'description' => esc_html__('Background color of the transition borders.', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => '#121e50',
        'active_callback' => array(
            array(
                'setting'  => 'enable_page_transitions_borders',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    )
);

/**
 * Click Selectors
 */
new \Kirki\Field\Textarea(
    array(
        'settings'    => 'page_transitions_selectors',
        'label'       => esc_html__('Click Selectors', 'elementor-blank-starter'),
        'description' => esc_html__('CSS selectors for elements that trigger transitions (comma-separated).', 'elementor-blank-starter'),
        'section'     => 'page_transitions_section',
        'default'     => '.menu li a, .elementor-widget-image > a, .soda-post-nav-next a, .soda-post-nav-prev a',
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
 * Breakpoints Section Header
 */
new \Kirki\Field\Custom(
    array(
        'settings' => 'grid_line_breakpoints_title',
        'section'  => 'grid_line_section',
        'default'  => '<h3 style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;">' . esc_html__('Breakpoints (px)', 'elementor-blank-starter') . '</h3>',
    )
);

/**
 * Desktop Breakpoint
 */
new \Kirki\Field\Number(
    array(
        'settings'    => 'grid_line_breakpoint_desktop',
        'label'       => esc_html__('Desktop Min Width', 'elementor-blank-starter'),
        'description' => esc_html__('Minimum width for desktop (default: 1024px)', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 1024,
        'choices'     => array(
            'min'  => 0,
            'max'  => 3000,
            'step' => 1,
        ),
    )
);

/**
 * Tablet Landscape Breakpoint
 */
new \Kirki\Field\Number(
    array(
        'settings'    => 'grid_line_breakpoint_tablet',
        'label'       => esc_html__('Tablet Min Width', 'elementor-blank-starter'),
        'description' => esc_html__('Minimum width for tablet (default: 768px)', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 768,
        'choices'     => array(
            'min'  => 0,
            'max'  => 3000,
            'step' => 1,
        ),
    )
);

/**
 * Mobile Landscape Breakpoint
 */
new \Kirki\Field\Number(
    array(
        'settings'    => 'grid_line_breakpoint_mobile_landscape',
        'label'       => esc_html__('Mobile Landscape Min Width', 'elementor-blank-starter'),
        'description' => esc_html__('Minimum width for mobile landscape (default: 420px)', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => 420,
        'choices'     => array(
            'min'  => 0,
            'max'  => 3000,
            'step' => 1,
        ),
    )
);

/**
 * Grid Settings Section Header
 */
new \Kirki\Field\Custom(
    array(
        'settings' => 'grid_line_settings_title',
        'section'  => 'grid_line_section',
        'default'  => '<h3 style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;">' . esc_html__('Grid Settings', 'elementor-blank-starter') . '</h3>',
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
 * Grid Width Section Header
 */
new \Kirki\Field\Custom(
    array(
        'settings' => 'grid_line_width_title',
        'section'  => 'grid_line_section',
        'default'  => '<h3 style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;">' . esc_html__('Grid Widths per Breakpoint', 'elementor-blank-starter') . '</h3>',
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
    )
);

/**
 * Grid Width Desktop
 */
new \Kirki\Field\Dimension(
    array(
        'settings'    => 'grid_line_width_desktop',
        'label'       => esc_html__('Grid Width (Desktop)', 'elementor-blank-starter'),
        'description' => esc_html__('Width of the grid container on desktop.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '100%',
    )
);

/**
 * Grid Width Tablet
 */
new \Kirki\Field\Dimension(
    array(
        'settings'    => 'grid_line_width_tablet',
        'label'       => esc_html__('Grid Width (Tablet)', 'elementor-blank-starter'),
        'description' => esc_html__('Width of the grid container on tablet.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '100%',
    )
);

/**
 * Grid Width Mobile Landscape
 */
new \Kirki\Field\Dimension(
    array(
        'settings'    => 'grid_line_width_mobile_landscape',
        'label'       => esc_html__('Grid Width (Mobile Landscape)', 'elementor-blank-starter'),
        'description' => esc_html__('Width of the grid container on mobile landscape.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '100%',
    )
);

/**
 * Grid Width Mobile
 */
new \Kirki\Field\Dimension(
    array(
        'settings'    => 'grid_line_width_mobile',
        'label'       => esc_html__('Grid Width (Mobile)', 'elementor-blank-starter'),
        'description' => esc_html__('Width of the grid container on mobile.', 'elementor-blank-starter'),
        'section'     => 'grid_line_section',
        'default'     => '100%',
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
