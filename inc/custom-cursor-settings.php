<?php
/**
 * Custom Mouse Cursor Settings
 *
 * @package Elementor_Blank_Starter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * Custom Cursor Section
 */
new \Kirki\Section(
	'custom_cursor_section',
	array(
		'title'    => esc_html__( 'Custom Cursor', 'elementor-blank-starter' ),
		'panel'    => 'theme_options',
		'priority' => 35,
	)
);

/**
 * Enable Custom Cursor
 */
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings'    => 'enable_custom_cursor',
		'label'       => esc_html__( 'Enable Custom Cursor', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Replace default cursor with a modern custom cursor', 'elementor-blank-starter' ),
		'section'     => 'custom_cursor_section',
		'default'     => false,
	)
);

/**
 * Cursor Style
 */
new \Kirki\Field\Radio_Buttonset(
	array(
		'settings'        => 'cursor_style',
		'label'           => esc_html__( 'Cursor Style', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 'dot',
		'choices'         => array(
			'dot'    => esc_html__( 'Dot', 'elementor-blank-starter' ),
			'ring'   => esc_html__( 'Ring', 'elementor-blank-starter' ),
			'both'   => esc_html__( 'Dot + Ring', 'elementor-blank-starter' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Cursor Size
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'cursor_size',
		'label'           => esc_html__( 'Cursor Dot Size (px)', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 8,
		'choices'         => array(
			'min'  => 4,
			'max'  => 30,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Cursor Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'cursor_color',
		'label'           => esc_html__( 'Cursor Color', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => '#000000',
		'choices'         => array(
			'alpha' => true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Ring Size
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'cursor_ring_size',
		'label'           => esc_html__( 'Ring Size (px)', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 40,
		'choices'         => array(
			'min'  => 20,
			'max'  => 80,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'cursor_style',
				'operator' => 'in',
				'value'    => array( 'ring', 'both' ),
			),
		),
	)
);

/**
 * Ring Border Width
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'cursor_ring_border',
		'label'           => esc_html__( 'Ring Border Width (px)', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 2,
		'choices'         => array(
			'min'  => 1,
			'max'  => 5,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'cursor_style',
				'operator' => 'in',
				'value'    => array( 'ring', 'both' ),
			),
		),
	)
);

/**
 * Hover Scale
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'cursor_hover_scale',
		'label'           => esc_html__( 'Hover Scale', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Scale multiplier when hovering over links', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 1.5,
		'choices'         => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 0.1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Animation Speed
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'cursor_animation_speed',
		'label'           => esc_html__( 'Animation Speed (ms)', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Lower = faster animation', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 200,
		'choices'         => array(
			'min'  => 50,
			'max'  => 500,
			'step' => 50,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Blend Mode
 */
new \Kirki\Field\Select(
	array(
		'settings'        => 'cursor_blend_mode',
		'label'           => esc_html__( 'Blend Mode', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'CSS blend mode for the cursor', 'elementor-blank-starter' ),
		'section'         => 'custom_cursor_section',
		'default'         => 'normal',
		'choices'         => array(
			'normal'      => esc_html__( 'Normal', 'elementor-blank-starter' ),
			'multiply'    => esc_html__( 'Multiply', 'elementor-blank-starter' ),
			'screen'      => esc_html__( 'Screen', 'elementor-blank-starter' ),
			'overlay'     => esc_html__( 'Overlay', 'elementor-blank-starter' ),
			'difference'  => esc_html__( 'Difference', 'elementor-blank-starter' ),
			'exclusion'   => esc_html__( 'Exclusion', 'elementor-blank-starter' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_cursor',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Enqueue Custom Cursor Scripts and Styles
 */
function elementor_blank_custom_cursor_enqueue() {
	if ( ! get_theme_mod( 'enable_custom_cursor', false ) ) {
		return;
	}

	$cursor_style = get_theme_mod( 'cursor_style', 'dot' );
	$cursor_size = get_theme_mod( 'cursor_size', 8 );
	$cursor_color = get_theme_mod( 'cursor_color', '#000000' );
	$ring_size = get_theme_mod( 'cursor_ring_size', 40 );
	$ring_border = get_theme_mod( 'cursor_ring_border', 2 );
	$hover_scale = get_theme_mod( 'cursor_hover_scale', 1.5 );
	$animation_speed = get_theme_mod( 'cursor_animation_speed', 200 );
	$blend_mode = get_theme_mod( 'cursor_blend_mode', 'normal' );

	// Add inline CSS
	$css = "
	<style id='custom-cursor-styles'>
	* {
		cursor: none !important;
	}
	
	.custom-cursor-dot {
		position: fixed;
		top: 0;
		left: 0;
		width: {$cursor_size}px;
		height: {$cursor_size}px;
		background-color: {$cursor_color};
		border-radius: 50%;
		pointer-events: none;
		z-index: 99999;
		transition: transform {$animation_speed}ms ease, opacity 0.3s ease;
		mix-blend-mode: {$blend_mode};
	}
	
	.custom-cursor-ring {
		position: fixed;
		top: 0;
		left: 0;
		width: {$ring_size}px;
		height: {$ring_size}px;
		border: {$ring_border}px solid {$cursor_color};
		border-radius: 50%;
		pointer-events: none;
		z-index: 99998;
		transition: transform {$animation_speed}ms ease, opacity 0.3s ease;
		mix-blend-mode: {$blend_mode};
	}
	
	.custom-cursor-dot.hover,
	.custom-cursor-ring.hover {
		transform: scale({$hover_scale});
		opacity: 0.7;
	}
	
	body.hide-cursor .custom-cursor-dot,
	body.hide-cursor .custom-cursor-ring {
		opacity: 0;
	}
	</style>
	";

	echo $css;

	// Add inline JavaScript
	$js = "
	<script id='custom-cursor-script'>
	document.addEventListener('DOMContentLoaded', function() {
		const cursorStyle = '" . esc_js( $cursor_style ) . "';
		const body = document.body;
		
		// Create cursor elements
		if (cursorStyle === 'dot' || cursorStyle === 'both') {
			const dot = document.createElement('div');
			dot.classList.add('custom-cursor-dot');
			body.appendChild(dot);
		}
		
		if (cursorStyle === 'ring' || cursorStyle === 'both') {
			const ring = document.createElement('div');
			ring.classList.add('custom-cursor-ring');
			body.appendChild(ring);
		}
		
		const dot = document.querySelector('.custom-cursor-dot');
		const ring = document.querySelector('.custom-cursor-ring');
		
		// Mouse move
		document.addEventListener('mousemove', function(e) {
			const x = e.clientX;
			const y = e.clientY;
			
			if (dot) {
				dot.style.left = (x - " . ($cursor_size / 2) . ") + 'px';
				dot.style.top = (y - " . ($cursor_size / 2) . ") + 'px';
			}
			
			if (ring) {
				ring.style.left = (x - " . ($ring_size / 2) . ") + 'px';
				ring.style.top = (y - " . ($ring_size / 2) . ") + 'px';
			}
		});
		
		// Hover effects
		const hoverElements = document.querySelectorAll('a, button, [onclick], input[type=\"button\"], input[type=\"submit\"]');
		
		hoverElements.forEach(function(el) {
			el.addEventListener('mouseenter', function() {
				if (dot) dot.classList.add('hover');
				if (ring) ring.classList.add('hover');
			});
			
			el.addEventListener('mouseleave', function() {
				if (dot) dot.classList.remove('hover');
				if (ring) ring.classList.remove('hover');
			});
		});
		
		// Hide cursor when leaving window
		document.addEventListener('mouseleave', function() {
			body.classList.add('hide-cursor');
		});
		
		document.addEventListener('mouseenter', function() {
			body.classList.remove('hide-cursor');
		});
	});
	</script>
	";

	echo $js;
}
add_action( 'wp_footer', 'elementor_blank_custom_cursor_enqueue' );
