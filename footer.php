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

        <?php if ( get_theme_mod( 'hide_socialmenu' ) == '' ) { ?>
        <!-- Social Menu -->
        <span><?php artfolio_social_menu(); ?></span>
        <?php } // end if ?>


        <?php if ( get_theme_mod( 'hide_socialmenu' ) == '' ) { ?>
        <!-- Heart animation -->
        <span class="fa heart pulseHeart"></span>
        <br />
        <?php } // end if ?>


        <?php if ( get_theme_mod( 'hide_copyright' ) == '' ) { ?>
        <!-- Copyright text -->
        <?php echo get_theme_mod( 'copyright_textbox', 'No information about copyright' ); ?>
        <br />
        <?php } // end if ?>


        <?php get_theme_mod( 'hide_wordpress_link' ) == '' ? printf( esc_html__( 'Proudly powered by %s.', 'artfolio' ), '<a href="https://wordpress.org">WordPress</a>' ) : "" ?>


        <?php get_theme_mod( 'hide_developer_link' ) == '' ? printf( esc_html__( 'Theme: %1$s by %2$s', 'artfolio' ), 'Artfolio', '<a href="https://github.com/artem-solovev" rel="developer">Artem Solovev</a>' ) : "" ?>

    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
