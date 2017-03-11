<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Artfolio
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php

        if ( is_404() ) {
            get_template_part( 'template-parts/content', '404' );
        } else {
            get_template_part( 'template-parts/content', 'none' );

        }

        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php

if ( !is_404() ) {
    get_footer();
}
