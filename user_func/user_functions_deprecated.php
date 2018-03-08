<?php

/*
 * DEPRECATED USER FUNCTIONS FROM VERSION 0.3
 */

function kd_mfi_get_featured_image_id( $image_id, $post_type, $post_id = null ) {
    return kdmfi_get_featured_image_id( $image_id, $post_id );
}

function kd_mfi_the_featured_image_url( $image_id, $post_type, $size = 'full', $post_id = null, $fallback = null ) {
    echo kdmfi_get_featured_image_src( $image_id, $size, $post_id, $fallback );
}

function kd_mfi_get_featured_image_url( $image_id, $post_type, $size = 'full', $post_id = null, $fallback = null ) {
    return kdmfi_get_featured_image_src( $image_id, $size, $post_id, $fallback );
}

function kd_mfi_get_the_featured_image( $image_id, $post_type, $size = 'full', $post_id = null, $fallback = null ) {
    return kdmfi_get_featured_image( $image_id, $size, $post_id, $fallback );
}

function kd_mfi_the_featured_image( $image_id, $post_type, $size = 'full', $post_id = null, $fallback = null ) {
    echo kdmfi_get_featured_image( $image_id, $size, $post_id, $fallback );
}

function kd_mfi_has_featured_image( $image_id, $post_type, $post_id = null ) {
    return kdmfi_has_featured_image( $image_id, $post_id );
}

/* OLD INSTANCIATION */

class kdMultipleFeaturedImages {

    public function __construct( $args ) {
        $this->newArgs = array(
            'label_name'    => $args['labels']['name'],
            'label_set'     => $args['labels']['set'],
            'label_remove'  => $args['labels']['remove'],
            'label_use'     => $args['labels']['use'],
            'id'            => $args['id'],
            'post_type'     => array( $args['post_type'] ),
        );

        KdMfi::$app->update_id( $args['id'] );

        add_filter( 'kdmfi_featured_images', array( $this, 'register' ) );
    }

    public function register( $featured_images ) {
        $featured_images[] = $this->newArgs;

        return $featured_images;
    }
}

?>