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
            if ( is_category() ) {
                echo '<h1 class="page-title">';
                single_cat_title();
                echo '</h1>';

                echo '<span>';
                echo __( 'Category', 'artfolio' );
                echo '</span>';

                the_archive_description( '<div class="taxonomy-description">', '</div>' );

            } else if ( is_tag() ) {
                echo '<h1 class="tagWord">';
                single_tag_title();
                echo '</h1>';

                echo '<br />';

                echo '<span>';
                echo __( 'tag', 'artfolio' );
                echo '</span>';

            } else if ( is_author() ) {
                echo '<div class="post-author">' . get_avatar( get_the_author_meta( 'ID' ) ) . '</div>';

                echo '<h1 class="page-title">';
                echo get_the_author();
                echo '</h1>';

                echo '<span>';
                echo __( 'Author', 'artfolio' );
                echo '</span>';

            }else if ( is_day() ) {
                printf( __( 'Posts from %s', 'artfolio' ), '<span>' . get_the_date() . '</span>' );

            } else if ( is_month() ) {
                printf( __( 'Posts from %s', 'artfolio' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'artfolio' ) ) . '</span>' );

            } else if ( is_year() ) {
                printf( __( 'Posts from %s', 'artfolio' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'artfolio' ) ) . '</span>' );

            } else if ( is_tax( 'post_format', 'post-format-aside' ) )  {
                _e( 'Asides', 'artfolio' );

            } else {
                _e( 'Archives', 'artfolio' );

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

        artfolio_paging_nav();

        else :
        get_template_part( 'template-parts/content', 'none' );

        endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
