<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Artfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">

        <?php

        if ( 'post' === get_post_type() ) : ?>

        <div class="entry-meta">
            <?php artfolio_posted_on(); ?>
            <?php 
            if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                echo '<span class="comments-link">';
                comments_popup_link( __( 'Leave a comment', 'artfolio' ),  '1 <i class="fa fa-comment-o"></i>', '% <i class="fa fa-comment-o"></i>', 'artfolio' );
                echo '</span>';
            }
            ?>
            <?php
            /* translators: used between list items, there is a space after the comma */
            $category_list = get_the_category_list( __( ', ', 'artfolio' ) );

            if ( artfolio_categorized_blog() ) {
                echo '<div class="category-list">' . $category_list . '</div>';
            }
            ?>
        </div><!-- .entry-meta -->

        <?php
        endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content( sprintf(
            /* translators: %s: Name of current post. */
            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'artfolio' ), array( 'span' => array( 'class' => array() ) ) ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ) );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artfolio' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">

        <?php
        echo get_the_tag_list( '<ul><li class="tagWord">', '</li><li class="tagWord">', '</li></ul>' );
        ?>

        <?php edit_post_link( __( 'Edit', 'artfolio' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->