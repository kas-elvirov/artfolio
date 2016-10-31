<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Artfolio
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <?php get_sidebar( 'footer' ); ?>
    <div class="site-info">
        <span><?php get_option( 'socialMenu' ) ? artfolio_social_menu() : "" ?></span>
        <span class="fa heart pulseHeart"></span>
        <br />

        <?php echo get_option( 'copyright' ); ?>
        <br />

        <?php get_option( 'wordpressLink' ) ? printf( esc_html__( 'Proudly powered by %s.', 'artfolio' ), '<a href="https://wordpress.org">WordPress</a>' ) : "" ?>

        <?php get_option( 'developerLink' ) ? printf( esc_html__( 'Theme: %1$s by %2$s', 'artfolio' ), 'Artfolio', '<a href="https://github.com/artem-solovev" rel="developer">Artem Solovev</a>' ) : "" ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
