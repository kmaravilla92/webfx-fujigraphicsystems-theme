<?php

class dynamic_categories extends WP_Widget {

    function __construct() {
        parent::__construct(
            // widget ID
            'dynamic_categories',
            // widget name
            __('Dynamic Categories', ' webfx'),
            // widget description
            array( 'description' => __( 'This will query all categories related to current post type.', 'webfx' ), )
        );
    }
    public function widget( $args, $instance ) {
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $post_type  = get_post_type();
        $cat_args   = array(
            'walker'                => null,
            'taxonomy'              => fx_get_taxonomy(),
        );

        echo $args['before_widget'];
        
        echo "<h4>Categories</h4>";

        echo "<ul id='post-type-{$post_type}' class='taxonomy_wrapper js-taxonomy'>";
            
            fx_wp_terms_checklist(0,$cat_args); 

        echo "</ul>";

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Default Title', 'webfx' );
    ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}