<?php
namespace kdmfi\Model;

use \KdMfi;

class Image_Box {

    /**
     * Default arguments for the image box 
     * 
     * @var array $defaultArgs
     */
    private static $defaultArgs = array(
        'id' => 'featured-image-2',
        'desc' => '',
        'label_name' => 'Featured Image 2',
        'label_set' => 'Set featured image 2',
        'label_remove' => 'Remove featured image 2',
        'label_use' => 'Use as featured image 2',
        'post_type' => array( 'page', 'post' ),
        'image_id' => null,
        'image_class' => null,
        'image_alt' => null,
        'image_title' => null,
    );


    /**
     * Arguments of the instance
     * 
     * @var array $args
     */
    private $args = array();


    /**
     * Register the meta box
     * 
     * @param array $args 
     * @return void
     */
    public function __construct( $args ) {
        $this->args = wp_parse_args( $args, self::$defaultArgs );

        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );

        add_action( 'wp_ajax_kdmfi_set_featured_image', array( '\kdmfi\Model\Image_Box', 'ajax_set_featured_image' ) );
        add_action( 'wp_ajax_kdmfi_remove_featured_image', array( '\kdmfi\Model\Image_Box', 'ajax_remove_featured_image' ) );
    }

    
    /**
     * Add the meta box(es) to the post types
     * 
     * @return void
     */
    public function add_meta_box() {
        if( !is_array( $this->args['post_type'] ) ) {
            $this->args['post_type'] = array( $this->args['post_type'] );
        }
        
        foreach( $this->args['post_type'] as $post_type ) {
            add_meta_box(
                $this->args['id'].'-'.$post_type,
                $this->args['label_name'],
                array( $this, 'meta_box_content' ),
                $post_type,
                'side',
                'low'
            );
        }
    }


    /**
     * Display meta box content
     * 
     * @param object $post 
     * @return void
     */
    public function meta_box_content( $post ) {
        $id = $this->args['id'];
        $desc = $this->args['desc'];
        $image_id = '_kdmfi_'.$id;
        $title = $this->args['label_name'];
        $label_set = $this->args['label_set'];
        $label_use = $this->args['label_use'];        
        $label_remove = $this->args['label_remove'];

        $photo_id = get_post_meta( $post->ID, $image_id, true );

        $nonce = wp_create_nonce( $id.$post->ID );

        if( $photo_id ) {
            $link_title = wp_get_attachment_image( $photo_id, 'full', false, array( 'style' => 'width:100%;height:auto;', ) );
            $hide_remove_button = '';
        }
        else {
            $photo_id = -1;
            $link_title = $label_set;
            $hide_remove_button = 'display: none;';
        }
        ?>

        <?php if( $desc ) : ?>
        <p class="howto"><?php echo $desc; ?></p>
        <?php endif; ?>

        <p class="hide-if-no-js kdmfi-image-container-<?php echo $id; ?>"><a href="#" class="kdmfi-add-media kdmfi-media-edit kdmfi-media-edit-<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-nonce="<?php echo $nonce; ?>" data-postid="<?php echo $post->ID; ?>" style="display: inline-block;"><?php echo $link_title; ?></a></p>

        <p class="hide-if-no-js hide-if-no-image-<?php echo $id; ?>" style="<?php echo $hide_remove_button; ?>"><a href="#" class="kdmfi-media-delete kdmfi-media-delete-<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-nonce="<?php echo $nonce; ?>" data-postid="<?php echo $post->ID; ?>" data-label_set="<?php echo $label_set; ?>"><?php echo $label_remove; ?></a></p>    

        <?php
    }

    /**
     * Handle ajax call for setting featured image
     * 
     * @return void
     */
    public static function ajax_set_featured_image() {
        $photoid = intval( $_POST['photoid'] );
        $postid = intval( $_POST['postid'] );
        $kdmfi_id = $_POST['kdmfi_id'];

        check_ajax_referer( $kdmfi_id.$postid, 'sec' );

        if( wp_attachment_is_image( $photoid ) ) {
            echo wp_get_attachment_image( $photoid, 'full', false, array( 'style' => 'width:100%;height:auto;', ) );
            update_post_meta( $postid, '_kdmfi_'.$kdmfi_id, $photoid );
        }
    
        wp_die();
    }


    /**
     * Handle ajax call for removing featured image
     * 
     * @return void
     */
    public static function ajax_remove_featured_image() {
        $postid = intval( $_POST['postid'] );
        $label_set = $_POST['label_set'];
        $kdmfi_id = $_POST['kdmfi_id'];

        check_ajax_referer( $kdmfi_id.$postid, 'sec' );

        delete_post_meta( $postid, '_kdmfi_'.$kdmfi_id );

        echo $label_set;

        wp_die();
    }
}

?>