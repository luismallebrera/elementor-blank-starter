<?php
/**
 * Custom Fonts Manager with Kirki Integration
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
 * Custom Fonts Manager Class
 */
class Elementor_Blank_Custom_Fonts {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Enable font file uploads
		add_filter( 'upload_mimes', array( $this, 'allow_font_uploads' ) );
		
		// Add custom fonts section
		add_action( 'init', array( $this, 'register_customizer_fields' ) );
		
		// Output font-face CSS
		add_action( 'wp_head', array( $this, 'output_font_face_css' ), 5 );
		
		// Add custom fonts to Kirki
		add_filter( 'kirki_fonts_standard_fonts', array( $this, 'add_custom_fonts_to_kirki' ) );
	}

	/**
	 * Allow font file uploads
	 */
	public function allow_font_uploads( $mimes ) {
		$mimes['woff']  = 'font/woff';
		$mimes['woff2'] = 'font/woff2';
		$mimes['ttf']   = 'font/ttf';
		$mimes['otf']   = 'font/otf';
		$mimes['eot']   = 'application/vnd.ms-fontobject';
		return $mimes;
	}

	/**
	 * Register Customizer Fields
	 */
	public function register_customizer_fields() {
		// Add Custom Fonts Section
		new \Kirki\Section(
			'custom_fonts_section',
			array(
				'title'    => esc_html__( 'Custom Fonts', 'elementor-blank-starter' ),
				'panel'    => 'theme_options',
				'priority' => 50,
			)
		);

		// Font 1
		$this->register_font_fields( 1 );
		
		// Font 2
		$this->register_font_fields( 2 );
		
		// Font 3
		$this->register_font_fields( 3 );
		
		// Font 4
		$this->register_font_fields( 4 );
		
		// Font 5
		$this->register_font_fields( 5 );
	}

	/**
	 * Register font fields for a specific font number
	 */
	private function register_font_fields( $font_number ) {
		// Font Name
		new \Kirki\Field\Text(
			array(
				'settings'    => "custom_font_{$font_number}_name",
				'label'       => sprintf( esc_html__( 'Font %d - Family Name', 'elementor-blank-starter' ), $font_number ),
				'description' => esc_html__( 'Enter the font family name (e.g., "Montserrat")', 'elementor-blank-starter' ),
				'section'     => 'custom_fonts_section',
				'default'     => '',
			)
		);

		// WOFF2 File
		new \Kirki\Field\Upload(
			array(
				'settings'    => "custom_font_{$font_number}_woff2",
				'label'       => sprintf( esc_html__( 'Font %d - WOFF2 File', 'elementor-blank-starter' ), $font_number ),
				'description' => esc_html__( 'Upload .woff2 file (recommended for modern browsers)', 'elementor-blank-starter' ),
				'section'     => 'custom_fonts_section',
				'default'     => '',
			)
		);

		// WOFF File
		new \Kirki\Field\Upload(
			array(
				'settings'    => "custom_font_{$font_number}_woff",
				'label'       => sprintf( esc_html__( 'Font %d - WOFF File', 'elementor-blank-starter' ), $font_number ),
				'description' => esc_html__( 'Upload .woff file (fallback)', 'elementor-blank-starter' ),
				'section'     => 'custom_fonts_section',
				'default'     => '',
			)
		);

		// TTF File
		new \Kirki\Field\Upload(
			array(
				'settings'    => "custom_font_{$font_number}_ttf",
				'label'       => sprintf( esc_html__( 'Font %d - TTF File', 'elementor-blank-starter' ), $font_number ),
				'description' => esc_html__( 'Upload .ttf file (optional)', 'elementor-blank-starter' ),
				'section'     => 'custom_fonts_section',
				'default'     => '',
			)
		);

		// Font Weight
		new \Kirki\Field\Select(
			array(
				'settings'    => "custom_font_{$font_number}_weight",
				'label'       => sprintf( esc_html__( 'Font %d - Weight', 'elementor-blank-starter' ), $font_number ),
				'section'     => 'custom_fonts_section',
				'default'     => '400',
				'choices'     => array(
					'100' => esc_html__( '100 - Thin', 'elementor-blank-starter' ),
					'200' => esc_html__( '200 - Extra Light', 'elementor-blank-starter' ),
					'300' => esc_html__( '300 - Light', 'elementor-blank-starter' ),
					'400' => esc_html__( '400 - Regular', 'elementor-blank-starter' ),
					'500' => esc_html__( '500 - Medium', 'elementor-blank-starter' ),
					'600' => esc_html__( '600 - Semi Bold', 'elementor-blank-starter' ),
					'700' => esc_html__( '700 - Bold', 'elementor-blank-starter' ),
					'800' => esc_html__( '800 - Extra Bold', 'elementor-blank-starter' ),
					'900' => esc_html__( '900 - Black', 'elementor-blank-starter' ),
				),
			)
		);

		// Font Style
		new \Kirki\Field\Select(
			array(
				'settings'    => "custom_font_{$font_number}_style",
				'label'       => sprintf( esc_html__( 'Font %d - Style', 'elementor-blank-starter' ), $font_number ),
				'section'     => 'custom_fonts_section',
				'default'     => 'normal',
				'choices'     => array(
					'normal' => esc_html__( 'Normal', 'elementor-blank-starter' ),
					'italic' => esc_html__( 'Italic', 'elementor-blank-starter' ),
				),
			)
		);

		// Divider
		new \Kirki\Field\Custom(
			array(
				'settings' => "custom_font_{$font_number}_divider",
				'section'  => 'custom_fonts_section',
				'default'  => '<hr style="margin: 20px 0; border: 0; border-top: 1px solid #ddd;">',
			)
		);
	}

	/**
	 * Output @font-face CSS
	 */
	public function output_font_face_css() {
		$css = '';

		for ( $i = 1; $i <= 5; $i++ ) {
			$font_name  = get_theme_mod( "custom_font_{$i}_name", '' );
			$woff2_url  = get_theme_mod( "custom_font_{$i}_woff2", '' );
			$woff_url   = get_theme_mod( "custom_font_{$i}_woff", '' );
			$ttf_url    = get_theme_mod( "custom_font_{$i}_ttf", '' );
			$weight     = get_theme_mod( "custom_font_{$i}_weight", '400' );
			$style      = get_theme_mod( "custom_font_{$i}_style", 'normal' );

			// Skip if no font name or no font files
			if ( empty( $font_name ) || ( empty( $woff2_url ) && empty( $woff_url ) && empty( $ttf_url ) ) ) {
				continue;
			}

			$css .= "@font-face {\n";
			$css .= "  font-family: '" . esc_attr( $font_name ) . "';\n";
			$css .= "  font-weight: " . esc_attr( $weight ) . ";\n";
			$css .= "  font-style: " . esc_attr( $style ) . ";\n";
			$css .= "  font-display: swap;\n";
			$css .= "  src: ";

			$sources = array();

			if ( ! empty( $woff2_url ) ) {
				$sources[] = "url('" . esc_url( $woff2_url ) . "') format('woff2')";
			}
			if ( ! empty( $woff_url ) ) {
				$sources[] = "url('" . esc_url( $woff_url ) . "') format('woff')";
			}
			if ( ! empty( $ttf_url ) ) {
				$sources[] = "url('" . esc_url( $ttf_url ) . "') format('truetype')";
			}

			$css .= implode( ",\n       ", $sources );
			$css .= ";\n}\n\n";
		}

		if ( ! empty( $css ) ) {
			echo '<style id="custom-fonts-css">' . "\n" . $css . '</style>' . "\n";
		}
	}

	/**
	 * Add custom fonts to Kirki font list
	 */
	public function add_custom_fonts_to_kirki( $standard_fonts ) {
		for ( $i = 1; $i <= 5; $i++ ) {
			$font_name = get_theme_mod( "custom_font_{$i}_name", '' );
			$woff2_url = get_theme_mod( "custom_font_{$i}_woff2", '' );
			$woff_url  = get_theme_mod( "custom_font_{$i}_woff", '' );
			$ttf_url   = get_theme_mod( "custom_font_{$i}_ttf", '' );

			// Skip if no font name or no font files
			if ( empty( $font_name ) || ( empty( $woff2_url ) && empty( $woff_url ) && empty( $ttf_url ) ) ) {
				continue;
			}

			// Add to standard fonts
			$standard_fonts[ sanitize_title( $font_name ) ] = array(
				'label' => $font_name,
				'stack' => $font_name . ', sans-serif',
			);
		}

		return $standard_fonts;
	}
}

// Initialize
new Elementor_Blank_Custom_Fonts();
