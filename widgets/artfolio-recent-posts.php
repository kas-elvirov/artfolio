<?php

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
        $title = apply_filters( 'widget_title', $instance['title'] );
        $number = apply_filters( 'widget_number', absint( $instance['number'] ) );

        echo $args['before_widget'];

        if ( !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $art_recent_posts = new WP_Query();
        $art_recent_posts->query( 'showposts=' . $number );

        while ( $art_recent_posts->have_posts() ) {
            $art_recent_posts->the_post();
?>
<ul>
    <li>

        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>" class="arp-thumbnail">
            <?php the_post_thumbnail( 'artfolio-recent-thumbnails' ); ?>
        </a>
        <?php } else {?>
        <a href="<?php the_permalink(); ?>" class="arp-thumbnail imagePlugWrapper">
            <i class="fa fa-picture-o imagePlug" aria-hidden="true"></i>
        </a>
        <?php }?>

        <header class="arp-header"
                <h3>
        <a href="<?php the_permalink(); ?>" class="arp-title"><?php esc_html( the_title() ); ?></a>
    </h3>

<div class="arp-meta">
    <p class="arp-time"><?php the_time( 'F jS, Y' ); ?></p>
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="arp-author">
        <?php esc_html( the_author() ); ?>
    </a>
</div> <!-- .arp-meta-->
<?php
            /* translators: used between list items, there is a space after the comma */
            $category_list = get_the_category_list( __( ', ', 'artfolio' ) );

            if ( artfolio_categorized_blog() ) {
                echo '<div class="category-list">' . $category_list . '</div>';
            }
?>
</header> <!-- .arp-header-->
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
            $number = $instance[ 'number' ];
        } else {
            $number = 5;
        }

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Recent posts', 'artfolio' );
        }

        // For administration console
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'artfolio' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'artfolio' ); ?></label>
    <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
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
