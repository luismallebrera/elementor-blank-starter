<?php
/**
 * Tag Archive Template
 * 
 * This template displays all posts with a specific tag.
 * URL: /tag/tag-name/
 */

get_header();
?>

<main id="main" class="site-main">
    <header class="page-header">
        <h1 class="page-title">
            <?php
            /* translators: %s: tag name */
            printf(esc_html__('Tag: %s', 'elementor-blank-starter'), single_tag_title('', false));
            ?>
        </h1>
        <?php
        $tag_description = tag_description();
        if ($tag_description) :
            echo '<div class="archive-description">' . wp_kses_post($tag_description) . '</div>';
        endif;
        ?>
    </header>

    <?php if (have_posts()) : ?>
        <div class="posts-grid">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="entry-meta">
                            <span class="posted-on"><?php echo get_the_date(); ?></span>
                        </div>
                    </header>
                    
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more">
                            <?php esc_html_e('Read more', 'elementor-blank-starter'); ?>
                        </a>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>

        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('&laquo; Previous', 'elementor-blank-starter'),
            'next_text' => __('Next &raquo;', 'elementor-blank-starter'),
        ));
        ?>

    <?php else : ?>
        <div class="no-results">
            <h2><?php esc_html_e('Nothing Found', 'elementor-blank-starter'); ?></h2>
            <p><?php esc_html_e('No posts found with this tag.', 'elementor-blank-starter'); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
