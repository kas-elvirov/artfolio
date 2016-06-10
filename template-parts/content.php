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
                    if ( is_single() ) {
                            the_title( '<h1 class="entry-title">', '</h1>' );
                    } else {
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    }
                    

                // Display a thumb tack in the top right hand corner if this post is sticky
                if (is_sticky()) {
                    echo '<i class="fa fa-thumb-tack sticky-post"></i>';
                }


		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
                    <?php artfolio_posted_on(); ?>
                    <?php 
                        if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                            echo '<span class="comments-link">';
                            comments_popup_link( __( 'Leave a comment', 'artfolio' ), __( '1 Comment', 'artfolio' ), __( '% Comments', 'artfolio' ) );
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
                    <?php edit_post_link( __( 'Edit', 'artfolio' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
               <?php 
                    if ( has_post_thumbnail() ) {
                        echo '<div class="single-post-thumbnail clear">';
                            echo '<a href="' . get_permalink() . '" title="' . __('Click to read ', 'artfolio') . get_the_title() . '" rel="bookmark">';
                                echo the_post_thumbnail('small-thumbnails');
                            echo '</a>';
                        echo '</div>';
                    }
                ?>
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
//			the_content( sprintf(
//				/* translators: %s: Name of current post. */
//				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'artfolio' ), array( 'span' => array( 'class' => array() ) ) ),
//				the_title( '<span class="screen-reader-text">"', '"</span>', false )
//			) );
                    the_excerpt();

//                    wp_link_pages( array(
//                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artfolio' ),
//                            'after'  => '</div>',
//                    ) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer continue-reading">
            <?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'artfolio') . get_the_title() . '" rel="bookmark">Continue Reading' . '<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>'; ?>
        </footer><!-- .entry-footer -->
        
    </div> <!-- .index-box -->
</article><!-- #post-## -->
