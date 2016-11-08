<?php
/**
 * Template part for displaying posts at the index page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Artfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="index-box content-aside">
        <header class="entry-header">
            <?php
            // Display a thumb tack in the top right hand corner if this post is sticky
            if ( is_sticky() ) {
                echo '<i class="fa fa-star sticky-post"></i>';
            }
            ?>

            <?php

            if ( 'post' === get_post_type() ) : ?>

            <div class="entry-meta">

                <?php 
                if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                    echo '<span class="comments-link">';
                    comments_popup_link( __( 'Leave a comment', 'artfolio' ),  '1 <i class="fa fa-comment-o"></i>', '% <i class="fa fa-comment-o"></i>', 'artfolio' );
                    echo '</span>';
                }
                ?>
                <?php edit_post_link( __( 'Edit', 'artfolio' ), '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-meta -->

            <?php
            endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php artfolio_posted_on(); ?>
        </footer><!-- .entry-footer -->
    </div><!-- .index-box -->
</article><!-- #post-## -->