<?php
/**
 * Menu Separator Settings
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
 * Menu Separator Section
 */
new \Kirki\Section(
	'menu_separator_section',
	array(
		'title'    => esc_html__( 'Menu Separators', 'elementor-blank-starter' ),
		'panel'    => 'theme_options',
		'priority' => 31,
	)
);

/**
 * Enable Horizontal Menu Separator
 */
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings'    => 'enable_horizontal_separator',
		'label'       => esc_html__( 'Enable Horizontal Menu Separator', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Add vertical separator between horizontal menu items', 'elementor-blank-starter' ),
		'section'     => 'menu_separator_section',
		'default'     => false,
	)
);

/**
 * Horizontal Separator Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'horizontal_separator_color',
		'label'           => esc_html__( 'Horizontal Separator Color', 'elementor-blank-starter' ),
		'section'         => 'menu_separator_section',
		'default'         => '#dddddd',
		'choices'         => array(
			'alpha' => true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_horizontal_separator',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Horizontal Separator Width
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'horizontal_separator_width',
		'label'           => esc_html__( 'Horizontal Separator Width', 'elementor-blank-starter' ),
		'section'         => 'menu_separator_section',
		'default'         => 1,
		'choices'         => array(
			'min'  => 1,
			'max'  => 5,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_horizontal_separator',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Horizontal Separator Height
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'horizontal_separator_height',
		'label'           => esc_html__( 'Horizontal Separator Height (%)', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Height as percentage of menu item height', 'elementor-blank-starter' ),
		'section'         => 'menu_separator_section',
		'default'         => 60,
		'choices'         => array(
			'min'  => 20,
			'max'  => 100,
			'step' => 5,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_horizontal_separator',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Horizontal Separator Rotation
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'horizontal_separator_rotation',
		'label'           => esc_html__( 'Horizontal Separator Rotation (degrees)', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Rotate the separator line', 'elementor-blank-starter' ),
		'section'         => 'menu_separator_section',
		'default'         => 0,
		'choices'         => array(
			'min'  => -45,
			'max'  => 45,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_horizontal_separator',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Divider
 */
new \Kirki\Field\Custom(
	array(
		'settings' => 'submenu_separator_divider',
		'section'  => 'menu_separator_section',
		'default'  => '<hr style="margin: 30px 0; border: 0; border-top: 2px solid #ddd;">',
	)
);

/**
 * Enable Submenu Separator
 */
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings'    => 'enable_submenu_separator',
		'label'       => esc_html__( 'Enable Submenu Separator', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Add horizontal separator between submenu items', 'elementor-blank-starter' ),
		'section'     => 'menu_separator_section',
		'default'     => false,
	)
);

/**
 * Submenu Separator Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'submenu_separator_color',
		'label'           => esc_html__( 'Submenu Separator Color', 'elementor-blank-starter' ),
		'section'         => 'menu_separator_section',
		'default'         => '#dddddd',
		'choices'         => array(
			'alpha' => true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_submenu_separator',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Submenu Separator Width (Height of horizontal line)
 */
new \Kirki\Field\Slider(
	array(
		'settings'        => 'submenu_separator_width',
		'label'           => esc_html__( 'Submenu Separator Width (Thickness)', 'elementor-blank-starter' ),
		'section'         => 'menu_separator_section',
		'default'         => 1,
		'choices'         => array(
			'min'  => 1,
			'max'  => 5,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_submenu_separator',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Output Menu Separator CSS
 */
function elementor_blank_menu_separator_styles() {
	$enable_horizontal = get_theme_mod( 'enable_horizontal_separator', false );
	$enable_submenu    = get_theme_mod( 'enable_submenu_separator', false );

	if ( ! $enable_horizontal && ! $enable_submenu ) {
		return;
	}

	$css = '<style id="menu-separator-styles">';

	// Horizontal menu separator (vertical line)
	if ( $enable_horizontal ) {
		$h_color    = get_theme_mod( 'horizontal_separator_color', '#dddddd' );
		$h_width    = get_theme_mod( 'horizontal_separator_width', 1 );
		$h_height   = get_theme_mod( 'horizontal_separator_height', 60 );
		$h_rotation = get_theme_mod( 'horizontal_separator_rotation', 0 );

		$transform = 'translateY(-50%)';
		if ( $h_rotation != 0 ) {
			$transform = 'translateY(-50%) rotate(' . esc_attr( $h_rotation ) . 'deg)';
		}

		$css .= '
		/* Horizontal Menu Separator */
		.menu-item:not(:last-child)::after,
		nav .menu-item:not(:last-child)::after,
		.nav-menu > .menu-item:not(:last-child)::after {
			content: "";
			position: absolute;
			right: 0;
			top: 50%;
			transform: ' . $transform . ';
			height: ' . esc_attr( $h_height ) . '%;
			width: ' . esc_attr( $h_width ) . 'px;
			background-color: ' . esc_attr( $h_color ) . ';
		}
		
		.menu-item,
		nav .menu-item,
		.nav-menu > .menu-item {
			position: relative;
		}
		';
	}

	// Submenu separator (horizontal line)
	if ( $enable_submenu ) {
		$s_color = get_theme_mod( 'submenu_separator_color', '#dddddd' );
		$s_width = get_theme_mod( 'submenu_separator_width', 1 );

		$css .= '
		/* Submenu Separator */
		.sub-menu .menu-item:not(:last-child),
		.submenu .menu-item:not(:last-child),
		nav .sub-menu .menu-item:not(:last-child),
		.menu-item .sub-menu .menu-item:not(:last-child) {
			border-bottom: ' . esc_attr( $s_width ) . 'px solid ' . esc_attr( $s_color ) . ';
		}
		';
	}

	$css .= '</style>';

	echo $css;
}
add_action( 'wp_head', 'elementor_blank_menu_separator_styles' );
