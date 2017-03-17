<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Artfolio
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) : ?>

        <header class="page-header">
            <?php global $wp_query; ?>
            <h1 class="page-title">
                <span class="search-title"><?php echo esc_html__( 'Search Results', 'artfolio' ); ?></span>
                <span class="search-sub-title"><?php printf( __( 'for: %s', 'artfolio' ), '<span class="search-title">' . get_search_query() . '</span>' ); ?></span>
            </h1>
            <span><?php echo $wp_query->found_posts . esc_html__( ' Results found', 'artfolio' ); ?></span>
        </header><!-- .page-header -->

        <?php

        /**
        * Start the Loop
        */
        while ( have_posts() ) : the_post();

        /**
        * Run the loop for the search to output the results.
        * If you want to overload this in a child theme then include a file
        * called content-search.php and that will be used instead.
        */
        get_template_part( 'template-parts/content', 'search' );

        endwhile;

        the_posts_pagination();

        else :

        get_template_part( 'template-parts/content', 'none' );

        endif; ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php

get_sidebar();
get_footer();
