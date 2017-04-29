<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Artfolio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'artfolio' ); ?></a>

            <?php if ( !is_404() ) { ?>

            <header id="masthead" class="site-header" role="banner">
                <?php if ( is_front_page() && is_home() && get_theme_mod( "show_slider" ) == '' ) { ?>

                <div class="site-branding header-background-image-for-single" style="height:<?php echo esc_attr( get_custom_header()->height ); ?>px">

                    <?php artfolio_display_slider(); ?>

                </div>

                <?php } else { ?>

                <?php if ( get_header_image() && ( 'blank' == get_header_textcolor() ) ) { ?>

                <div class="header-image">

                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img src="<?php //esc_url( header_image() ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
                    </a>
                </div>
                <?php } // End header image check. ?>

                <?php
                              /**
                * If page has a thumbnail, it is displayed in the header
                * */
                              if ( ( is_single() || is_page() ) && has_post_thumbnail() ) {
                                  echo '<div class="site-branding header-background-image-for-single" style="background-image: url(' . 
                                      get_the_post_thumbnail_url( null, 'artfolio-large-thumbnails' ) . ');>';
                              } else {
                                  if ( get_header_image() && !( 'blank' == get_header_textcolor() ) ) {
                                      echo '<div class="site-branding header-background-image" style="background-image: url(' . get_header_image() . ')">';
                                  } else {
                                      echo '<div class="site-branding">';
                                  }
                              }
                ?>

                <?php if ( is_single() || is_page() ) { ?>
                <div class="header-box-single">
                    <?php } else { ?>
                    <div class="header-box">
                        <?php } ?>

                        <?php if ( is_single() || is_page() ) {
                    the_title( '<h1 class="site-title" style="color:#fff">', '</h1>' );
                } else { ?>


                        <?php the_custom_logo(); ?>
                        <?php
                        if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                        endif;
                        ?>
                        <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php
                        endif; ?>

                        <?php artfolio_landing_menu(); ?>

                        <?php } ?>

                    </div><!-- .header-box or .header-box-single -->

                </div><!-- .site-branding -->
                <?php } // end if for SLIDER ?>

                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>

                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

                    <div class="search-toggle">
                        <i class="fa fa-search"></i>
                        <a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'artfolio' ); ?></a>
                    </div>

                    <?php artfolio_social_menu(); ?>
                </nav><!-- #site-navigation -->

                <div id="search-container" class="search-box-wrapper clear">
                    <div class="search-box clear">
                        <?php get_search_form(); ?>
                    </div>
                </div>

            </header><!-- #search-container -->

            <?php } ?>

            <div id="content" class="site-content">
