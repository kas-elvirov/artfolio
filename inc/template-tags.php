<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Artfolio
 */

if ( ! function_exists( 'artfolio_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function artfolio_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
                               esc_attr( get_the_date( 'c' ) ),
                               esc_html( get_the_date() ),
                               esc_attr( get_the_modified_date( 'c' ) ),
                               esc_html( get_the_modified_date() )
                              );

        $posted_on = sprintf(
            esc_html_x( '%s', 'post date', 'artfolio' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html_x( 'Written by %s', 'post author', 'artfolio' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>' . '<div class="post-author">' . get_avatar( get_the_author_meta( 'ID' ) ) . '</div>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'artfolio_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function artfolio_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'artfolio' ) );
            if ( $categories_list && artfolio_categorized_blog() ) {
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'artfolio' ) . '</span>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'artfolio' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'artfolio' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'artfolio' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'artfolio' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
        );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function artfolio_categorized_blog() {
        if ( false === ( $all_the_cool_cats = get_transient( 'artfolio_categories' ) ) ) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories( array(
                'fields'     => 'ids',
                'hide_empty' => 1,
                // We only need to know if there is more than one category.
                'number'     => 2,
            ) );

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count( $all_the_cool_cats );

            set_transient( 'artfolio_categories', $all_the_cool_cats );
        }

        if ( $all_the_cool_cats > 1 ) {
            // This blog has more than 1 category so artfolio_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so artfolio_categorized_blog should return false.
            return false;
        }
}

/**
 * Flush out the transients used in artfolio_categorized_blog.
 */
function artfolio_category_transient_flusher() {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Like, beat it. Dig?
        delete_transient( 'artfolio_categories' );
}
add_action( 'edit_category', 'artfolio_category_transient_flusher' );
add_action( 'save_post',     'artfolio_category_transient_flusher' );

/*
 * Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */
function artfolio_social_menu() {
        if ( has_nav_menu( 'social' ) ) {
            wp_nav_menu(
                array(
                    'theme_location'  => 'social',
                    'container'       => 'div',
                    'container_id'    => 'menu-social',
                    'container_class' => 'menu-social',
                    'menu_id'         => 'menu-social-items',
                    'menu_class'      => 'menu-items',
                    'depth'           => 1,
                    'link_before'     => '<span class="screen-reader-text">',
                    'link_after'      => '</span>',
                    'fallback_cb'     => '',
                )
            );
        }
}

/*
 * Landing menu
 */
function artfolio_landing_menu() {
        if ( has_nav_menu( 'landing' ) ) {
            wp_nav_menu(
                array(
                    'theme_location'  => 'landing',
                    'container'       => 'div',
                    'container_id'    => 'menu-landing',
                    'container_class' => 'menu-landing',
                    'depth'           => 1,
                    'fallback_cb'     => '',
                )
            );
        }
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function artfolio_post_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="post-nav-box clear">
            <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'artfolio' ); ?></h1>
            <div class="nav-links">
                <?php
        previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . __( 'Previous Post:', 'artfolio' ) . '</div><h1>%link</h1></div>', '%title' );
        next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . __( 'Next Post:', 'artfolio' ) . '</div><h1>%link</h1></div>', '%title' );
                ?>
            </div><!-- .nav-links -->
        </div><!-- .post-nav-box -->
    </nav><!-- .navigation -->
    <?php
}


if ( ! function_exists( 'artfolio_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function artfolio_paging_nav() {
        // Don't print empty markup if there's only one page.
        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 2,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => __( '&larr; Previous', 'artfolio' ),
            'next_text' => __( 'Next &rarr;', 'artfolio' ),
            'type'      => 'list',
        ) );

        if ( $links ) :

    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'artfolio' ); ?></h1>
        <?php echo $links; ?>
    </nav><!-- .navigation -->
    <?php
        endif;
}

endif;