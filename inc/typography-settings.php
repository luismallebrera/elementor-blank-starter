<?php
/**
 * Typography Settings with Custom Fonts Integration
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
 * Typography Section
 */
new \Kirki\Section(
	'typography_section',
	array(
		'title'    => esc_html__( 'Typography', 'elementor-blank-starter' ),
		'panel'    => 'theme_options',
		'priority' => 30,
	)
);

/**
 * Body Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'body_typography',
		'label'       => esc_html__( 'Body Text', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Typography for body text and paragraphs', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'line-height'    => '1.6',
			'letter-spacing' => '0',
			'color'          => '#333333',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body, p',
			),
		),
	)
);

/**
 * Links Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'links_typography',
		'label'       => esc_html__( 'Links (a)', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Typography for links', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => 'regular',
			'color'          => '#0073aa',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'a',
			),
		),
	)
);

/**
 * H1 Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'h1_typography',
		'label'       => esc_html__( 'Heading 1 (H1)', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '2.5rem',
			'line-height'    => '1.2',
			'letter-spacing' => '0',
			'color'          => '#111111',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h1',
			),
		),
	)
);

/**
 * H2 Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'h2_typography',
		'label'       => esc_html__( 'Heading 2 (H2)', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '2rem',
			'line-height'    => '1.3',
			'letter-spacing' => '0',
			'color'          => '#111111',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h2',
			),
		),
	)
);

/**
 * H3 Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'h3_typography',
		'label'       => esc_html__( 'Heading 3 (H3)', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '1.75rem',
			'line-height'    => '1.3',
			'letter-spacing' => '0',
			'color'          => '#111111',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h3',
			),
		),
	)
);

/**
 * H4 Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'h4_typography',
		'label'       => esc_html__( 'Heading 4 (H4)', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '1.5rem',
			'line-height'    => '1.4',
			'letter-spacing' => '0',
			'color'          => '#111111',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h4',
			),
		),
	)
);

/**
 * H5 Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'h5_typography',
		'label'       => esc_html__( 'Heading 5 (H5)', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '1.25rem',
			'line-height'    => '1.4',
			'letter-spacing' => '0',
			'color'          => '#111111',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h5',
			),
		),
	)
);

/**
 * H6 Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'h6_typography',
		'label'       => esc_html__( 'Heading 6 (H6)', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '1rem',
			'line-height'    => '1.4',
			'letter-spacing' => '0',
			'color'          => '#111111',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h6',
			),
		),
	)
);

/**
 * Menu Items Typography
 */
new \Kirki\Field\Typography(
	array(
		'settings'    => 'menu_typography',
		'label'       => esc_html__( 'Menu Items', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Typography for navigation menu items', 'elementor-blank-starter' ),
		'section'     => 'typography_section',
		'default'     => array(
			'font-family'    => 'inherit',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#333333',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.menu-item, .menu-item a, nav a, .nav-menu a',
			),
		),
	)
);
