<?php
/**
 * Custom Post Types
 * Register custom post types for the theme
 */

if (!defined('ABSPATH')) {
    exit;
}

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
