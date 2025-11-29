<?php
/**
 * Scrollbar Customizer integration using Kirki
 *
 * @package Elementor_Blank_Starter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Kirki_Scrollbar_Customizer {

	public function __construct() {
		add_action( 'init', array( $this, 'register_kirki_config' ) );
		add_action( 'init', array( $this, 'register_kirki_fields' ) );
		add_action( 'wp_head', array( $this, 'print_scrollbar_styles' ), 99 );
	}

	/**
	 * Register Kirki configuration
	 */
	public function register_kirki_config() {
		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		Kirki::add_config( 'scrollbar_customizer', array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod',
		) );
	}

	/**
	 * Register Kirki fields for scrollbar customization
	 */
	public function register_kirki_fields() {
		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		// Add Section
		Kirki::add_section( 'scrollbar_section', array(
			'title'       => esc_html__( 'Scrollbar', 'elementor-blank-starter' ),
			'description' => esc_html__( 'Customize the scrollbar appearance', 'elementor-blank-starter' ),
			'priority'    => 160,
		) );

		// Scrollbar Width
		Kirki::add_field( 'scrollbar_customizer', array(
			'type'        => 'number',
			'settings'    => 'scrollbar_width',
			'label'       => esc_html__( 'Scrollbar Width (px)', 'elementor-blank-starter' ),
			'section'     => 'scrollbar_section',
			'default'     => 4,
			'transport'   => 'postMessage',
			'choices'     => array(
				'min'  => 1,
				'max'  => 64,
				'step' => 1,
			),
			'js_vars'     => array(
				array(
					'element'  => ':root',
					'function' => 'style',
					'property' => '--wp-scrollbar-width',
					'units'    => 'px',
				),
			),
		) );

		// Track Color
		Kirki::add_field( 'scrollbar_customizer', array(
			'type'        => 'color',
			'settings'    => 'scrollbar_track_color',
			'label'       => esc_html__( 'Track Color', 'elementor-blank-starter' ),
			'description' => esc_html__( 'Color of the scrollbar track/background', 'elementor-blank-starter' ),
			'section'     => 'scrollbar_section',
			'default'     => '#dddddd',
			'transport'   => 'postMessage',
			'choices'     => array(
				'alpha' => true,
			),
			'js_vars'     => array(
				array(
					'element'  => ':root',
					'function' => 'style',
					'property' => '--wp-scrollbar-track',
				),
			),
		) );

		// Thumb Color
		Kirki::add_field( 'scrollbar_customizer', array(
			'type'        => 'color',
			'settings'    => 'scrollbar_thumb_color',
			'label'       => esc_html__( 'Thumb Color', 'elementor-blank-starter' ),
			'description' => esc_html__( 'Color of the scrollbar thumb (the draggable part)', 'elementor-blank-starter' ),
			'section'     => 'scrollbar_section',
			'default'     => '#ff0000',
			'transport'   => 'postMessage',
			'choices'     => array(
				'alpha' => true,
			),
			'js_vars'     => array(
				array(
					'element'  => ':root',
					'function' => 'style',
					'property' => '--wp-scrollbar-thumb',
				),
			),
		) );

		// Thumb Hover/Active Color
		Kirki::add_field( 'scrollbar_customizer', array(
			'type'        => 'color',
			'settings'    => 'scrollbar_thumb_hover_color',
			'label'       => esc_html__( 'Thumb Scrolling Color', 'elementor-blank-starter' ),
			'description' => esc_html__( 'Color when html has .scrolling class', 'elementor-blank-starter' ),
			'section'     => 'scrollbar_section',
			'default'     => '#ffffff',
			'transport'   => 'postMessage',
			'choices'     => array(
				'alpha' => true,
			),
			'js_vars'     => array(
				array(
					'element'  => ':root',
					'function' => 'style',
					'property' => '--wp-scrollbar-thumb-hover',
				),
			),
		) );
	}

	/**
	 * Print scrollbar styles in the head
	 */
	public function print_scrollbar_styles() {
		$width = get_theme_mod( 'scrollbar_width', 4 );
		$track = get_theme_mod( 'scrollbar_track_color', '#dddddd' );
		$thumb = get_theme_mod( 'scrollbar_thumb_color', '#ff0000' );
		$hover = get_theme_mod( 'scrollbar_thumb_hover_color', '#ffffff' );

		// Ensure width is an int
		$width = absint( $width );
		if ( $width < 1 ) {
			$width = 1;
		}
		if ( $width > 64 ) {
			$width = 64;
		}

		$width_px = $width . 'px';
		?>
		<style id="kirki-scrollbar-customizer-styles">
		:root {
			--wp-scrollbar-width: <?php echo esc_html( $width_px ); ?>;
			--wp-scrollbar-track: <?php echo esc_attr( $track ); ?>;
			--wp-scrollbar-thumb: <?php echo esc_attr( $thumb ); ?>;
			--wp-scrollbar-thumb-hover: <?php echo esc_attr( $hover ); ?>;
		}

		/* WebKit scrollbars */
		::-webkit-scrollbar {
			width: var(--wp-scrollbar-width);
			background: var(--wp-scrollbar-track);
		}

		body.scrollbar::-webkit-scrollbar {
			width: var(--wp-scrollbar-width);
			background: var(--wp-scrollbar-track);
			display: block;
		}

		::-webkit-scrollbar-track {
			background: var(--wp-scrollbar-track);
		}

		::-webkit-scrollbar-thumb {
			background: var(--wp-scrollbar-thumb);
			width: var(--wp-scrollbar-width);
		}

		html.scrolling ::-webkit-scrollbar {
			width: var(--wp-scrollbar-width);
		}

		html.scrolling ::-webkit-scrollbar-thumb {
			background: var(--wp-scrollbar-thumb-hover);
			width: var(--wp-scrollbar-width);
		}

		/* Firefox scrollbar */
		* {
			scrollbar-width: thin;
			scrollbar-color: var(--wp-scrollbar-thumb) var(--wp-scrollbar-track);
		}

		html.scrolling * {
			scrollbar-color: var(--wp-scrollbar-thumb-hover) var(--wp-scrollbar-track);
		}
		</style>
		<?php
	}
}

// Instantiate
new Kirki_Scrollbar_Customizer();
