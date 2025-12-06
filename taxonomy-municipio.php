<?php
/**
 * Template for Municipio taxonomy archive
 */

get_header();
?>

<main id="content" class="site-main">
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <h1 class="page-title">
                <?php single_term_title(); ?>
            </h1>
            <?php
            $term_description = term_description();
            if ( ! empty( $term_description ) ) :
                echo '<div class="taxonomy-description">' . $term_description . '</div>';
            endif;
            ?>
        </header>

        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        endwhile;

        the_posts_navigation();
        ?>

    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
</main>

<?php
get_footer();
