<?php
/**
 * Taxonomy Template for GAL/GDR
 * 
 * This template displays all Municipios for a specific GAL/GDR
 * URL: /gal-gdr/nombre-del-gal/
 */

get_header();
?>

<main id="main" class="site-main taxonomy-gal-gdr">
    <header class="page-header">
        <h1 class="page-title">
            <?php single_term_title(); ?>
        </h1>
        <?php
        $term_description = term_description();
        if ($term_description) :
            echo '<div class="taxonomy-description">' . wp_kses_post($term_description) . '</div>';
        endif;
        ?>
    </header>

    <?php if (have_posts()) : ?>
        <div class="municipios-grid">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('municipio-item'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="municipio-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </header>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more">
                            <?php esc_html_e('Ver municipio', 'elementor-blank-starter'); ?>
                        </a>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>

        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('&laquo; Anterior', 'elementor-blank-starter'),
            'next_text' => __('Siguiente &raquo;', 'elementor-blank-starter'),
        ));
        ?>

    <?php else : ?>
        <div class="no-results">
            <h2><?php esc_html_e('No se encontraron municipios', 'elementor-blank-starter'); ?></h2>
            <p><?php esc_html_e('No hay municipios asociados a este GAL/GDR.', 'elementor-blank-starter'); ?></p>
        </div>
    <?php endif; ?>
</main>

<style>
.municipios-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.municipio-item {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.municipio-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.municipio-thumbnail {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.municipio-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.municipio-item .entry-header {
    padding: 1.5rem 1.5rem 0.5rem;
}

.municipio-item .entry-title {
    margin: 0;
    font-size: 1.5rem;
}

.municipio-item .entry-title a {
    color: #333;
    text-decoration: none;
}

.municipio-item .entry-title a:hover {
    color: #0073aa;
}

.municipio-item .entry-excerpt {
    padding: 0 1.5rem;
    color: #666;
}

.municipio-item .entry-footer {
    padding: 0 1.5rem 1.5rem;
}

.municipio-item .read-more {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #0073aa;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s ease;
}

.municipio-item .read-more:hover {
    background: #005177;
}

.page-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e0e0e0;
}

.page-title {
    margin: 0 0 1rem;
    font-size: 2.5rem;
}

.taxonomy-description {
    color: #666;
    font-size: 1.1rem;
}

.no-results {
    text-align: center;
    padding: 3rem;
}
</style>

<?php
get_footer();
