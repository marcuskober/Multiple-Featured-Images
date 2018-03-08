<?php 
namespace kdmfi\Controller;

use \KdMfi;
use \kdmfi\Model\Image_Box as Image_Box;

/**
 * Controller des User-Management-Plugins
 */
class KdMfiApp {
    private $featured_images = array();

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct() {
        // Load Textdomain
        add_action( 'plugins_loaded', array( $this, 'language' ) );

        // Enqueue Scripts
        add_action( 'admin_init', array( $this, 'enqueue_script' ) );

        // Init Plugin
        add_action( 'init', array( $this, 'init' ) );

        // Load Functions
        $this->load_functions();

        // Add Widget
        add_action( 'widgets_init', array( $this, 'kdmfi_widget' ) );    

        // Add plugin infos
        add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
    }


    /**
     * Enqueue Script
     * 
     * @return void
     */
    public function enqueue_script() {
        wp_enqueue_script(
            'kdmfi_script',
            plugins_url( 'multiple-featured-images' ).'/js/kdmfi-admin.js',
            array( 'jquery' ),
            KdMfi::$version
        );
    }


    /**
     * Load user functions
     * 
     * @return void
     */
    private function load_functions() {
        require_once( KDMFI_PLUGIN_PATH.'user_func/user_functions.php' );
        require_once( KDMFI_PLUGIN_PATH.'user_func/user_functions_deprecated.php' );
    }


    /**
     * Load textdomain
     * 
     * @return void
     */
    public function language() {
        // Internationalization
        load_plugin_textdomain( 'multiple-featured-images', false, plugin_basename( KDMFI_PLUGIN_PATH ).'/languages/' ); 
    }


    /**
     * Init the Plugin
     * 
     * @return void
     */
    public function init() {

        // Set version and update if necessary
        $this->set_version();

        // The current theme has to support post thumbnails
        if( !current_theme_supports( 'post-thumbnails' ) ) {
            add_theme_support( 'post-thumbnails' );
        }

        // Register Featured Images
        $this->featured_images = apply_filters( 'kdmfi_featured_images', array() );
        foreach( $this->featured_images as $featured_image ) {
            new Image_Box( $featured_image );
        }
    }


    /**
     * Add the widget
     * 
     * @return void
     */
    public function kdmfi_widget() {
        register_widget( 'kdmfi\Model\Kdmfi_Widget' );
    }

    /**
     * Set the current version and check for necessary updates
     * 
     * @return void
     */
    public function set_version() {
        if( !get_option( 'kdmfi_version') ) {
        }   

        update_option( 'kdmfi_version', KdMfi::$version );     
    }


    /**
     * Converts the old image ids
     * 
     * @param string $old_id 
     * @return void
     */
    public function update_id( $old_id ) {
        global $wpdb;

        $table = $wpdb->postmeta;

        $query = "UPDATE $table SET meta_key='_kdmfi_$old_id' WHERE meta_key LIKE 'kd_%$old_id%_id'";

        $wpdb->query( $query );
    }


    /**
     * Gets the featured images
     * 
     * @return array
     */
    public function get_featured_images() {
        return $this->featured_images;
    }


    public function plugin_row_meta( $links, $file ) {
        $base = plugin_basename( KDMFI_PLUGIN_FILE );

        if( $base == $file ) {
            $links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QTM2NGDLKR9TE" target="_blank">Donate</a>';
        }

        return $links;
    }


    /**
     * Gets the image id of the featured image
     * 
     * @param string $kdmfi_id 
     * @param int|null $post_id 
     * @return int
     */
    public function get_featured_image_id( $kdmfi_id, $post_id = null ) {
        if( $post_id === null ) {
            $post_id = get_the_ID();
        }

        $image_id = get_post_meta( $post_id, '_kdmfi_'.$kdmfi_id, true );

        return $image_id;
    }


    /**
     * Gets the SRC of the featured image
     * 
     * @param string $kdmfi_id 
     * @param string $size 
     * @param int|null $post_id 
     * @param string|null $fallback 
     * @return string
     */
    public function get_featured_image_src( $kdmfi_id, $size = 'full', $post_id = null, $fallback = null ) {
        $image_id = $this->get_featured_image_id( $kdmfi_id, $post_id );

        if( !$image_id  ) {
            return $fallback;
        }

        $photo_data = wp_get_attachment_image_src( $image_id, $size );
        return $photo_data[0];
    }


    /**
     * Gets the featured image html
     * 
     * @param string $kdmfi_id 
     * @param string $size 
     * @param int|null $post_id 
     * @param string|null $fallback 
     * @return string
     */
    public function get_featured_image( $kdmfi_id, $size = 'full', $post_id = null, $fallback = null ) {
        $image_id = $this->get_featured_image_id( $kdmfi_id, $post_id );

        if( !$image_id  ) {
            return $fallback;
        }

        $args = array();
        $image = wp_get_attachment_image( $image_id, $size, false, $args );
        return $image;
    }


    /**
     * Check if the post has a featured image
     * @param string $kdmfi_id 
     * @param int|null $post_id 
     * @return bool|int
     */
    public function has_featured_image( $kdmfi_id, $post_id = null ) {
        $image_id = $this->get_featured_image_id( $kdmfi_id, $post_id );

        if( !$image_id ) {
            return false;
        }

        return $image_id;
    }

}

?>