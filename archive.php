<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Artfolio
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
            // Standart solution for this type of task
            //the_archive_title( '<h1 class="page-title">', '</h1>' );
            //the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>

            <?php
            echo '<span>';
            echo the_archive_title();
            echo '</span>';
            echo '<br />';

            if ( is_category() ) {
                the_archive_description( '<div class="taxonomy-description">', '</div>' );

            } else if ( is_tag() ) {
                echo '<h1 class="tagWord">';
                single_tag_title();
                echo '</h1>';

            } else if ( is_author() ) {
                echo '<div class="post-author">' . get_avatar( get_the_author_meta( 'ID' ) ) . '</div>';

            }

            ?>
        </header><!-- .page-header -->

        <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();

        /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
        get_template_part( 'template-parts/content', get_post_format() );

        endwhile;

        the_posts_pagination( $args );

        else :
        get_template_part( 'template-parts/content', 'none' );

        endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
