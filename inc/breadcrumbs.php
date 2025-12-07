<?php
/**
 * Breadcrumbs functionality
 *
 * @package Elementor_Blank_Starter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Breadcrumbs Section in Customizer
 */
new \Kirki\Section(
	'breadcrumbs_section',
	array(
		'title'    => esc_html__( 'Breadcrumbs', 'elementor-blank-starter' ),
		'panel'    => 'theme_options',
		'priority' => 60,
	)
);

/**
 * Enable Breadcrumbs
 */
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings'    => 'enable_breadcrumbs',
		'label'       => esc_html__( 'Enable Breadcrumbs', 'elementor-blank-starter' ),
		'description' => esc_html__( 'Show breadcrumbs navigation', 'elementor-blank-starter' ),
		'section'     => 'breadcrumbs_section',
		'default'     => false,
	)
);

/**
 * Show on Homepage
 */
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings'        => 'breadcrumbs_show_on_home',
		'label'           => esc_html__( 'Show on Homepage', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Display breadcrumbs on the homepage', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Home Text
 */
new \Kirki\Field\Text(
	array(
		'settings'        => 'breadcrumbs_home_text',
		'label'           => esc_html__( 'Home Text', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Text for home link', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => 'Home',
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Separator
 */
new \Kirki\Field\Text(
	array(
		'settings'        => 'breadcrumbs_separator',
		'label'           => esc_html__( 'Separator', 'elementor-blank-starter' ),
		'description'     => esc_html__( 'Character or icon between breadcrumb items', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => '/',
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Text Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'breadcrumbs_text_color',
		'label'           => esc_html__( 'Text Color', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => '#666666',
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Link Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'breadcrumbs_link_color',
		'label'           => esc_html__( 'Link Color', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => '#0073aa',
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Link Hover Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'breadcrumbs_link_hover_color',
		'label'           => esc_html__( 'Link Hover Color', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => '#005177',
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Current Page Color
 */
new \Kirki\Field\Color(
	array(
		'settings'        => 'breadcrumbs_current_color',
		'label'           => esc_html__( 'Current Page Color', 'elementor-blank-starter' ),
		'section'         => 'breadcrumbs_section',
		'default'         => '#333333',
		'active_callback' => array(
			array(
				'setting'  => 'enable_breadcrumbs',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Generate Breadcrumbs HTML
 */
function elementor_blank_breadcrumbs( $args = array() ) {
	if ( ! get_theme_mod( 'enable_breadcrumbs', false ) ) {
		return '';
	}

	// Don't show on homepage unless enabled
	if ( is_front_page() && ! get_theme_mod( 'breadcrumbs_show_on_home', false ) ) {
		return '';
	}

	$defaults = array(
		'home_text'  => get_theme_mod( 'breadcrumbs_home_text', 'Home' ),
		'separator'  => get_theme_mod( 'breadcrumbs_separator', '/' ),
		'show_current' => true,
	);

	$args = wp_parse_args( $args, $defaults );

	$breadcrumbs = array();
	$home_url    = home_url( '/' );

	// Home link
	$breadcrumbs[] = '<a href="' . esc_url( $home_url ) . '" class="breadcrumb-home">' . esc_html( $args['home_text'] ) . '</a>';

	if ( is_home() ) {
		// Blog page
		$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( get_the_title( get_option( 'page_for_posts' ) ) ) . '</span>';
	} elseif ( is_category() ) {
		$category = get_queried_object();
		if ( $category->parent ) {
			$breadcrumbs[] = '<a href="' . esc_url( get_category_link( $category->parent ) ) . '">' . esc_html( get_cat_name( $category->parent ) ) . '</a>';
		}
		$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( $category->name ) . '</span>';
	} elseif ( is_tag() ) {
		$tag = get_queried_object();
		$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( $tag->name ) . '</span>';
	} elseif ( is_tax() ) {
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
		
		// Special handling for provincia taxonomy
		if ( $term->taxonomy === 'provincia' || ( $taxonomy && $taxonomy->name === 'provincia' ) ) {
			// Add GAL/GDR post type archive link
			$breadcrumbs[] = '<a href="' . esc_url( home_url( '/galgdr/' ) ) . '">GAL/GDR</a>';
		} elseif ( $taxonomy && $taxonomy->public ) {
			// Add taxonomy name (not linked, just label)
			$breadcrumbs[] = '<span>' . esc_html( $taxonomy->labels->name ) . '</span>';
		}
		
		// Add all parent terms recursively if hierarchical
		if ( isset( $term->parent ) && $term->parent > 0 ) {
			$parent_terms = array();
			$current_term = $term;
			
			while ( isset( $current_term->parent ) && $current_term->parent > 0 ) {
				$parent_term = get_term( $current_term->parent, $term->taxonomy );
				if ( $parent_term && ! is_wp_error( $parent_term ) ) {
					$parent_terms[] = $parent_term;
					$current_term = $parent_term;
				} else {
					break;
				}
			}
			
			// Reverse to show from top-level parent down
			$parent_terms = array_reverse( $parent_terms );
			foreach ( $parent_terms as $parent ) {
				$breadcrumbs[] = '<a href="' . esc_url( get_term_link( $parent ) ) . '">' . esc_html( $parent->name ) . '</a>';
			}
		}
		
		$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( $term->name ) . '</span>';
	} elseif ( is_search() ) {
		$breadcrumbs[] = '<span class="breadcrumb-current">' . sprintf( esc_html__( 'Search Results for: %s', 'elementor-blank-starter' ), get_search_query() ) . '</span>';
	} elseif ( is_404() ) {
		$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html__( '404 Not Found', 'elementor-blank-starter' ) . '</span>';
	} elseif ( is_archive() ) {
		$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( get_the_archive_title() ) . '</span>';
	} elseif ( is_single() ) {
		$post_type = get_post_type();
		
		if ( $post_type === 'post' ) {
			// Blog post
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$category = $categories[0];
				$breadcrumbs[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
			}
		} elseif ( $post_type !== 'attachment' ) {
			// Custom post type
			$post_type_object = get_post_type_object( $post_type );
			if ( $post_type_object && $post_type_object->has_archive ) {
				$breadcrumbs[] = '<a href="' . esc_url( get_post_type_archive_link( $post_type ) ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>';
			}
		}
		
		if ( $args['show_current'] ) {
			$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( get_the_title() ) . '</span>';
		}
	} elseif ( is_page() ) {
		// Page
		$post = get_post();
		if ( $post->post_parent ) {
			$parent_id = $post->post_parent;
			$parents   = array();
			
			while ( $parent_id ) {
				$page      = get_post( $parent_id );
				$parents[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
				$parent_id = $page->post_parent;
			}
			
			$breadcrumbs = array_merge( $breadcrumbs, array_reverse( $parents ) );
		}
		
		if ( $args['show_current'] ) {
			$breadcrumbs[] = '<span class="breadcrumb-current">' . esc_html( get_the_title() ) . '</span>';
		}
	}

	$separator = '<span class="breadcrumb-separator">' . esc_html( $args['separator'] ) . '</span>';
	
	$output = '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'elementor-blank-starter' ) . '">';
	$output .= implode( $separator, $breadcrumbs );
	$output .= '</nav>';

	return $output;
}

/**
 * Breadcrumbs Shortcode
 */
function elementor_blank_breadcrumbs_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'home_text'  => get_theme_mod( 'breadcrumbs_home_text', 'Home' ),
			'separator'  => get_theme_mod( 'breadcrumbs_separator', '/' ),
		),
		$atts,
		'breadcrumbs'
	);

	return elementor_blank_breadcrumbs( $atts );
}
add_shortcode( 'breadcrumbs', 'elementor_blank_breadcrumbs_shortcode' );

/**
 * Output Breadcrumbs CSS
 */
function elementor_blank_breadcrumbs_css() {
	if ( ! get_theme_mod( 'enable_breadcrumbs', false ) ) {
		return;
	}

	$text_color       = get_theme_mod( 'breadcrumbs_text_color', '#666666' );
	$link_color       = get_theme_mod( 'breadcrumbs_link_color', '#0073aa' );
	$link_hover_color = get_theme_mod( 'breadcrumbs_link_hover_color', '#005177' );
	$current_color    = get_theme_mod( 'breadcrumbs_current_color', '#333333' );

	?>
	<style id="breadcrumbs-css">
		.breadcrumbs {
			font-size: 14px;
			color: <?php echo esc_attr( $text_color ); ?>;
			margin-bottom: 20px;
		}
		.breadcrumbs a {
			color: <?php echo esc_attr( $link_color ); ?>;
			text-decoration: none;
			transition: color 0.3s ease;
		}
		.breadcrumbs a:hover {
			color: <?php echo esc_attr( $link_hover_color ); ?>;
		}
		.breadcrumb-separator {
			margin: 0 8px;
			color: <?php echo esc_attr( $text_color ); ?>;
		}
		.breadcrumb-current {
			color: <?php echo esc_attr( $current_color ); ?>;
			font-weight: 500;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'elementor_blank_breadcrumbs_css' );

/**
 * Filter Elementor breadcrumbs for provincia taxonomy
 */
function elementor_blank_filter_elementor_breadcrumbs( $breadcrumbs ) {
	if ( is_tax( 'provincia' ) ) {
		$term = get_queried_object();
		
		// Insert GAL/GDR before the current term
		// Find the last item (current term)
		$new_breadcrumbs = array();
		$items_count = count( $breadcrumbs );
		
		foreach ( $breadcrumbs as $index => $crumb ) {
			$new_breadcrumbs[] = $crumb;
			
			// After home, insert GAL/GDR
			if ( $index === 0 ) {
				$new_breadcrumbs[] = array(
					'text' => 'GAL/GDR',
					'url'  => home_url( '/galgdr/' ),
				);
			}
		}
		
		return $new_breadcrumbs;
	}
	
	return $breadcrumbs;
}
add_filter( 'elementor/breadcrumbs/items', 'elementor_blank_filter_elementor_breadcrumbs', 20 );
