<?php
/**
 * Scroll Indicator Settings
 * Add customizer controls for vertical scroll indicator
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Scroll Indicator Section to Theme Options
 */
new \Kirki\Section(
    'scroll_indicator_section',
    [
        'title'       => esc_html__('Scroll Indicator', 'elementor-blank-starter'),
        'panel'       => 'theme_options',
        'priority'    => 50,
    ]
);

/**
 * Enable Scroll Indicator
 */
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'enable_scroll_indicator',
        'label'       => esc_html__('Enable Scroll Indicator', 'elementor-blank-starter'),
        'description' => esc_html__('Show a vertical scroll progress indicator', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => false,
    ]
);

/**
 * Scroll Indicator Color
 */
new \Kirki\Field\Color(
    [
        'settings'    => 'scroll_indicator_color',
        'label'       => esc_html__('Indicator Color', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => '#313C59',
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Scroll Indicator Width
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_indicator_width',
        'label'       => esc_html__('Indicator Width', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 4,
        'choices'     => [
            'min'  => 1,
            'max'  => 20,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Horizontal Position
 */
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'scroll_indicator_horizontal',
        'label'       => esc_html__('Horizontal Position', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 'right',
        'choices'     => [
            'left'  => esc_html__('Left', 'elementor-blank-starter'),
            'right' => esc_html__('Right', 'elementor-blank-starter'),
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Horizontal Offset
 */
new \Kirki\Field\Number(
    [
        'settings'    => 'scroll_indicator_horizontal_offset',
        'label'       => esc_html__('Horizontal Offset', 'elementor-blank-starter'),
        'description' => esc_html__('Distance from edge', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 0,
        'choices'     => [
            'min'  => 0,
            'max'  => 1000,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Horizontal Offset Unit
 */
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'scroll_indicator_horizontal_unit',
        'label'       => esc_html__('Horizontal Unit', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 'px',
        'choices'     => [
            'px'  => 'px',
            '%'   => '%',
            'vw'  => 'vw',
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Vertical Position
 */
new \Kirki\Field\Number(
    [
        'settings'    => 'scroll_indicator_vertical_offset',
        'label'       => esc_html__('Vertical Position', 'elementor-blank-starter'),
        'description' => esc_html__('Distance from bottom', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 0,
        'choices'     => [
            'min'  => 0,
            'max'  => 1000,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Vertical Offset Unit
 */
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'scroll_indicator_vertical_unit',
        'label'       => esc_html__('Vertical Unit', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 'px',
        'choices'     => [
            'px'  => 'px',
            '%'   => '%',
            'vh'  => 'vh',
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Custom Horizontal Position
 */
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'scroll_indicator_horizontal_custom',
        'label'       => esc_html__('Use Custom Horizontal Value', 'elementor-blank-starter'),
        'description' => esc_html__('Enable to use calc() or custom CSS values', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

new \Kirki\Field\Text(
    [
        'settings'    => 'scroll_indicator_horizontal_custom_value',
        'label'       => esc_html__('Custom Horizontal Value', 'elementor-blank-starter'),
        'description' => esc_html__('e.g., calc(2% - 2px) or 5vw', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 'calc(2% - 2px)',
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'scroll_indicator_horizontal_custom',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Custom Vertical Position
 */
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'scroll_indicator_vertical_custom',
        'label'       => esc_html__('Use Custom Vertical Value', 'elementor-blank-starter'),
        'description' => esc_html__('Enable to use calc() or custom CSS values', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

new \Kirki\Field\Text(
    [
        'settings'    => 'scroll_indicator_vertical_custom_value',
        'label'       => esc_html__('Custom Vertical Value', 'elementor-blank-starter'),
        'description' => esc_html__('e.g., calc(50vh - 50px) or 10%', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 'calc(50vh - 50px)',
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'scroll_indicator_vertical_custom',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Indicator Height
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_indicator_height',
        'label'       => esc_html__('Indicator Height', 'elementor-blank-starter'),
        'description' => esc_html__('Total height of the indicator bar', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 100,
        'choices'     => [
            'min'  => 50,
            'max'  => 500,
            'step' => 10,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Background Color
 */
new \Kirki\Field\Color(
    [
        'settings'    => 'scroll_indicator_bg_color',
        'label'       => esc_html__('Background Color', 'elementor-blank-starter'),
        'description' => esc_html__('Background track color', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 'rgba(49, 60, 89, 0.1)',
        'choices'     => [
            'alpha' => true,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Border Radius
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_indicator_border_radius',
        'label'       => esc_html__('Border Radius', 'elementor-blank-starter'),
        'section'     => 'scroll_indicator_section',
        'default'     => 10,
        'choices'     => [
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_indicator',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Output Scroll Indicator CSS and JavaScript
 */
function elementor_blank_scroll_indicator_output() {
    if (!get_theme_mod('enable_scroll_indicator', false)) {
        return;
    }

    $color = get_theme_mod('scroll_indicator_color', '#313C59');
    $bg_color = get_theme_mod('scroll_indicator_bg_color', 'rgba(49, 60, 89, 0.1)');
    $width = get_theme_mod('scroll_indicator_width', 4);
    $height = get_theme_mod('scroll_indicator_height', 100);
    $horizontal = get_theme_mod('scroll_indicator_horizontal', 'right');
    $border_radius = get_theme_mod('scroll_indicator_border_radius', 10);
    
    // Check if using custom values
    $use_horizontal_custom = get_theme_mod('scroll_indicator_horizontal_custom', false);
    $use_vertical_custom = get_theme_mod('scroll_indicator_vertical_custom', false);
    
    // Horizontal position
    if ($use_horizontal_custom) {
        $horizontal_value = get_theme_mod('scroll_indicator_horizontal_custom_value', 'calc(2% - 2px)');
        $position_style = $horizontal === 'left' 
            ? "left: {$horizontal_value};" 
            : "right: {$horizontal_value};";
    } else {
        $horizontal_offset = get_theme_mod('scroll_indicator_horizontal_offset', 0);
        $horizontal_unit = get_theme_mod('scroll_indicator_horizontal_unit', 'px');
        $position_style = $horizontal === 'left' 
            ? "left: {$horizontal_offset}{$horizontal_unit};" 
            : "right: {$horizontal_offset}{$horizontal_unit};";
    }
    
    // Vertical position
    if ($use_vertical_custom) {
        $vertical_value = get_theme_mod('scroll_indicator_vertical_custom_value', 'calc(50vh - 50px)');
    } else {
        $vertical_offset = get_theme_mod('scroll_indicator_vertical_offset', 0);
        $vertical_unit = get_theme_mod('scroll_indicator_vertical_unit', 'px');
        $vertical_value = $vertical_offset . $vertical_unit;
    }

    ?>
    <style id="scroll-indicator-css">
        .scroll-indicator {
            position: fixed;
            bottom: <?php echo esc_attr($vertical_value); ?>;
            <?php echo $position_style; ?>
            width: <?php echo esc_attr($width); ?>px;
            height: <?php echo esc_attr($height); ?>px;
            background-color: <?php echo esc_attr($bg_color); ?>;
            border-radius: <?php echo esc_attr($border_radius); ?>px;
            z-index: 9999;
            overflow: hidden;
        }
        .scroll-indicator-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0%;
            background-color: <?php echo esc_attr($color); ?>;
            border-radius: <?php echo esc_attr($border_radius); ?>px;
            transition: height 0.1s ease-out;
        }
    </style>
    <script id="scroll-indicator-script">
    document.addEventListener('DOMContentLoaded', function() {
        // Create indicator elements
        const indicator = document.createElement('div');
        indicator.className = 'scroll-indicator';
        
        const progress = document.createElement('div');
        progress.className = 'scroll-indicator-progress';
        
        indicator.appendChild(progress);
        document.body.appendChild(indicator);
        
        // Update progress on scroll
        function updateScrollIndicator() {
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            const scrollableHeight = documentHeight - windowHeight;
            const scrollPercentage = (scrollTop / scrollableHeight) * 100;
            
            progress.style.height = Math.min(scrollPercentage, 100) + '%';
        }
        
        // Initialize and add listener
        updateScrollIndicator();
        window.addEventListener('scroll', updateScrollIndicator, { passive: true });
        window.addEventListener('resize', updateScrollIndicator, { passive: true });
    });
    </script>
    <?php
}
add_action('wp_footer', 'elementor_blank_scroll_indicator_output');
