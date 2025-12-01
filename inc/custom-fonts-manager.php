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
	 * Default fonts from assets/fonts
	 */
	private $default_fonts = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		// Scan default fonts directory
		$this->scan_default_fonts();
		
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
	 * Scan assets/fonts directory for default fonts
	 */
	private function scan_default_fonts() {
		$fonts_dir = get_template_directory() . '/assets/fonts';
		
		if ( ! is_dir( $fonts_dir ) ) {
			return;
		}

		$fonts = array();
		$scanned = scandir( $fonts_dir );

		// Weight mapping from filename to numeric value
		$weight_map = array(
			'thin'        => '100',
			'extralight'  => '200',
			'light'       => '300',
			'regular'     => '400',
			'medium'      => '500',
			'semibold'    => '600',
			'bold'        => '700',
			'extrabold'   => '800',
			'black'       => '900',
		);

		foreach ( $scanned as $item ) {
			if ( $item === '.' || $item === '..' ) {
				continue;
			}

			$item_path = $fonts_dir . '/' . $item;

			// If it's a directory, look for font files inside
			if ( is_dir( $item_path ) ) {
				$font_name = $item;
				$font_files = scandir( $item_path );
				
				// Group files by weight
				$variants = array();

				foreach ( $font_files as $file ) {
					$ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
					
					if ( ! in_array( $ext, array( 'woff2', 'woff', 'ttf' ) ) ) {
						continue;
					}

					// Extract weight from filename (e.g., ClashDisplay-Bold.woff2)
					$filename_lower = strtolower( pathinfo( $file, PATHINFO_FILENAME ) );
					
					// Try to find weight in filename
					$detected_weight = '400'; // Default to regular
					foreach ( $weight_map as $weight_name => $weight_value ) {
						if ( strpos( $filename_lower, $weight_name ) !== false ) {
							$detected_weight = $weight_value;
							break;
						}
					}

					// Initialize variant array if not exists
					if ( ! isset( $variants[ $detected_weight ] ) ) {
						$variants[ $detected_weight ] = array(
							'weight' => $detected_weight,
							'woff2'  => '',
							'woff'   => '',
							'ttf'    => '',
						);
					}

					// Add file URL to variant
					$file_url = get_template_directory_uri() . '/assets/fonts/' . $font_name . '/' . $file;
					$variants[ $detected_weight ][ $ext ] = $file_url;
				}

				// Add font with all its variants
				if ( ! empty( $variants ) ) {
					$fonts[ $font_name ] = array(
						'name'     => $font_name,
						'variants' => $variants,
					);
				}
			}
		}

		$this->default_fonts = $fonts;
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
		$has_custom_fonts = false;

		// Check if there are custom fonts from Customizer
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

			$has_custom_fonts = true;

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

		// If no custom fonts, load default fonts from assets/fonts
		if ( ! $has_custom_fonts && ! empty( $this->default_fonts ) ) {
			foreach ( $this->default_fonts as $font ) {
				// Loop through all variants (weights) of the font
				if ( ! empty( $font['variants'] ) ) {
					foreach ( $font['variants'] as $variant ) {
						$css .= "@font-face {\n";
						$css .= "  font-family: '" . esc_attr( $font['name'] ) . "';\n";
						$css .= "  font-weight: " . esc_attr( $variant['weight'] ) . ";\n";
						$css .= "  font-style: normal;\n";
						$css .= "  font-display: swap;\n";
						$css .= "  src: ";

						$sources = array();

						if ( ! empty( $variant['woff2'] ) ) {
							$sources[] = "url('" . esc_url( $variant['woff2'] ) . "') format('woff2')";
						}
						if ( ! empty( $variant['woff'] ) ) {
							$sources[] = "url('" . esc_url( $variant['woff'] ) . "') format('woff')";
						}
						if ( ! empty( $variant['ttf'] ) ) {
							$sources[] = "url('" . esc_url( $variant['ttf'] ) . "') format('truetype')";
						}

						$css .= implode( ",\n       ", $sources );
						$css .= ";\n}\n\n";
					}
				}
			}
		}

		if ( ! empty( $css ) ) {
			echo '<style id="custom-fonts-css">' . "\n" . $css . '</style>' . "\n";
		}
	}

	/**
	 * Add custom fonts to Kirki font list
	 */
	public function add_custom_fonts_to_kirki( $standard_fonts ) {
		$has_custom_fonts = false;

		// Add fonts from Customizer
		for ( $i = 1; $i <= 5; $i++ ) {
			$font_name = get_theme_mod( "custom_font_{$i}_name", '' );
			$woff2_url = get_theme_mod( "custom_font_{$i}_woff2", '' );
			$woff_url  = get_theme_mod( "custom_font_{$i}_woff", '' );
			$ttf_url   = get_theme_mod( "custom_font_{$i}_ttf", '' );

			// Skip if no font name or no font files
			if ( empty( $font_name ) || ( empty( $woff2_url ) && empty( $woff_url ) && empty( $ttf_url ) ) ) {
				continue;
			}

			$has_custom_fonts = true;

			// Add to standard fonts
			$standard_fonts[ sanitize_title( $font_name ) ] = array(
				'label' => $font_name,
				'stack' => $font_name . ', sans-serif',
			);
		}

		// If no custom fonts, add default fonts from assets/fonts
		if ( ! $has_custom_fonts && ! empty( $this->default_fonts ) ) {
			foreach ( $this->default_fonts as $font ) {
				$standard_fonts[ sanitize_title( $font['name'] ) ] = array(
					'label' => $font['name'],
					'stack' => $font['name'] . ', sans-serif',
				);
			}
		}

		return $standard_fonts;
	}
}

// Initialize
new Elementor_Blank_Custom_Fonts();
