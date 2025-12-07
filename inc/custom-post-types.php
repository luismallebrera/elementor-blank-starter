<?php
/**
 * Custom Post Types
 * Register custom post types for the theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register GAL/GDR Post Type
 */
function elementor_blank_register_galgdr_cpt() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                  => _x('GAL/GDR', 'Post Type General Name', 'elementor-blank-starter'),
        'singular_name'         => _x('GAL/GDR', 'Post Type Singular Name', 'elementor-blank-starter'),
        'menu_name'             => __('GAL/GDR', 'elementor-blank-starter'),
        'name_admin_bar'        => __('GAL/GDR', 'elementor-blank-starter'),
        'archives'              => __('GAL/GDR Archives', 'elementor-blank-starter'),
        'all_items'             => __('Todos los GAL/GDR', 'elementor-blank-starter'),
        'add_new_item'          => __('Añadir Nuevo GAL/GDR', 'elementor-blank-starter'),
        'add_new'               => __('Añadir Nuevo', 'elementor-blank-starter'),
        'new_item'              => __('Nuevo GAL/GDR', 'elementor-blank-starter'),
        'edit_item'             => __('Editar GAL/GDR', 'elementor-blank-starter'),
        'update_item'           => __('Actualizar GAL/GDR', 'elementor-blank-starter'),
        'view_item'             => __('Ver GAL/GDR', 'elementor-blank-starter'),
        'search_items'          => __('Buscar GAL/GDR', 'elementor-blank-starter'),
        'not_found'             => __('No encontrado', 'elementor-blank-starter'),
        'not_found_in_trash'    => __('No encontrado en papelera', 'elementor-blank-starter'),
    );

    $args = array(
        'label'                 => __('GAL/GDR', 'elementor-blank-starter'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-groups',
        'has_archive'           => true,
        'show_in_rest'          => true,
        'rewrite'               => false,
    );

    register_post_type('galgdr', $args);
}
add_action('init', 'elementor_blank_register_galgdr_cpt', 0);

/**
 * Generate correct permalink for GAL/GDR posts
 */
function elementor_blank_galgdr_permalink($post_link, $post) {
    if ($post->post_type !== 'galgdr') {
        return $post_link;
    }
    
    // Solo modificar si no tiene ya la estructura correcta
    if (strpos($post_link, '/galgdr/') !== false && strpos($post_link, '/galgdr/galgdr/') === false) {
        return $post_link;
    }
    
    $terms = wp_get_object_terms($post->ID, 'provincia');
    if (!empty($terms) && !is_wp_error($terms)) {
        return home_url('/galgdr/' . $terms[0]->slug . '/' . $post->post_name . '/');
    } else {
        return home_url('/galgdr/sin-provincia/' . $post->post_name . '/');
    }
}
add_filter('post_type_link', 'elementor_blank_galgdr_permalink', 10, 2);

/**
 * Register Municipio Post Type
 */
function elementor_blank_register_municipio_cpt() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                  => _x('Municipios', 'Post Type General Name', 'elementor-blank-starter'),
        'singular_name'         => _x('Municipio', 'Post Type Singular Name', 'elementor-blank-starter'),
        'menu_name'             => __('Municipios', 'elementor-blank-starter'),
        'name_admin_bar'        => __('Municipio', 'elementor-blank-starter'),
        'archives'              => __('Municipios Archives', 'elementor-blank-starter'),
        'all_items'             => __('Todos los Municipios', 'elementor-blank-starter'),
        'add_new_item'          => __('Añadir Nuevo Municipio', 'elementor-blank-starter'),
        'add_new'               => __('Añadir Nuevo', 'elementor-blank-starter'),
        'new_item'              => __('Nuevo Municipio', 'elementor-blank-starter'),
        'edit_item'             => __('Editar Municipio', 'elementor-blank-starter'),
        'update_item'           => __('Actualizar Municipio', 'elementor-blank-starter'),
        'view_item'             => __('Ver Municipio', 'elementor-blank-starter'),
        'search_items'          => __('Buscar Municipios', 'elementor-blank-starter'),
        'not_found'             => __('No encontrado', 'elementor-blank-starter'),
        'not_found_in_trash'    => __('No encontrado en papelera', 'elementor-blank-starter'),
    );

    $args = array(
        'label'                 => __('Municipios', 'elementor-blank-starter'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-location',
        'has_archive'           => true,
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'municipios'),
    );

    register_post_type('municipio', $args);
}
add_action('init', 'elementor_blank_register_municipio_cpt', 0);

/**
 * Register Provincia Taxonomy
 */
function elementor_blank_register_provincia_taxonomy() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Provincias', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Provincia', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Provincias', 'elementor-blank-starter'),
        'all_items'                  => __('Todas las Provincias', 'elementor-blank-starter'),
        'parent_item'                => __('Provincia Padre', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Provincia Padre:', 'elementor-blank-starter'),
        'new_item_name'              => __('Nueva Provincia', 'elementor-blank-starter'),
        'add_new_item'               => __('Añadir Nueva Provincia', 'elementor-blank-starter'),
        'edit_item'                  => __('Editar Provincia', 'elementor-blank-starter'),
        'update_item'                => __('Actualizar Provincia', 'elementor-blank-starter'),
        'view_item'                  => __('Ver Provincia', 'elementor-blank-starter'),
        'search_items'               => __('Buscar Provincias', 'elementor-blank-starter'),
        'not_found'                  => __('No encontrado', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array(
            'slug'                   => 'galgdr',
            'with_front'             => false,
            'hierarchical'           => true,
        ),
    );

    register_taxonomy('provincia', array('galgdr'), $args);
}
add_action('init', 'elementor_blank_register_provincia_taxonomy', 0);

/**
 * Add custom rewrite rules for /galgdr/{provincia}/ archives
 */
function elementor_blank_galgdr_provincia_rewrite_rules() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    // Archive by provincia: /galgdr/toledo/
    add_rewrite_rule(
        '^galgdr/([^/]+)/?$',
        'index.php?provincia=$matches[1]',
        'top'
    );
    
    // Single GAL/GDR: /galgdr/toledo/nombre-del-galgdr/
    add_rewrite_rule(
        '^galgdr/([^/]+)/([^/]+)/?$',
        'index.php?post_type=galgdr&name=$matches[2]',
        'top'
    );
}
add_action('init', 'elementor_blank_galgdr_provincia_rewrite_rules');

/**
 * Modify main query for provincia archives to show GAL/GDR
 */
function elementor_blank_modify_galgdr_provincia_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        // For provincia taxonomy archives
        if (is_tax('provincia')) {
            $query->set('post_type', 'galgdr');
            $query->set('posts_per_page', -1);
        }
        // For GAL/GDR post type archive
        if (is_post_type_archive('galgdr')) {
            $query->set('posts_per_page', -1);
        }
    }
}
add_action('pre_get_posts', 'elementor_blank_modify_galgdr_provincia_query');

/**
 * Modify page title for provincia archive pages
 */
function elementor_blank_galgdr_provincia_title($title) {
    if (is_tax('provincia')) {
        $term = get_queried_object();
        if ($term) {
            return 'GAL/GDR de ' . $term->name;
        }
    }
    return $title;
}
add_filter('pre_get_document_title', 'elementor_blank_galgdr_provincia_title', 10, 1);
add_filter('wp_title', 'elementor_blank_galgdr_provincia_title', 10, 1);

/**
 * Make provincia query var public
 */
function elementor_blank_add_query_vars($vars) {
    $vars[] = 'provincia';
    return $vars;
}
add_filter('query_vars', 'elementor_blank_add_query_vars');

/**
 * Custom Elementor Query for GAL/GDR filtered by Provincia
 * Use Query ID: galgdr_provincia
 */
function elementor_blank_galgdr_provincia_query($query) {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    // Set post type to galgdr
    $query->set('post_type', 'galgdr');
    
    // If we're on a provincia taxonomy page, Elementor will automatically filter
    // No need to manually set the tax_query - Elementor handles it
}
add_action('elementor/query/galgdr_provincia', 'elementor_blank_galgdr_provincia_query');

/**
 * Auto-assign provincia to GAL/GDR posts without provincia
 * Runs once to fix existing posts
 */
function elementor_blank_auto_assign_provincia_to_galgdr() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    // Check if we've already run this
    if (get_option('elementor_blank_provincia_assigned', false)) {
        return;
    }
    
    // Get all GAL/GDR posts
    $galgdr_posts = get_posts(array(
        'post_type'      => 'galgdr',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ));
    
    // Map of provincia keywords to find in titles
    $provincia_map = array(
        'ALBACETE' => array('albacete'),
        'CIUDAD REAL' => array('ciudad real', 'ciudad-real'),
        'CUENCA' => array('cuenca'),
        'GUADALAJARA' => array('guadalajara'),
        'TOLEDO' => array('toledo'),
    );
    
    foreach ($galgdr_posts as $post) {
        // Check if post already has provincia assigned
        $existing_terms = wp_get_object_terms($post->ID, 'provincia');
        if (!empty($existing_terms) && !is_wp_error($existing_terms)) {
            continue; // Already has provincia
        }
        
        // Try to detect provincia from title
        $title_lower = strtolower($post->post_title);
        $provincia_found = null;
        
        foreach ($provincia_map as $provincia_name => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($title_lower, $keyword) !== false) {
                    $provincia_found = $provincia_name;
                    break 2;
                }
            }
        }
        
        // If found, assign it
        if ($provincia_found) {
            $term = term_exists($provincia_found, 'provincia');
            if ($term) {
                wp_set_object_terms($post->ID, array($term['term_id']), 'provincia');
            }
        }
    }
    
    // Mark as done
    update_option('elementor_blank_provincia_assigned', true);
}
add_action('admin_init', 'elementor_blank_auto_assign_provincia_to_galgdr');

/**
 * Add Siglas (Acronym) custom field to GAL/GDR
 */
function elementor_blank_add_galgdr_siglas_meta_box() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'galgdr_siglas',
        __('Siglas', 'elementor-blank-starter'),
        'elementor_blank_galgdr_siglas_callback',
        'galgdr',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_galgdr_siglas_meta_box');

function elementor_blank_galgdr_siglas_callback($post) {
    wp_nonce_field('galgdr_siglas_nonce', 'galgdr_siglas_nonce_field');
    $value = get_post_meta($post->ID, '_galgdr_siglas', true);
    echo '<label for="galgdr_siglas_field">' . __('Siglas:', 'elementor-blank-starter') . '</label>';
    echo '<input type="text" id="galgdr_siglas_field" name="galgdr_siglas_field" value="' . esc_attr($value) . '" class="widefat" placeholder="' . __('Ej: ADIMAN', 'elementor-blank-starter') . '">';
}

function elementor_blank_save_galgdr_siglas($post_id) {
    if (!isset($_POST['galgdr_siglas_nonce_field']) || 
        !wp_verify_nonce($_POST['galgdr_siglas_nonce_field'], 'galgdr_siglas_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['galgdr_siglas_field'])) {
        update_post_meta($post_id, '_galgdr_siglas', sanitize_text_field($_POST['galgdr_siglas_field']));
    }
}
add_action('save_post_galgdr', 'elementor_blank_save_galgdr_siglas');

/**
 * Register Siglas custom field for REST API and Elementor
 */
function elementor_blank_register_galgdr_siglas_meta() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    register_post_meta('galgdr', '_galgdr_siglas', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'description' => __('Siglas del GAL/GDR', 'elementor-blank-starter'),
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_galgdr_siglas_meta');

/**
 * Add GAL/GDR and Provincia relationship meta boxes to Municipio
 */
function elementor_blank_add_municipio_meta_boxes() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'municipio_galgdr_relationship',
        __('GAL/GDR Asociado', 'elementor-blank-starter'),
        'elementor_blank_municipio_galgdr_callback',
        'municipio',
        'side',
        'default'
    );
    
    add_meta_box(
        'municipio_provincia_relationship',
        __('Provincia', 'elementor-blank-starter'),
        'elementor_blank_municipio_provincia_callback',
        'municipio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_municipio_meta_boxes');

function elementor_blank_municipio_galgdr_callback($post) {
    wp_nonce_field('municipio_galgdr_nonce', 'municipio_galgdr_nonce_field');
    $selected_galgdr = get_post_meta($post->ID, '_municipio_galgdr_asociado', true);
    
    // Get all GAL/GDR posts
    $galgdr_posts = get_posts(array(
        'post_type'      => 'galgdr',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ));
    
    echo '<label for="municipio_galgdr_select">' . __('Selecciona GAL/GDR:', 'elementor-blank-starter') . '</label><br>';
    echo '<select id="municipio_galgdr_select" name="municipio_galgdr_asociado" style="width: 100%;">';
    echo '<option value="">' . __('-- Ninguno --', 'elementor-blank-starter') . '</option>';
    
    foreach ($galgdr_posts as $galgdr_post) {
        $selected = ($selected_galgdr == $galgdr_post->ID) ? 'selected="selected"' : '';
        echo '<option value="' . esc_attr($galgdr_post->ID) . '" ' . $selected . '>' . esc_html($galgdr_post->post_title) . '</option>';
    }
    
    echo '</select>';
}

function elementor_blank_municipio_provincia_callback($post) {
    wp_nonce_field('municipio_provincia_nonce', 'municipio_provincia_nonce_field');
    $selected_provincia = get_post_meta($post->ID, '_municipio_provincia', true);
    
    // Get all provincia terms
    $provincias = get_terms(array(
        'taxonomy'   => 'provincia',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ));
    
    echo '<label for="municipio_provincia_select">' . __('Selecciona Provincia:', 'elementor-blank-starter') . '</label><br>';
    echo '<select id="municipio_provincia_select" name="municipio_provincia" style="width: 100%;">';
    echo '<option value="">' . __('-- Ninguna --', 'elementor-blank-starter') . '</option>';
    
    if (!is_wp_error($provincias) && !empty($provincias)) {
        foreach ($provincias as $provincia) {
            $selected = ($selected_provincia == $provincia->term_id) ? 'selected="selected"' : '';
            echo '<option value="' . esc_attr($provincia->term_id) . '" ' . $selected . '>' . esc_html($provincia->name) . '</option>';
        }
    }
    
    echo '</select>';
}

function elementor_blank_save_municipio_galgdr($post_id) {
    if (!isset($_POST['municipio_galgdr_nonce_field']) || 
        !wp_verify_nonce($_POST['municipio_galgdr_nonce_field'], 'municipio_galgdr_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['municipio_galgdr_asociado'])) {
        $galgdr_id = absint($_POST['municipio_galgdr_asociado']);
        update_post_meta($post_id, '_municipio_galgdr_asociado', $galgdr_id);
    }
    
    if (isset($_POST['municipio_provincia'])) {
        $provincia_id = absint($_POST['municipio_provincia']);
        update_post_meta($post_id, '_municipio_provincia', $provincia_id);
    }
}
add_action('save_post_municipio', 'elementor_blank_save_municipio_galgdr');

/**
 * Register GAL/GDR and Provincia relationship meta for REST API
 */
function elementor_blank_register_municipio_galgdr_meta() {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    register_post_meta('municipio', '_municipio_galgdr_asociado', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
        'description' => __('ID del GAL/GDR asociado', 'elementor-blank-starter'),
        'sanitize_callback' => 'absint',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
    
    register_post_meta('municipio', '_municipio_provincia', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
        'description' => __('ID de la provincia asociada', 'elementor-blank-starter'),
        'sanitize_callback' => 'absint',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_municipio_galgdr_meta');

/**
 * Custom Elementor Query for Municipios related to GAL/GDR
 * Use Query ID: municipios_de_gal
 */
function elementor_blank_municipios_de_gal_query($query) {
    if (!get_theme_mod('enable_galgdr_cpt', false)) {
        return;
    }
    
    if (is_singular('galgdr')) {
        $gal_id = get_the_ID();
        $meta_query = array(
            array(
                'key'     => '_municipio_galgdr_asociado',
                'value'   => $gal_id,
                'compare' => '='
            )
        );
        $query->set('meta_query', $meta_query);
    }
}
add_action('elementor/query/municipios_de_gal', 'elementor_blank_municipios_de_gal_query');

/**
 * Register Noticias Slider Post Type
 */
function elementor_blank_register_noticias_slider_cpt() {
    if (!get_theme_mod('enable_noticias_slider_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                  => _x('Noticias Slider', 'Post Type General Name', 'elementor-blank-starter'),
        'singular_name'         => _x('Noticia Slider', 'Post Type Singular Name', 'elementor-blank-starter'),
        'menu_name'             => __('Noticias Slider', 'elementor-blank-starter'),
        'name_admin_bar'        => __('Noticia Slider', 'elementor-blank-starter'),
        'archives'              => __('Noticias Slider Archives', 'elementor-blank-starter'),
        'attributes'            => __('Noticia Attributes', 'elementor-blank-starter'),
        'parent_item_colon'     => __('Parent Noticia:', 'elementor-blank-starter'),
        'all_items'             => __('Todas las Noticias', 'elementor-blank-starter'),
        'add_new_item'          => __('Añadir Nueva Noticia', 'elementor-blank-starter'),
        'add_new'               => __('Añadir Nueva', 'elementor-blank-starter'),
        'new_item'              => __('Nueva Noticia', 'elementor-blank-starter'),
        'edit_item'             => __('Editar Noticia', 'elementor-blank-starter'),
        'update_item'           => __('Actualizar Noticia', 'elementor-blank-starter'),
        'view_item'             => __('Ver Noticia', 'elementor-blank-starter'),
        'view_items'            => __('Ver Noticias', 'elementor-blank-starter'),
        'search_items'          => __('Buscar Noticias', 'elementor-blank-starter'),
        'not_found'             => __('No encontrado', 'elementor-blank-starter'),
        'not_found_in_trash'    => __('No encontrado en papelera', 'elementor-blank-starter'),
        'featured_image'        => __('Imagen destacada', 'elementor-blank-starter'),
        'set_featured_image'    => __('Establecer imagen destacada', 'elementor-blank-starter'),
        'remove_featured_image' => __('Eliminar imagen destacada', 'elementor-blank-starter'),
        'use_featured_image'    => __('Usar como imagen destacada', 'elementor-blank-starter'),
        'insert_into_item'      => __('Insertar en noticia', 'elementor-blank-starter'),
        'uploaded_to_this_item' => __('Subido a esta noticia', 'elementor-blank-starter'),
        'items_list'            => __('Lista de noticias', 'elementor-blank-starter'),
        'items_list_navigation' => __('Navegación de lista de noticias', 'elementor-blank-starter'),
        'filter_items_list'     => __('Filtrar lista de noticias', 'elementor-blank-starter'),
    );

    $args = array(
        'label'                 => __('Noticia Slider', 'elementor-blank-starter'),
        'description'           => __('Noticias para slider', 'elementor-blank-starter'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-slides',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('noticias_slider', $args);
}
add_action('init', 'elementor_blank_register_noticias_slider_cpt', 0);

/**
 * Register Portfolio Post Type
 */
function elementor_blank_register_portfolio_cpt() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                  => _x('Portfolio', 'Post Type General Name', 'elementor-blank-starter'),
        'singular_name'         => _x('Portfolio Item', 'Post Type Singular Name', 'elementor-blank-starter'),
        'menu_name'             => __('Portfolio', 'elementor-blank-starter'),
        'name_admin_bar'        => __('Portfolio Item', 'elementor-blank-starter'),
        'archives'              => __('Portfolio Archives', 'elementor-blank-starter'),
        'attributes'            => __('Portfolio Attributes', 'elementor-blank-starter'),
        'parent_item_colon'     => __('Parent Portfolio Item:', 'elementor-blank-starter'),
        'all_items'             => __('All Portfolio Items', 'elementor-blank-starter'),
        'add_new_item'          => __('Add New Portfolio Item', 'elementor-blank-starter'),
        'add_new'               => __('Add New', 'elementor-blank-starter'),
        'new_item'              => __('New Portfolio Item', 'elementor-blank-starter'),
        'edit_item'             => __('Edit Portfolio Item', 'elementor-blank-starter'),
        'update_item'           => __('Update Portfolio Item', 'elementor-blank-starter'),
        'view_item'             => __('View Portfolio Item', 'elementor-blank-starter'),
        'view_items'            => __('View Portfolio Items', 'elementor-blank-starter'),
        'search_items'          => __('Search Portfolio', 'elementor-blank-starter'),
        'not_found'             => __('Not found', 'elementor-blank-starter'),
        'not_found_in_trash'    => __('Not found in Trash', 'elementor-blank-starter'),
        'featured_image'        => __('Featured Image', 'elementor-blank-starter'),
        'set_featured_image'    => __('Set featured image', 'elementor-blank-starter'),
        'remove_featured_image' => __('Remove featured image', 'elementor-blank-starter'),
        'use_featured_image'    => __('Use as featured image', 'elementor-blank-starter'),
        'insert_into_item'      => __('Insert into portfolio item', 'elementor-blank-starter'),
        'uploaded_to_this_item' => __('Uploaded to this portfolio item', 'elementor-blank-starter'),
        'items_list'            => __('Portfolio items list', 'elementor-blank-starter'),
        'items_list_navigation' => __('Portfolio items list navigation', 'elementor-blank-starter'),
        'filter_items_list'     => __('Filter portfolio items list', 'elementor-blank-starter'),
    );

    $args = array(
        'label'                 => __('Portfolio Item', 'elementor-blank-starter'),
        'description'           => __('Portfolio items', 'elementor-blank-starter'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies'            => array('portfolio_category', 'portfolio_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'elementor_blank_register_portfolio_cpt', 0);

/**
 * Replace excerpt with WYSIWYG Description field for Portfolio
 */
function elementor_blank_add_portfolio_description_meta_box() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    remove_meta_box('postexcerpt', 'portfolio', 'normal');
    add_meta_box(
        'portfolio_description',
        __('Description', 'elementor-blank-starter'),
        'elementor_blank_portfolio_description_callback',
        'portfolio',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_portfolio_description_meta_box');

function elementor_blank_portfolio_description_callback($post) {
    wp_nonce_field('portfolio_description_nonce', 'portfolio_description_nonce_field');
    $description = get_post_meta($post->ID, '_portfolio_description', true);
    
    wp_editor($description, 'portfolio_description_editor', array(
        'textarea_name' => 'portfolio_description',
        'textarea_rows' => 10,
        'media_buttons' => true,
        'teeny' => false,
        'tinymce' => array(
            'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink',
            'toolbar2' => 'forecolor,backcolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help'
        )
    ));
}

function elementor_blank_save_portfolio_description($post_id) {
    if (!isset($_POST['portfolio_description_nonce_field']) || 
        !wp_verify_nonce($_POST['portfolio_description_nonce_field'], 'portfolio_description_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['portfolio_description'])) {
        update_post_meta($post_id, '_portfolio_description', wp_kses_post($_POST['portfolio_description']));
    }
}
add_action('save_post_portfolio', 'elementor_blank_save_portfolio_description');

/**
 * Register Description custom field for Elementor
 * Make it available in REST API and Elementor
 */
function elementor_blank_register_portfolio_description_meta() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    register_post_meta('portfolio', '_portfolio_description', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'description' => __('Portfolio Description', 'elementor-blank-starter'),
        'sanitize_callback' => 'wp_kses_post',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_portfolio_description_meta');

/**
 * Register Portfolio Category Taxonomy
 */
function elementor_blank_register_portfolio_category() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Portfolio Categories', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Portfolio Category', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Categories', 'elementor-blank-starter'),
        'all_items'                  => __('All Categories', 'elementor-blank-starter'),
        'parent_item'                => __('Parent Category', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Parent Category:', 'elementor-blank-starter'),
        'new_item_name'              => __('New Category Name', 'elementor-blank-starter'),
        'add_new_item'               => __('Add New Category', 'elementor-blank-starter'),
        'edit_item'                  => __('Edit Category', 'elementor-blank-starter'),
        'update_item'                => __('Update Category', 'elementor-blank-starter'),
        'view_item'                  => __('View Category', 'elementor-blank-starter'),
        'separate_items_with_commas' => __('Separate categories with commas', 'elementor-blank-starter'),
        'add_or_remove_items'        => __('Add or remove categories', 'elementor-blank-starter'),
        'choose_from_most_used'      => __('Choose from the most used', 'elementor-blank-starter'),
        'popular_items'              => __('Popular Categories', 'elementor-blank-starter'),
        'search_items'               => __('Search Categories', 'elementor-blank-starter'),
        'not_found'                  => __('Not Found', 'elementor-blank-starter'),
        'no_terms'                   => __('No categories', 'elementor-blank-starter'),
        'items_list'                 => __('Categories list', 'elementor-blank-starter'),
        'items_list_navigation'      => __('Categories list navigation', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('portfolio_category', array('portfolio'), $args);
}
add_action('init', 'elementor_blank_register_portfolio_category', 0);

/**
 * Register Portfolio Tag Taxonomy
 */
function elementor_blank_register_portfolio_tag() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Portfolio Tags', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Portfolio Tag', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Tags', 'elementor-blank-starter'),
        'all_items'                  => __('All Tags', 'elementor-blank-starter'),
        'parent_item'                => __('Parent Tag', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Parent Tag:', 'elementor-blank-starter'),
        'new_item_name'              => __('New Tag Name', 'elementor-blank-starter'),
        'add_new_item'               => __('Add New Tag', 'elementor-blank-starter'),
        'edit_item'                  => __('Edit Tag', 'elementor-blank-starter'),
        'update_item'                => __('Update Tag', 'elementor-blank-starter'),
        'view_item'                  => __('View Tag', 'elementor-blank-starter'),
        'separate_items_with_commas' => __('Separate tags with commas', 'elementor-blank-starter'),
        'add_or_remove_items'        => __('Add or remove tags', 'elementor-blank-starter'),
        'choose_from_most_used'      => __('Choose from the most used', 'elementor-blank-starter'),
        'popular_items'              => __('Popular Tags', 'elementor-blank-starter'),
        'search_items'               => __('Search Tags', 'elementor-blank-starter'),
        'not_found'                  => __('Not Found', 'elementor-blank-starter'),
        'no_terms'                   => __('No tags', 'elementor-blank-starter'),
        'items_list'                 => __('Tags list', 'elementor-blank-starter'),
        'items_list_navigation'      => __('Tags list navigation', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('portfolio_tag', array('portfolio'), $args);
}
add_action('init', 'elementor_blank_register_portfolio_tag', 0);

/**
 * Register Proyectos Post Type
 */
function elementor_blank_register_proyectos_cpt() {
    if (!get_theme_mod('enable_proyectos_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                  => _x('Proyectos', 'Post Type General Name', 'elementor-blank-starter'),
        'singular_name'         => _x('Proyecto', 'Post Type Singular Name', 'elementor-blank-starter'),
        'menu_name'             => __('Proyectos', 'elementor-blank-starter'),
        'name_admin_bar'        => __('Proyecto', 'elementor-blank-starter'),
        'archives'              => __('Proyectos Archives', 'elementor-blank-starter'),
        'attributes'            => __('Proyecto Attributes', 'elementor-blank-starter'),
        'parent_item_colon'     => __('Parent Proyecto:', 'elementor-blank-starter'),
        'all_items'             => __('Todos los Proyectos', 'elementor-blank-starter'),
        'add_new_item'          => __('Añadir Nuevo Proyecto', 'elementor-blank-starter'),
        'add_new'               => __('Añadir Nuevo', 'elementor-blank-starter'),
        'new_item'              => __('Nuevo Proyecto', 'elementor-blank-starter'),
        'edit_item'             => __('Editar Proyecto', 'elementor-blank-starter'),
        'update_item'           => __('Actualizar Proyecto', 'elementor-blank-starter'),
        'view_item'             => __('Ver Proyecto', 'elementor-blank-starter'),
        'view_items'            => __('Ver Proyectos', 'elementor-blank-starter'),
        'search_items'          => __('Buscar Proyectos', 'elementor-blank-starter'),
        'not_found'             => __('No encontrado', 'elementor-blank-starter'),
        'not_found_in_trash'    => __('No encontrado en papelera', 'elementor-blank-starter'),
        'featured_image'        => __('Imagen Destacada', 'elementor-blank-starter'),
        'set_featured_image'    => __('Establecer imagen destacada', 'elementor-blank-starter'),
        'remove_featured_image' => __('Eliminar imagen destacada', 'elementor-blank-starter'),
        'use_featured_image'    => __('Usar como imagen destacada', 'elementor-blank-starter'),
        'insert_into_item'      => __('Insertar en proyecto', 'elementor-blank-starter'),
        'uploaded_to_this_item' => __('Subido a este proyecto', 'elementor-blank-starter'),
        'items_list'            => __('Lista de proyectos', 'elementor-blank-starter'),
        'items_list_navigation' => __('Navegación de lista de proyectos', 'elementor-blank-starter'),
        'filter_items_list'     => __('Filtrar lista de proyectos', 'elementor-blank-starter'),
    );

    $args = array(
        'label'                 => __('Proyecto', 'elementor-blank-starter'),
        'description'           => __('Proyectos', 'elementor-blank-starter'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies'            => array('proyectos_category', 'proyectos_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-admin-multisite',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('proyectos', $args);
}
add_action('init', 'elementor_blank_register_proyectos_cpt', 0);

/**
 * Add Provincia custom field to Proyectos
 */
function elementor_blank_add_proyectos_provincia_meta_box() {
    if (!get_theme_mod('enable_proyectos_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'proyectos_provincia',
        __('Provincia', 'elementor-blank-starter'),
        'elementor_blank_proyectos_provincia_callback',
        'proyectos',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_proyectos_provincia_meta_box');

function elementor_blank_proyectos_provincia_callback($post) {
    wp_nonce_field('proyectos_provincia_nonce', 'proyectos_provincia_nonce_field');
    $value = get_post_meta($post->ID, '_proyectos_provincia', true);
    echo '<label for="proyectos_provincia_field">' . __('Provincia:', 'elementor-blank-starter') . '</label>';
    echo '<input type="text" id="proyectos_provincia_field" name="proyectos_provincia_field" value="' . esc_attr($value) . '" class="widefat">';
}

function elementor_blank_save_proyectos_provincia($post_id) {
    if (!isset($_POST['proyectos_provincia_nonce_field']) || 
        !wp_verify_nonce($_POST['proyectos_provincia_nonce_field'], 'proyectos_provincia_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['proyectos_provincia_field'])) {
        update_post_meta($post_id, '_proyectos_provincia', sanitize_text_field($_POST['proyectos_provincia_field']));
    }
}
add_action('save_post_proyectos', 'elementor_blank_save_proyectos_provincia');

/**
 * Register Provincia custom field for Elementor
 * Make it available in REST API and Elementor
 */
function elementor_blank_register_provincia_meta() {
    if (!get_theme_mod('enable_proyectos_cpt', false)) {
        return;
    }
    
    register_post_meta('proyectos', '_proyectos_provincia', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'description' => __('Provincia del proyecto', 'elementor-blank-starter'),
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_provincia_meta');

/**
 * Add Large Image custom field to Portfolio
 */
function elementor_blank_add_portfolio_large_image_meta_box() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'portfolio_large_image',
        __('Large Image', 'elementor-blank-starter'),
        'elementor_blank_portfolio_large_image_callback',
        'portfolio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_portfolio_large_image_meta_box');

function elementor_blank_portfolio_large_image_callback($post) {
    wp_nonce_field('portfolio_large_image_nonce', 'portfolio_large_image_nonce_field');
    $image_id = get_post_meta($post->ID, '_portfolio_large_image', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
    ?>
    <div class="portfolio-large-image-wrapper">
        <input type="hidden" id="portfolio_large_image_id" name="portfolio_large_image_id" value="<?php echo esc_attr($image_id); ?>">
        <div class="portfolio-large-image-preview" style="margin-bottom: 10px;">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width: 100%; height: auto; display: block;">
            <?php endif; ?>
        </div>
        <button type="button" class="button portfolio-upload-image-button"><?php _e('Set Large Image', 'elementor-blank-starter'); ?></button>
        <?php if ($image_id): ?>
            <button type="button" class="button portfolio-remove-image-button" style="margin-left: 5px;"><?php _e('Remove', 'elementor-blank-starter'); ?></button>
        <?php endif; ?>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var frame;
        $('.portfolio-upload-image-button').on('click', function(e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: '<?php _e('Select Large Image', 'elementor-blank-starter'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'elementor-blank-starter'); ?>'
                },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#portfolio_large_image_id').val(attachment.id);
                $('.portfolio-large-image-preview').html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto; display: block;">');
                if (!$('.portfolio-remove-image-button').length) {
                    $('.portfolio-upload-image-button').after('<button type="button" class="button portfolio-remove-image-button" style="margin-left: 5px;"><?php _e('Remove', 'elementor-blank-starter'); ?></button>');
                }
            });
            frame.open();
        });
        
        $(document).on('click', '.portfolio-remove-image-button', function(e) {
            e.preventDefault();
            $('#portfolio_large_image_id').val('');
            $('.portfolio-large-image-preview').html('');
            $(this).remove();
        });
    });
    </script>
    <?php
}

function elementor_blank_save_portfolio_large_image($post_id) {
    if (!isset($_POST['portfolio_large_image_nonce_field']) || 
        !wp_verify_nonce($_POST['portfolio_large_image_nonce_field'], 'portfolio_large_image_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['portfolio_large_image_id'])) {
        update_post_meta($post_id, '_portfolio_large_image', absint($_POST['portfolio_large_image_id']));
    }
}
add_action('save_post_portfolio', 'elementor_blank_save_portfolio_large_image');

/**
 * Register Large Image custom field for Elementor
 * Make it available in REST API and Elementor
 */
function elementor_blank_register_portfolio_large_image_meta() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    register_post_meta('portfolio', '_portfolio_large_image', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
        'description' => __('Large Image ID', 'elementor-blank-starter'),
        'sanitize_callback' => 'absint',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_portfolio_large_image_meta');

/**
 * Add Medium Image custom field to Portfolio
 */
function elementor_blank_add_portfolio_medium_image_meta_box() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'portfolio_medium_image',
        __('Medium Image', 'elementor-blank-starter'),
        'elementor_blank_portfolio_medium_image_callback',
        'portfolio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_portfolio_medium_image_meta_box');

function elementor_blank_portfolio_medium_image_callback($post) {
    wp_nonce_field('portfolio_medium_image_nonce', 'portfolio_medium_image_nonce_field');
    $image_id = get_post_meta($post->ID, '_portfolio_medium_image', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
    ?>
    <div class="portfolio-medium-image-wrapper">
        <input type="hidden" id="portfolio_medium_image_id" name="portfolio_medium_image_id" value="<?php echo esc_attr($image_id); ?>">
        <div class="portfolio-medium-image-preview" style="margin-bottom: 10px;">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width: 100%; height: auto; display: block;">
            <?php endif; ?>
        </div>
        <button type="button" class="button portfolio-upload-medium-image-button"><?php _e('Set Medium Image', 'elementor-blank-starter'); ?></button>
        <?php if ($image_id): ?>
            <button type="button" class="button portfolio-remove-medium-image-button" style="margin-left: 5px;"><?php _e('Remove', 'elementor-blank-starter'); ?></button>
        <?php endif; ?>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var mediumFrame;
        $('.portfolio-upload-medium-image-button').on('click', function(e) {
            e.preventDefault();
            if (mediumFrame) {
                mediumFrame.open();
                return;
            }
            mediumFrame = wp.media({
                title: '<?php _e('Select Medium Image', 'elementor-blank-starter'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'elementor-blank-starter'); ?>'
                },
                multiple: false
            });
            mediumFrame.on('select', function() {
                var attachment = mediumFrame.state().get('selection').first().toJSON();
                $('#portfolio_medium_image_id').val(attachment.id);
                $('.portfolio-medium-image-preview').html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto; display: block;">');
                if (!$('.portfolio-remove-medium-image-button').length) {
                    $('.portfolio-upload-medium-image-button').after('<button type="button" class="button portfolio-remove-medium-image-button" style="margin-left: 5px;"><?php _e('Remove', 'elementor-blank-starter'); ?></button>');
                }
            });
            mediumFrame.open();
        });
        
        $(document).on('click', '.portfolio-remove-medium-image-button', function(e) {
            e.preventDefault();
            $('#portfolio_medium_image_id').val('');
            $('.portfolio-medium-image-preview').html('');
            $(this).remove();
        });
    });
    </script>
    <?php
}

function elementor_blank_save_portfolio_medium_image($post_id) {
    if (!isset($_POST['portfolio_medium_image_nonce_field']) || 
        !wp_verify_nonce($_POST['portfolio_medium_image_nonce_field'], 'portfolio_medium_image_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['portfolio_medium_image_id'])) {
        update_post_meta($post_id, '_portfolio_medium_image', absint($_POST['portfolio_medium_image_id']));
    }
}
add_action('save_post_portfolio', 'elementor_blank_save_portfolio_medium_image');

/**
 * Register Medium Image custom field for Elementor
 * Make it available in REST API and Elementor
 */
function elementor_blank_register_portfolio_medium_image_meta() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    register_post_meta('portfolio', '_portfolio_medium_image', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
        'description' => __('Medium Image ID', 'elementor-blank-starter'),
        'sanitize_callback' => 'absint',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_portfolio_medium_image_meta');

/**
 * Add Small Image custom field to Portfolio
 */
function elementor_blank_add_portfolio_small_image_meta_box() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'portfolio_small_image',
        __('Small Image', 'elementor-blank-starter'),
        'elementor_blank_portfolio_small_image_callback',
        'portfolio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_portfolio_small_image_meta_box');

function elementor_blank_portfolio_small_image_callback($post) {
    wp_nonce_field('portfolio_small_image_nonce', 'portfolio_small_image_nonce_field');
    $image_id = get_post_meta($post->ID, '_portfolio_small_image', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
    ?>
    <div class="portfolio-small-image-wrapper">
        <input type="hidden" id="portfolio_small_image_id" name="portfolio_small_image_id" value="<?php echo esc_attr($image_id); ?>">
        <div class="portfolio-small-image-preview" style="margin-bottom: 10px;">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width: 100%; height: auto; display: block;">
            <?php endif; ?>
        </div>
        <button type="button" class="button portfolio-upload-small-image-button"><?php _e('Set Small Image', 'elementor-blank-starter'); ?></button>
        <?php if ($image_id): ?>
            <button type="button" class="button portfolio-remove-small-image-button" style="margin-left: 5px;"><?php _e('Remove', 'elementor-blank-starter'); ?></button>
        <?php endif; ?>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var smallFrame;
        $('.portfolio-upload-small-image-button').on('click', function(e) {
            e.preventDefault();
            if (smallFrame) {
                smallFrame.open();
                return;
            }
            smallFrame = wp.media({
                title: '<?php _e('Select Small Image', 'elementor-blank-starter'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'elementor-blank-starter'); ?>'
                },
                multiple: false
            });
            smallFrame.on('select', function() {
                var attachment = smallFrame.state().get('selection').first().toJSON();
                $('#portfolio_small_image_id').val(attachment.id);
                $('.portfolio-small-image-preview').html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto; display: block;">');
                if (!$('.portfolio-remove-small-image-button').length) {
                    $('.portfolio-upload-small-image-button').after('<button type="button" class="button portfolio-remove-small-image-button" style="margin-left: 5px;"><?php _e('Remove', 'elementor-blank-starter'); ?></button>');
                }
            });
            smallFrame.open();
        });
        
        $(document).on('click', '.portfolio-remove-small-image-button', function(e) {
            e.preventDefault();
            $('#portfolio_small_image_id').val('');
            $('.portfolio-small-image-preview').html('');
            $(this).remove();
        });
    });
    </script>
    <?php
}

function elementor_blank_save_portfolio_small_image($post_id) {
    if (!isset($_POST['portfolio_small_image_nonce_field']) || 
        !wp_verify_nonce($_POST['portfolio_small_image_nonce_field'], 'portfolio_small_image_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['portfolio_small_image_id'])) {
        update_post_meta($post_id, '_portfolio_small_image', absint($_POST['portfolio_small_image_id']));
    }
}
add_action('save_post_portfolio', 'elementor_blank_save_portfolio_small_image');

/**
 * Register Small Image custom field for Elementor
 * Make it available in REST API and Elementor
 */
function elementor_blank_register_portfolio_small_image_meta() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    register_post_meta('portfolio', '_portfolio_small_image', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
        'description' => __('Small Image ID', 'elementor-blank-starter'),
        'sanitize_callback' => 'absint',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_portfolio_small_image_meta');

/**
 * Add Title Color custom field to Portfolio
 */
function elementor_blank_add_portfolio_title_color_meta_box() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'portfolio_title_color',
        __('Title Color', 'elementor-blank-starter'),
        'elementor_blank_portfolio_title_color_callback',
        'portfolio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_portfolio_title_color_meta_box');

function elementor_blank_portfolio_title_color_callback($post) {
    wp_nonce_field('portfolio_title_color_nonce', 'portfolio_title_color_nonce_field');
    $value = get_post_meta($post->ID, 'portfolio_title_color', true);
    $value = $value ? $value : 'light';
    ?>
    <div class="portfolio-title-color-wrapper">
        <label>
            <input type="radio" name="portfolio_title_color" value="dark" <?php checked($value, 'dark'); ?>>
            <span style="display: inline-block; width: 20px; height: 20px; background-color: #313C59; vertical-align: middle; margin-right: 5px; border: 1px solid #ccc;"></span>
            <?php _e('DARK', 'elementor-blank-starter'); ?>
        </label>
        <br><br>
        <label>
            <input type="radio" name="portfolio_title_color" value="light" <?php checked($value, 'light'); ?>>
            <span style="display: inline-block; width: 20px; height: 20px; background-color: #ffffff; vertical-align: middle; margin-right: 5px; border: 1px solid #ccc;"></span>
            <?php _e('LIGHT', 'elementor-blank-starter'); ?>
        </label>
    </div>
    <?php
}

function elementor_blank_save_portfolio_title_color($post_id) {
    if (!isset($_POST['portfolio_title_color_nonce_field']) || 
        !wp_verify_nonce($_POST['portfolio_title_color_nonce_field'], 'portfolio_title_color_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['portfolio_title_color'])) {
        $allowed_values = array('dark', 'light');
        $color_value = sanitize_text_field($_POST['portfolio_title_color']);
        
        if (in_array($color_value, $allowed_values)) {
            update_post_meta($post_id, 'portfolio_title_color', $color_value);
        }
    }
}
add_action('save_post_portfolio', 'elementor_blank_save_portfolio_title_color');

/**
 * Register Title Color custom field for Elementor
 * Make it available in REST API and Elementor
 */
function elementor_blank_register_portfolio_title_color_meta() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    register_post_meta('portfolio', '_portfolio_title_color', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'description' => __('Title Color', 'elementor-blank-starter'),
        'sanitize_callback' => 'sanitize_hex_color',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_portfolio_title_color_meta');

/**
 * Add Button Text and Button Link custom fields to Portfolio
 */
function elementor_blank_add_portfolio_button_meta_box() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    add_meta_box(
        'portfolio_button_fields',
        __('Button Settings', 'elementor-blank-starter'),
        'elementor_blank_portfolio_button_callback',
        'portfolio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'elementor_blank_add_portfolio_button_meta_box');

function elementor_blank_portfolio_button_callback($post) {
    wp_nonce_field('portfolio_button_nonce', 'portfolio_button_nonce_field');
    $button_text = get_post_meta($post->ID, '_portfolio_button_text', true);
    $button_link = get_post_meta($post->ID, '_portfolio_button_link', true);
    ?>
    <p>
        <label for="portfolio_button_text"><strong><?php _e('Button Text', 'elementor-blank-starter'); ?></strong></label><br>
        <input type="text" id="portfolio_button_text" name="portfolio_button_text" value="<?php echo esc_attr($button_text); ?>" class="widefat">
    </p>
    <p>
        <label for="portfolio_button_link"><strong><?php _e('Button Link', 'elementor-blank-starter'); ?></strong></label><br>
        <input type="url" id="portfolio_button_link" name="portfolio_button_link" value="<?php echo esc_url($button_link); ?>" class="widefat" placeholder="https://">
    </p>
    <?php
}

function elementor_blank_save_portfolio_button($post_id) {
    if (!isset($_POST['portfolio_button_nonce_field']) || 
        !wp_verify_nonce($_POST['portfolio_button_nonce_field'], 'portfolio_button_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['portfolio_button_text'])) {
        update_post_meta($post_id, '_portfolio_button_text', sanitize_text_field($_POST['portfolio_button_text']));
    }
    
    if (isset($_POST['portfolio_button_link'])) {
        update_post_meta($post_id, '_portfolio_button_link', esc_url_raw($_POST['portfolio_button_link']));
    }
}
add_action('save_post_portfolio', 'elementor_blank_save_portfolio_button');

/**
 * Register Button Text and Button Link custom fields for Elementor
 * Make them available in REST API and Elementor
 */
function elementor_blank_register_portfolio_button_meta() {
    if (!get_theme_mod('enable_portfolio_cpt', false)) {
        return;
    }
    
    register_post_meta('portfolio', '_portfolio_button_text', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'description' => __('Button Text', 'elementor-blank-starter'),
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
    
    register_post_meta('portfolio', '_portfolio_button_link', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'description' => __('Button Link', 'elementor-blank-starter'),
        'sanitize_callback' => 'esc_url_raw',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));
}
add_action('init', 'elementor_blank_register_portfolio_button_meta');

/**
 * Register Proyectos Category Taxonomy
 */
function elementor_blank_register_proyectos_category() {
    if (!get_theme_mod('enable_proyectos_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Categorías de Proyectos', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Categoría de Proyecto', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Categorías', 'elementor-blank-starter'),
        'all_items'                  => __('Todas las Categorías', 'elementor-blank-starter'),
        'parent_item'                => __('Categoría Padre', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Categoría Padre:', 'elementor-blank-starter'),
        'new_item_name'              => __('Nuevo Nombre de Categoría', 'elementor-blank-starter'),
        'add_new_item'               => __('Añadir Nueva Categoría', 'elementor-blank-starter'),
        'edit_item'                  => __('Editar Categoría', 'elementor-blank-starter'),
        'update_item'                => __('Actualizar Categoría', 'elementor-blank-starter'),
        'view_item'                  => __('Ver Categoría', 'elementor-blank-starter'),
        'separate_items_with_commas' => __('Separar categorías con comas', 'elementor-blank-starter'),
        'add_or_remove_items'        => __('Añadir o eliminar categorías', 'elementor-blank-starter'),
        'choose_from_most_used'      => __('Elegir de las más usadas', 'elementor-blank-starter'),
        'popular_items'              => __('Categorías Populares', 'elementor-blank-starter'),
        'search_items'               => __('Buscar Categorías', 'elementor-blank-starter'),
        'not_found'                  => __('No Encontrado', 'elementor-blank-starter'),
        'no_terms'                   => __('No hay categorías', 'elementor-blank-starter'),
        'items_list'                 => __('Lista de categorías', 'elementor-blank-starter'),
        'items_list_navigation'      => __('Navegación de lista de categorías', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('proyectos_category', array('proyectos'), $args);
}
add_action('init', 'elementor_blank_register_proyectos_category', 0);

/**
 * Register Proyectos Tag Taxonomy
 */
function elementor_blank_register_proyectos_tag() {
    if (!get_theme_mod('enable_proyectos_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Etiquetas de Proyectos', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Etiqueta de Proyecto', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Etiquetas', 'elementor-blank-starter'),
        'all_items'                  => __('Todas las Etiquetas', 'elementor-blank-starter'),
        'parent_item'                => __('Etiqueta Padre', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Etiqueta Padre:', 'elementor-blank-starter'),
        'new_item_name'              => __('Nuevo Nombre de Etiqueta', 'elementor-blank-starter'),
        'add_new_item'               => __('Añadir Nueva Etiqueta', 'elementor-blank-starter'),
        'edit_item'                  => __('Editar Etiqueta', 'elementor-blank-starter'),
        'update_item'                => __('Actualizar Etiqueta', 'elementor-blank-starter'),
        'view_item'                  => __('Ver Etiqueta', 'elementor-blank-starter'),
        'separate_items_with_commas' => __('Separar etiquetas con comas', 'elementor-blank-starter'),
        'add_or_remove_items'        => __('Añadir o eliminar etiquetas', 'elementor-blank-starter'),
        'choose_from_most_used'      => __('Elegir de las más usadas', 'elementor-blank-starter'),
        'popular_items'              => __('Etiquetas Populares', 'elementor-blank-starter'),
        'search_items'               => __('Buscar Etiquetas', 'elementor-blank-starter'),
        'not_found'                  => __('No Encontrado', 'elementor-blank-starter'),
        'no_terms'                   => __('No hay etiquetas', 'elementor-blank-starter'),
        'items_list'                 => __('Lista de etiquetas', 'elementor-blank-starter'),
        'items_list_navigation'      => __('Navegación de lista de etiquetas', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('proyectos_tag', array('proyectos'), $args);
}
add_action('init', 'elementor_blank_register_proyectos_tag', 0);

/**
 * Register Noticias Post Type
 */
function elementor_blank_register_noticias_cpt() {
    if (!get_theme_mod('enable_noticias_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                  => _x('Noticias', 'Post Type General Name', 'elementor-blank-starter'),
        'singular_name'         => _x('Noticia', 'Post Type Singular Name', 'elementor-blank-starter'),
        'menu_name'             => __('Noticias', 'elementor-blank-starter'),
        'name_admin_bar'        => __('Noticia', 'elementor-blank-starter'),
        'archives'              => __('Noticias Archives', 'elementor-blank-starter'),
        'attributes'            => __('Noticia Attributes', 'elementor-blank-starter'),
        'parent_item_colon'     => __('Parent Noticia:', 'elementor-blank-starter'),
        'all_items'             => __('Todas las Noticias', 'elementor-blank-starter'),
        'add_new_item'          => __('Añadir Nueva Noticia', 'elementor-blank-starter'),
        'add_new'               => __('Añadir Nueva', 'elementor-blank-starter'),
        'new_item'              => __('Nueva Noticia', 'elementor-blank-starter'),
        'edit_item'             => __('Editar Noticia', 'elementor-blank-starter'),
        'update_item'           => __('Actualizar Noticia', 'elementor-blank-starter'),
        'view_item'             => __('Ver Noticia', 'elementor-blank-starter'),
        'view_items'            => __('Ver Noticias', 'elementor-blank-starter'),
        'search_items'          => __('Buscar Noticias', 'elementor-blank-starter'),
        'not_found'             => __('No encontrado', 'elementor-blank-starter'),
        'not_found_in_trash'    => __('No encontrado en papelera', 'elementor-blank-starter'),
        'featured_image'        => __('Imagen Destacada', 'elementor-blank-starter'),
        'set_featured_image'    => __('Establecer imagen destacada', 'elementor-blank-starter'),
        'remove_featured_image' => __('Eliminar imagen destacada', 'elementor-blank-starter'),
        'use_featured_image'    => __('Usar como imagen destacada', 'elementor-blank-starter'),
        'insert_into_item'      => __('Insertar en noticia', 'elementor-blank-starter'),
        'uploaded_to_this_item' => __('Subido a esta noticia', 'elementor-blank-starter'),
        'items_list'            => __('Lista de noticias', 'elementor-blank-starter'),
        'items_list_navigation' => __('Navegación de lista de noticias', 'elementor-blank-starter'),
        'filter_items_list'     => __('Filtrar lista de noticias', 'elementor-blank-starter'),
    );

    $args = array(
        'label'                 => __('Noticia', 'elementor-blank-starter'),
        'description'           => __('Noticias', 'elementor-blank-starter'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'author', 'comments'),
        'taxonomies'            => array('noticias_category', 'noticias_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-megaphone',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('noticias', $args);
}
add_action('init', 'elementor_blank_register_noticias_cpt', 0);

/**
 * Register Noticias Category Taxonomy
 */
function elementor_blank_register_noticias_category() {
    if (!get_theme_mod('enable_noticias_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Categorías de Noticias', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Categoría de Noticia', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Categorías', 'elementor-blank-starter'),
        'all_items'                  => __('Todas las Categorías', 'elementor-blank-starter'),
        'parent_item'                => __('Categoría Padre', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Categoría Padre:', 'elementor-blank-starter'),
        'new_item_name'              => __('Nuevo Nombre de Categoría', 'elementor-blank-starter'),
        'add_new_item'               => __('Añadir Nueva Categoría', 'elementor-blank-starter'),
        'edit_item'                  => __('Editar Categoría', 'elementor-blank-starter'),
        'update_item'                => __('Actualizar Categoría', 'elementor-blank-starter'),
        'view_item'                  => __('Ver Categoría', 'elementor-blank-starter'),
        'separate_items_with_commas' => __('Separar categorías con comas', 'elementor-blank-starter'),
        'add_or_remove_items'        => __('Añadir o eliminar categorías', 'elementor-blank-starter'),
        'choose_from_most_used'      => __('Elegir de las más usadas', 'elementor-blank-starter'),
        'popular_items'              => __('Categorías Populares', 'elementor-blank-starter'),
        'search_items'               => __('Buscar Categorías', 'elementor-blank-starter'),
        'not_found'                  => __('No Encontrado', 'elementor-blank-starter'),
        'no_terms'                   => __('No hay categorías', 'elementor-blank-starter'),
        'items_list'                 => __('Lista de categorías', 'elementor-blank-starter'),
        'items_list_navigation'      => __('Navegación de lista de categorías', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('noticias_category', array('noticias'), $args);
}
add_action('init', 'elementor_blank_register_noticias_category', 0);

/**
 * Register Noticias Tag Taxonomy
 */
function elementor_blank_register_noticias_tag() {
    if (!get_theme_mod('enable_noticias_cpt', false)) {
        return;
    }

    $labels = array(
        'name'                       => _x('Etiquetas de Noticias', 'Taxonomy General Name', 'elementor-blank-starter'),
        'singular_name'              => _x('Etiqueta de Noticia', 'Taxonomy Singular Name', 'elementor-blank-starter'),
        'menu_name'                  => __('Etiquetas', 'elementor-blank-starter'),
        'all_items'                  => __('Todas las Etiquetas', 'elementor-blank-starter'),
        'parent_item'                => __('Etiqueta Padre', 'elementor-blank-starter'),
        'parent_item_colon'          => __('Etiqueta Padre:', 'elementor-blank-starter'),
        'new_item_name'              => __('Nuevo Nombre de Etiqueta', 'elementor-blank-starter'),
        'add_new_item'               => __('Añadir Nueva Etiqueta', 'elementor-blank-starter'),
        'edit_item'                  => __('Editar Etiqueta', 'elementor-blank-starter'),
        'update_item'                => __('Actualizar Etiqueta', 'elementor-blank-starter'),
        'view_item'                  => __('Ver Etiqueta', 'elementor-blank-starter'),
        'separate_items_with_commas' => __('Separar etiquetas con comas', 'elementor-blank-starter'),
        'add_or_remove_items'        => __('Añadir o eliminar etiquetas', 'elementor-blank-starter'),
        'choose_from_most_used'      => __('Elegir de las más usadas', 'elementor-blank-starter'),
        'popular_items'              => __('Etiquetas Populares', 'elementor-blank-starter'),
        'search_items'               => __('Buscar Etiquetas', 'elementor-blank-starter'),
        'not_found'                  => __('No Encontrado', 'elementor-blank-starter'),
        'no_terms'                   => __('No hay etiquetas', 'elementor-blank-starter'),
        'items_list'                 => __('Lista de etiquetas', 'elementor-blank-starter'),
        'items_list_navigation'      => __('Navegación de lista de etiquetas', 'elementor-blank-starter'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('noticias_tag', array('noticias'), $args);
}
add_action('init', 'elementor_blank_register_noticias_tag', 0);

/**
 * Flush rewrite rules on theme activation
 */
function elementor_blank_flush_rewrite_rules() {
    elementor_blank_register_portfolio_cpt();
    elementor_blank_register_portfolio_category();
    elementor_blank_register_portfolio_tag();
    elementor_blank_register_proyectos_cpt();
    elementor_blank_register_proyectos_category();
    elementor_blank_register_proyectos_tag();
    elementor_blank_register_noticias_cpt();
    elementor_blank_register_noticias_category();
    elementor_blank_register_noticias_tag();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'elementor_blank_flush_rewrite_rules');
