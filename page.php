<?php
/**
 * Template para páginas
 */
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        the_content();
    endwhile;
endif;

get_footer();

// Page transition elements
if (get_theme_mod('enable_page_transitions', false)) : ?>
    <div aria-hidden="true" class="transition-borders-bg"></div>
    <div aria-hidden="true" class="transition-pannel-bg"></div>
<?php endif;
