<?php
/**
 * Custom widget with recent posts links, images and meta-info
 *
 * @package Artfolio
 */


// Widget for recent posts with image, title, date and author
class artfolio_recent_posts extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Widget ID
            'artfolio_widget',

            // Name of the widget
            __( 'Artfolio recent posts', 'artfolio' ),

            // Description of the widget
            array( 'description' => __( 'Custom widget for recent posts with image and description', 'artfolio' ), )
        );
    }

    // Open code for widget
    public function widget( $args, $instance ) {
        $artfolio_title = apply_filters( 'widget_title', $instance['title'] );
        $artfolio_number = apply_filters( 'widget_number', absint( $instance['number'] ) );

        echo $args['before_widget'];

        if ( !empty( $artfolio_title ) ) {
            echo $args['before_title'] . $artfolio_title . $args['after_title'];
        }

        $artfolio_recent_posts = new WP_Query();
        $artfolio_recent_posts->query( 'showposts=' . $artfolio_number );

        while ( $artfolio_recent_posts->have_posts() ) {
            $artfolio_recent_posts->the_post();
?>
<ul>
    <li>

        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>" class="artfolio-posts-widget-thumbnail">
            <?php the_post_thumbnail( 'artfolio-posts-widget-thumbnails' ); ?>
        </a>
        <?php } else {?>
        <a href="<?php the_permalink(); ?>" class="artfolio-posts-widget-thumbnail artfolio-posts-widget-image-plug-wrapper">
            <i class="fa fa-picture-o artfolio-posts-widget-image-plug" aria-hidden="true"></i>
        </a>
        <?php }?>

        <header class="artfolio-posts-widget-header"
                <h3>
        <a href="<?php the_permalink(); ?>" class="arp-title"><?php esc_html( the_title() ); ?></a>
    </h3>

<div class="artfolio-posts-widget-meta">
    <p class="artfolio-posts-widget-time"><?php the_time( 'F jS, Y' ); ?></p>
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="artfolio-posts-widget-author">
        <?php esc_html( the_author() ); ?>
    </a>
</div> <!-- .artfolio-posts-widget-meta-->
<?php
            /* translators: used between list items, there is a space after the comma */
            $category_list = get_the_category_list( __( ', ', 'artfolio' ) );

            if ( artfolio_categorized_blog() ) {
                echo '<div class="category-list">' . $category_list . '</div>';
            }
?>
</header> <!-- .artfolio-posts-widget-header-->
</li>
</ul>
<?php
        }

        /*
        *  reset the query
        */
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    // Close code for widget
    public function form( $instance ) {

        if ( isset( $instance[ 'number' ] ) ) {
            $artfolio_number = $instance[ 'number' ];
        } else {
            $artfolio_number = 5;
        }

        if ( isset( $instance[ 'title' ] ) ) {
            $artfolio_title = $instance[ 'title' ];
        } else {
            $artfolio_title = __( 'Recent posts', 'artfolio' );
        }

        // For administration console
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'artfolio' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $artfolio_title ); ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'artfolio' ); ?></label>
    <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $artfolio_number; ?>" size="3" />
</p>

<?php
    }

    // Widget update
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : 5;

        return $instance;
    }

} // end class recent_posts

// Widget registration
function artfolio_widget_recentposts() {
    register_widget( 'artfolio_recent_posts' );
}

add_action( 'widgets_init', 'artfolio_widget_recentposts' );
?>
