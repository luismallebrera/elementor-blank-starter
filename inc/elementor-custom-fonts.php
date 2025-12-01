<?php
/**
 * Register Custom Fonts in Elementor
 * Adds custom fonts uploaded via Kirki to Elementor's font dropdown
 *
 * @package Elementor_Blank_Starter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Custom Fonts Integration Class
 */
class Elementor_Blank_Custom_Fonts_Elementor {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Add custom fonts to Elementor
		add_filter( 'elementor/fonts/groups', array( $this, 'add_custom_fonts_group' ) );
		add_filter( 'elementor/fonts/additional_fonts', array( $this, 'add_custom_fonts' ) );
	}

	/**
	 * Add Custom Fonts group to Elementor
	 */
	public function add_custom_fonts_group( $font_groups ) {
		$custom_fonts = $this->get_custom_fonts();
		
		// Only add the group if we have custom fonts
		if ( ! empty( $custom_fonts ) ) {
			$font_groups['custom'] = __( 'Custom Fonts', 'elementor-blank-starter' );
		}

		return $font_groups;
	}

	/**
	 * Add custom fonts to Elementor's font list
	 */
	public function add_custom_fonts( $additional_fonts ) {
		$custom_fonts = $this->get_custom_fonts();

		foreach ( $custom_fonts as $font_name ) {
			if ( ! empty( $font_name ) ) {
				$additional_fonts[ $font_name ] = 'custom';
			}
		}

		return $additional_fonts;
	}

	/**
	 * Get custom fonts from Kirki settings
	 */
	private function get_custom_fonts() {
		$fonts = array();

		for ( $i = 1; $i <= 5; $i++ ) {
			$font_name = get_theme_mod( "custom_font_{$i}_name", '' );
			$woff2_url = get_theme_mod( "custom_font_{$i}_woff2", '' );
			$woff_url  = get_theme_mod( "custom_font_{$i}_woff", '' );
			$ttf_url   = get_theme_mod( "custom_font_{$i}_ttf", '' );

			// Only add if font name exists and at least one font file is uploaded
			if ( ! empty( $font_name ) && ( ! empty( $woff2_url ) || ! empty( $woff_url ) || ! empty( $ttf_url ) ) ) {
				$fonts[] = $font_name;
			}
		}

		return $fonts;
	}
}

// Initialize only if Elementor is active
if ( did_action( 'elementor/loaded' ) ) {
	new Elementor_Blank_Custom_Fonts_Elementor();
}
