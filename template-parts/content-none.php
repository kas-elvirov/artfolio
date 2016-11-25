<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Artfolio
 */

?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
    <div class="index-box">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                if ( is_404() ) {
                    _e( 'Page not available', 'artfolio' );

                } else if ( is_search() ) {
                    echo __( 'Nothing found', 'artfolio');

                } else {
                    _e( 'Nothing Found', 'artfolio' );

                }
                ?>
            </h1>
            <span><?php echo get_search_query(); ?></span>

            <hr />

            <div class="entry-content">
                <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'artfolio' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

                <?php elseif ( is_404() ) : ?>

                <p><?php _e( 'You seem to be lost. To find what you are looking for check out the most recent articles below or try a search:', 'artfolio' ); ?></p>
                <?php get_search_form(); ?>

                <?php elseif ( is_search() ) : ?>

                <p><?php _e( 'Nothing matched your search terms. Check out the most recent articles below or try searching for something else:', 'artfolio' ); ?></p>
                <?php get_search_form(); ?>

                <?php else : ?>

                <p><?php _e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'artfolio' ); ?></p>
                <?php get_search_form(); ?>

                <?php endif; ?>
            </div><!-- .entry-content -->
        </header>
    </div><!-- .index-box -->
</section><!-- .no-results -->
