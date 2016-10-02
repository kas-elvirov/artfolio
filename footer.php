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
                    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'artfolio' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'artfolio' ), 'WordPress' ); ?></a>
                    <span class="sep"> | </span>
                    <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'artfolio' ), 'artfolio', '<a href="https://github.com/artem-solovev" rel="designer">Artem Solovev</a>' ); ?>
            </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
