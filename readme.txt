=== Plugin Name ===
Contributors: marcus.kober
Donate link: http://www.amazon.de/registry/wishlist/16KTW9ZG027C8
Tags: image, featured image, thumbnails, media
Requires at least: 2.9.2
Tested up to: 3.3.2
Stable tag: 0.2 

Enables multiple featured images for posts and pages.

== Description ==

= Multiple featured images =

This plugin allows you to add additional featured images to a post or page. 

= Features =

1. Add as many featured images as you need
1. Fully customizable output - so it's multilingual

= History =

For one of my customers I had to assign two featured images to pages. One featured image was used as the
header image and the other as a small button for the submenu. The images had to be different too (so I couldn't 
simply use different images sizes) and so I wrote this little plugin.

= You = 

Feel free to ask if you have problems with this plugin. Feature requests are welcome too! And please correct my 
bad english if it bugs you. ;)

== Installation ==

1. Unzip and upload the `multiple-featured-images` directory to the plugin directory (`/wp-content/plugins/`)
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Registration of a new featured image:

        if( class_exists( 'kdMultipleFeaturedImages' ) ) {

                $args = array(
                        'id' => 'featured-image-2',
                        'post_type' => 'post',      // Set this to post or page
                        'labels' => array(
                            'name'      => 'Featured image 2',
                            'set'       => 'Set featured image 2',
                            'remove'    => 'Remove featured image 2',
                            'use'       => 'Use as featured image 2',
                        )
                );

                new kdMultipleFeaturedImages( $args );
        }
1. Display the featured image in your theme:

        if( class_exists( 'kdMultipleFeaturedImages' ) ) {
            kd_mfi_the_featured_image( 'featured-image-2', 'page' );
        }

== Frequently Asked Questions ==

= How do I register multiple new featured images? =

You can call new kdMultipleFeaturedImages( $args ); multiple times with different arguments in $args.

For expample:

        $args1 = array(
                'id' => 'featured-image-2',
                'post_type' => 'post',      // Set this to post or page
                'labels' => array(
                    'name'      => 'Featured image 2',
                    'set'       => 'Set featured image 2',
                    'remove'    => 'Remove featured image 2',
                    'use'       => 'Use as featured image 2',
                )
        );

        $args2 = array(
                'id' => 'featured-image-3',
                'post_type' => 'post',      // Set this to post or page
                'labels' => array(
                    'name'      => 'Featured image 3',
                    'set'       => 'Set featured image 3',
                    'remove'    => 'Remove featured image 3',
                    'use'       => 'Use as featured image 3',
                )
        );

        new kdMultipleFeaturedImages( $args1 );
        new kdMultipleFeaturedImages( $args2 );


= How do I use a different size of the featured image? =

Simply add the size to the function call:

        kd_mfi_the_featured_image( 'featured-image-2', 'page', 'full' );

You can choose every size that WordPress knows.

= How can I get the ID of the featured image? =

With this function call you can get the ID:

        kd_mfi_get_featured_image_id( 'featured-image-2', 'page', 'full' );

= How can I get the URL of the featured image? =

With this function call you can get the URL:

        kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'full' );


== Screenshots ==

1. Admin meta box with secondary featured image.
2. Media upload iFrame with 'Use as featured image 2' link.

== Changelog ==

= 0.2 =
* Code completely rewritten

= 0.1 =
* Initial release.

== Upgrade Notice ==

= 0.2 = 
Code completely rewritten. Plugin is faster now.

= 0.1 =
Initial release


