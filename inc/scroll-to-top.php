<?php
/**
 * Scroll to Top Button Settings
 * Add customizer controls for scroll to top button
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Scroll to Top Section to Theme Options
 */
new \Kirki\Section(
    'scroll_to_top_section',
    [
        'title'       => esc_html__('Scroll to Top Button', 'elementor-blank-starter'),
        'panel'       => 'theme_options',
        'priority'    => 55,
    ]
);

/**
 * Enable Scroll to Top
 */
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'enable_scroll_to_top',
        'label'       => esc_html__('Enable Scroll to Top Button', 'elementor-blank-starter'),
        'description' => esc_html__('Show a button to scroll back to the top of the page', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => false,
    ]
);

/**
 * Button Style
 */
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'scroll_to_top_style',
        'label'       => esc_html__('Button Style', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 'circle',
        'choices'     => [
            'circle'  => esc_html__('Circle', 'elementor-blank-starter'),
            'square'  => esc_html__('Square', 'elementor-blank-starter'),
            'rounded' => esc_html__('Rounded', 'elementor-blank-starter'),
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Button Size
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_to_top_size',
        'label'       => esc_html__('Button Size', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 50,
        'choices'     => [
            'min'  => 30,
            'max'  => 100,
            'step' => 5,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
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
        'settings'    => 'scroll_to_top_bg_color',
        'label'       => esc_html__('Background Color', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => '#313C59',
        'choices'     => [
            'alpha' => true,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Icon Color
 */
new \Kirki\Field\Color(
    [
        'settings'    => 'scroll_to_top_icon_color',
        'label'       => esc_html__('Icon Color', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => '#ffffff',
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Hover Background Color
 */
new \Kirki\Field\Color(
    [
        'settings'    => 'scroll_to_top_hover_bg_color',
        'label'       => esc_html__('Hover Background Color', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => '#1e2640',
        'choices'     => [
            'alpha' => true,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
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
        'settings'    => 'scroll_to_top_horizontal',
        'label'       => esc_html__('Horizontal Position', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 'right',
        'choices'     => [
            'left'  => esc_html__('Left', 'elementor-blank-starter'),
            'right' => esc_html__('Right', 'elementor-blank-starter'),
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Horizontal Offset
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_to_top_horizontal_offset',
        'label'       => esc_html__('Horizontal Offset', 'elementor-blank-starter'),
        'description' => esc_html__('Distance from edge in pixels', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 30,
        'choices'     => [
            'min'  => 0,
            'max'  => 200,
            'step' => 5,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Vertical Offset
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_to_top_vertical_offset',
        'label'       => esc_html__('Vertical Offset', 'elementor-blank-starter'),
        'description' => esc_html__('Distance from bottom in pixels', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 30,
        'choices'     => [
            'min'  => 0,
            'max'  => 200,
            'step' => 5,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Show After Scroll
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_to_top_show_after',
        'label'       => esc_html__('Show After Scroll', 'elementor-blank-starter'),
        'description' => esc_html__('Show button after scrolling X pixels', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 300,
        'choices'     => [
            'min'  => 100,
            'max'  => 1000,
            'step' => 50,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Animation Speed
 */
new \Kirki\Field\Slider(
    [
        'settings'    => 'scroll_to_top_animation_speed',
        'label'       => esc_html__('Animation Speed', 'elementor-blank-starter'),
        'description' => esc_html__('Speed in milliseconds', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 300,
        'choices'     => [
            'min'  => 100,
            'max'  => 1000,
            'step' => 50,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Z-Index
 */
new \Kirki\Field\Number(
    [
        'settings'    => 'scroll_to_top_zindex',
        'label'       => esc_html__('Z-Index', 'elementor-blank-starter'),
        'section'     => 'scroll_to_top_section',
        'default'     => 9999,
        'choices'     => [
            'min'  => 1,
            'max'  => 999999,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'enable_scroll_to_top',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

/**
 * Output Scroll to Top CSS and JavaScript
 */
function elementor_blank_scroll_to_top_output() {
    if (!get_theme_mod('enable_scroll_to_top', false)) {
        return;
    }

    $style = get_theme_mod('scroll_to_top_style', 'circle');
    $size = get_theme_mod('scroll_to_top_size', 50);
    $bg_color = get_theme_mod('scroll_to_top_bg_color', '#313C59');
    $icon_color = get_theme_mod('scroll_to_top_icon_color', '#ffffff');
    $hover_bg = get_theme_mod('scroll_to_top_hover_bg_color', '#1e2640');
    $horizontal = get_theme_mod('scroll_to_top_horizontal', 'right');
    $horizontal_offset = get_theme_mod('scroll_to_top_horizontal_offset', 30);
    $vertical_offset = get_theme_mod('scroll_to_top_vertical_offset', 30);
    $show_after = get_theme_mod('scroll_to_top_show_after', 300);
    $animation_speed = get_theme_mod('scroll_to_top_animation_speed', 300);
    $zindex = get_theme_mod('scroll_to_top_zindex', 9999);

    $border_radius = '50%';
    if ($style === 'square') {
        $border_radius = '0';
    } elseif ($style === 'rounded') {
        $border_radius = '8px';
    }

    $position_style = $horizontal === 'left' 
        ? "left: {$horizontal_offset}px;" 
        : "right: {$horizontal_offset}px;";

    ?>
    <style id="scroll-to-top-css">
        .scroll-to-top {
            position: fixed;
            bottom: <?php echo esc_attr($vertical_offset); ?>px;
            <?php echo $position_style; ?>
            width: <?php echo esc_attr($size); ?>px;
            height: <?php echo esc_attr($size); ?>px;
            background-color: <?php echo esc_attr($bg_color); ?>;
            color: <?php echo esc_attr($icon_color); ?>;
            border: none;
            border-radius: <?php echo esc_attr($border_radius); ?>;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: <?php echo esc_attr($zindex); ?>;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        .scroll-to-top:hover {
            background-color: <?php echo esc_attr($hover_bg); ?>;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        .scroll-to-top svg {
            width: <?php echo esc_attr($size * 0.5); ?>px;
            height: <?php echo esc_attr($size * 0.5); ?>px;
            fill: currentColor;
        }
    </style>
    <script id="scroll-to-top-script">
    document.addEventListener('DOMContentLoaded', function() {
        // Create button
        const button = document.createElement('button');
        button.className = 'scroll-to-top';
        button.setAttribute('aria-label', 'Scroll to top');
        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>';
        document.body.appendChild(button);
        
        const showAfter = <?php echo esc_js($show_after); ?>;
        const animationSpeed = <?php echo esc_js($animation_speed); ?>;
        
        // Custom easing function - easeInOutExpo
        const easing = (x) => {
            return x === 0
                ? 0
                : x === 1
                ? 1
                : x < 0.5
                ? Math.pow(2, 20 * x - 10) / 2
                : (2 - Math.pow(2, -20 * x + 10)) / 2;
        };
        
        let lenisInstance = null;
        
        // Check for Lenis with a delay to ensure it's initialized
        setTimeout(function() {
            if (typeof window.lenis !== 'undefined') {
                lenisInstance = window.lenis;
                console.log('Lenis detected and ready');
            }
        }, 100);
        
        // Show/hide button on scroll
        function toggleButton() {
            const scrollPos = lenisInstance ? lenisInstance.scroll : window.pageYOffset;
            if (scrollPos > showAfter) {
                button.classList.add('visible');
            } else {
                button.classList.remove('visible');
            }
        }
        
        // Scroll to top
        button.addEventListener('click', function() {
            if (lenisInstance) {
                // Use Lenis scrollTo with custom easing
                lenisInstance.scrollTo(0, {
                    duration: animationSpeed / 1000,
                    easing: easing
                });
            } else {
                // Fallback to standard smooth scroll
                const scrollDuration = animationSpeed;
                const scrollStep = -window.pageYOffset / (scrollDuration / 15);
                
                const scrollInterval = setInterval(function() {
                    if (window.pageYOffset !== 0) {
                        window.scrollBy(0, scrollStep);
                    } else {
                        clearInterval(scrollInterval);
                    }
                }, 15);
            }
        });
        
        // Initialize and add listener
        toggleButton();
        
        // Setup scroll listener after checking for Lenis
        setTimeout(function() {
            if (lenisInstance) {
                // Listen to Lenis scroll event
                lenisInstance.on('scroll', toggleButton);
            } else {
                // Standard scroll listener
                window.addEventListener('scroll', toggleButton, { passive: true });
            }
        }, 150);
    });
    </script>
    <?php
}
add_action('wp_footer', 'elementor_blank_scroll_to_top_output');
