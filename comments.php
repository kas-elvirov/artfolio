<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Artfolio
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // Comments loop
    if ( have_comments() ) : ?>
    <h2 class="comments-title">
        <?php
        $comments_number = get_comments_number();
        if ( 1 === $comments_number ) {
            printf(
                /* translators: %s: post title */
                esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', '_s' ),
                '<span>' . get_the_title() . '</span>'
            );
        } else {
            printf( // WPCS: XSS OK.
                /* translators: 1: number of comments, 2: post title */
                esc_html( _nx(
                '%1$s thought on &ldquo;%2$s&rdquo;',
                '%1$s thoughts on &ldquo;%2$s&rdquo;',
                $comments_number,
                'comments title',
                '_s'
            ) ),
                number_format_i18n( $comments_number ),
                '<span>' . get_the_title() . '</span>'
            );
        }
        ?>
    </h2>

    <ol class="comment-list">
        <?php
        wp_list_comments( array(
            'style'      => 'ol',
            'short_ping' => true,
            'avatar_size'=> 50,
        ) );
        ?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

    <nav id="comment-nav-below" class="comment-navigation clear" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'artfolio' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '<i class="fa fa-long-arrow-left" aria-hidden="true"></i> Older Comments', 'artfolio' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <i class="fa fa-long-arrow-right" aria-hidden="true"></i>', 'artfolio' ) ); ?></div>
    </nav><!-- #comment-nav-below -->

    <?php
    endif; // Check for comment navigation.

    endif; // Check for have_comments().

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'artfolio' ); ?></p>

    <?php
    endif;

    comment_form();
    ?>

</div><!-- #comments -->
