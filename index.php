<?php
/**
 * Template principal
 * Elementor manejará todo el contenido
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Mostrar el contenido de la página/post
if (have_posts()) :
    while (have_posts()) : the_post();
        the_content();
    endwhile;
endif;
?>

<?php
// Page transition elements
if (get_theme_mod('enable_page_transitions', false)) : ?>
    <div aria-hidden="true" class="transition-pannel-bg initial-load"></div>
    <?php if (get_theme_mod('enable_page_transitions_borders', true)) : ?>
        <div aria-hidden="true" class="transition-borders-bg"></div>
    <?php endif; ?>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
