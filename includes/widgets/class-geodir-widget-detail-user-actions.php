<?php
/**
* GeoDirectory Detail User Actions Widget
*
* @since 2.0.0
*
* @package GeoDirectory
*/

/**
 * GeoDir_Widget_Detail_Social_Sharing class.
 *
 * @since 2.0.0
 */
class GeoDir_Widget_Detail_User_Actions extends WP_Widget {
    
    /**
     * Sets up a new Detail User Actions widget instance.
     *
     * @since 2.0.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'geodir-widget gd-widget-detail-user-actions',
            'description' => __( 'Display user actions on the lisitng detail page.', 'geodirectory' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'detail_user_actions', __( 'GD > Detail User Actions', 'geodirectory' ), $widget_ops );
    }

    /**
     * Outputs the content for the current Detail User Actions widget instance.
     *
     * @since 2.0.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Detail User Actions widget instance.
     */
    public function widget( $args, $instance ) {
        if ( !geodir_is_page( 'detail' ) ) {
            return;
        }
        
        /**
         * Filters the widget title.
         *
         * @since 2.0.0
         *
         * @param string $title    The widget title. Default 'Pages'.
         * @param array  $instance An array of the widget's settings.
         * @param mixed  $id_base  The widget ID.
         */
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        
        echo $args['before_widget'];
        
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        do_action( 'geodir_widget_before_detail_user_actions' );
        
        geodir_edit_post_link();
        
        do_action( 'geodir_widget_after_detail_user_actions' );
        
        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Detail User Actions widget instance.
     *
     * @since 2.0.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['title'] = sanitize_text_field( $new_instance['title'] );

        return $instance;
    }
    
    /**
     * Outputs the settings form for the Detail User Actions widget.
     *
     * @since 2.0.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        // Defaults
        $instance = wp_parse_args( (array)$instance, 
            array( 
                'title' => ''
            ) 
        );
        
        $title = sanitize_text_field( $instance['title'] );
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'geodirectory' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
        <?php
    }
}
