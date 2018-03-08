<?php

/*
 * USER FUNCTIONS
 */
    
/**
 * Get id of the featured image
 * 
 * @param string $kdmfi_id 
 * @param int|null $post_id 
 * @return int
 */
function kdmfi_get_featured_image_id( $kdmfi_id, $post_id = null ) {
    return KdMfi::$app->get_featured_image_id( $kdmfi_id, $post_id );
}


/**
 * Get the src of the featured image
 * 
 * @param string $kdmfi_id 
 * @param string|string $size 
 * @param int|null $post_id 
 * @param string|null $fallback 
 * @return string
 */
function kdmfi_get_featured_image_src( $kdmfi_id, $size = 'full', $post_id = null, $fallback = null ) {
    return KdMfi::$app->get_featured_image_src( $kdmfi_id, $size, $post_id, $fallback );
}


/**
 * Get the html of the featured image
 * 
 * @param string $kdmfi_id 
 * @param string|string $size 
 * @param int|null $post_id 
 * @param string|null $fallback 
 * @return string
 */
function kdmfi_get_featured_image( $kdmfi_id, $size = 'full', $post_id = null, $fallback = null ) {
    return KdMfi::$app->get_featured_image( $kdmfi_id, $size, $post_id, $fallback );
}


/**
 * Output the html of the featured image
 * 
 * @param string $kdmfi_id 
 * @param string|string $size 
 * @param int|null $post_id 
 * @param string|null $fallback 
 * @return string
 */
function kdmfi_the_featured_image( $kdmfi_id, $size = 'full', $post_id = null, $fallback = null ) {
    echo KdMfi::$app->get_featured_image( $kdmfi_id, $size, $post_id, $fallback );
}


/**
 * Get the src of the featured image
 * 
 * @param string $kdmfi_id 
 * @param int|null $post_id 
 * @return bool|int
 */
function kdmfi_has_featured_image( $kdmfi_id, $post_id = null ) {
    return KdMfi::$app->has_featured_image( $kdmfi_id, $post_id );
}

?>