<?php
/**
 * The index sidebar
 *
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
    return;
}
?>

<div id="supplementary">
    <div id="index-widgets" class="index-widgets widget-area clear" role="complementary">
        <?php dynamic_sidebar( 'sidebar-3' ); ?>
    </div><!-- #index-widgets -->
</div><!-- #supplementary -->