<?php
namespace kdmfi\Model;

use \KdMfi;

class Kdmfi_Widget extends \WP_Widget {
 
    /**
     * Construct
     * 
     * @return void
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_kdmfi',
            'customize_selective_refresh' => true,
            'description' => __( 'Shows featured image of your choice', 'multiple-featured-images' ),
        );

        parent::__construct( 'kdmfi_widget', __( 'Multiple featured images', 'multiple-featured-images' ), $widget_ops );
    }


    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );        

        $featured_image_id = empty( $instance['featured_image'] ) ? '' : $instance['featured_image'];
        $image_size = empty( $instance['image_size'] ) ? 'full' : $instance['image_size'];

        if( $featured_image_id ) {
            $featured_image = apply_filters( 'kdmfi_widget_image', kdmfi_get_featured_image( $featured_image_id, $image_size ), $instance, $this->id_base );
        }

        echo $args['before_widget'];
        
        if ( !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } 

        ?>
        <div class="kdmfi-image-container">
            <?php echo $featured_image; ?>
        </div>

        <?php
        echo $args['after_widget'];        
    }


    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        $title = !empty( $instance['title'] ) ? $instance['title'] : '';
        $featured_image = !empty( $instance['featured_image'] ) ? $instance['featured_image'] : '';
        $image_size = !empty( $instance['image_size'] ) ? $instance['image_size'] : 'full';

        $featured_images = Kdmfi::$app->get_featured_images();
        $image_sizes = get_intermediate_image_sizes();
        $image_sizes[] = 'full';

        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'multiple-featured-images' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'featured_image' ) ); ?>"><?php esc_attr_e( 'Featured image:', 'multiple-featured-images' ); ?></label> 
            <select id="<?php echo $this->get_field_id('featured_image'); ?>" name="<?php echo $this->get_field_name('featured_image'); ?>">
                <?php 
                foreach( $featured_images as $fi ) {
                    echo '<option value="'.$fi['id'].'"';
                    selected( $featured_image, $fi['id'] );
                    echo '>';
                    echo $fi['label_name'];
                    echo '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>"><?php esc_attr_e( 'Image size:', 'multiple-featured-images' ); ?></label> 
            <select id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
                <?php 
                foreach( $image_sizes as $is ) {
                    echo '<option value="'.$is.'"';
                    selected( $image_size, $is );
                    echo '>';
                    echo $is;
                    echo '</option>';
                }
                ?>
            </select>
        </p>

        <?php 


    }


    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
        $instance['featured_image'] = ( !empty( $new_instance['featured_image'] ) ) ? $new_instance['featured_image'] : '';
        $instance['image_size'] = ( !empty( $new_instance['image_size'] ) ) ? $new_instance['image_size'] : 'full';

        return $instance;    
    }
}

?>