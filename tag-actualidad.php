<?php
/**
 * Single Tag Template - Actualidad
 * 
 * This template is used ONLY for the tag "actualidad"
 * File name format: tag-{slug}.php
 * URL: /tag/actualidad/
 */

get_header();
?>

<main id="main" class="site-main tag-actualidad">
    <header class="page-header custom-header">
        <h1 class="page-title"><?php single_tag_title(); ?></h1>
        <?php
        $tag_description = tag_description();
        if ($tag_description) :
            echo '<div class="tag-description">' . wp_kses_post($tag_description) . '</div>';
        endif;
        ?>
    </header>

    <?php if (have_posts()) : ?>
        <div class="posts-list">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;
            ?>
        </div>

        <?php the_posts_pagination(); ?>

    <?php else : ?>
        <p><?php esc_html_e('No posts found.', 'elementor-blank-starter'); ?></p>
    <?php endif; ?>
</main>

<?php
get_footer();
