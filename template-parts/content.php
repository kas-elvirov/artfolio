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
    <div class="index-box">
        <header class="entry-header">
            <?php
            // Display a thumb tack in the top right hand corner if this post is sticky
            if ( is_sticky() ) {
                echo '<i class="fa fa-star sticky-post"></i>';
            }


            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }


            if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php artfolio_posted_on(); ?>

                <?php
                if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
                    echo '<span class="comments-link">';

                    comments_popup_link( __( 'Leave a comment', 'artfolio' ),  '1 <i class="fa fa-comment-o"></i>', '% <i class="fa fa-comment-o"></i>', 'artfolio' );

                    echo '</span>';
                }
                ?>

                <?php
                /*
                * translators: used between list items, there is a space after the comma
                */
                $category_list = get_the_category_list( __( ', ', 'artfolio' ) );

                if ( artfolio_categorized_blog() ) {
                    echo '<div class="category-list">' . $category_list . '</div>';
                }
                ?>

                <?php edit_post_link( __( 'Edit', 'artfolio' ), '<span class="edit-link">', '</span>' ); ?>

            </div><!-- .entry-meta -->

            <?php
            if ( has_post_thumbnail() ) {
                echo '<div class="single-post-thumbnail clear">';
                echo '<a href="' . esc_url( get_permalink() ) . '" title="' . __('Click to read ', 'artfolio') . get_the_title() . '" rel="bookmark">';
                the_post_thumbnail('small-thumbnails');
                echo '</a>';
                echo '</div>';
            }
            ?>

            <?php
            endif; ?>

        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer continue-reading">

            <?php echo '<a href="' . esc_url( get_permalink() ) . '" title="' . __('Continue Reading ', 'artfolio') . get_the_title() . '" rel="bookmark"> ' . __('Continue Reading ', 'artfolio') . '<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>'; ?>

        </footer><!-- .entry-footer -->

    </div> <!-- .index-box -->
</article><!-- #post-## -->
