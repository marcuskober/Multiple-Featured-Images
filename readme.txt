=== Multiple Featured Images ===
Contributors: marcuskober
Tags: post thumbnail, featured image, custom post type
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QTM2NGDLKR9TE
Requires at least: 3.5
Tested up to: 4.6.1
Stable tag: trunk
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html

Enables multiple featured images for all post types. Comes with a widget for displaying the featured images.

== Description ==
= Multiple featured images =

> **Now compatible to PHP 5.3 again** Because of various support requests I've established compatibility to PHP 5.3 again.

You need more than one featured image for posts, pages and/or custom post types? Then this plugin is for you!

It enables multiple featured images for all post types and comes with a widget for displaying your additional images.

> **IMPORTANT NOTE TO THOSE UPDATING FROM 0.3:** The Plugin comes with a new method for registering featured images and updates the post meta key. It is fully backwards compatible, but if you are calling the post metas directly then please update your code accordingly. The new format of the post meta key is _kdmfi_YOUR_ID.

= Features =

1. Add as many featured images as you need
1. Add the featured images to any post type (post, page or even custom post types)
1. Fully customizable output - so it's multilingual

= History =

For one of my customers I had to assign two featured images to pages. One featured image was used as the
header image and the other as a small button for the submenu. The images had to be different too (so I couldn't 
simply use different images sizes) and so I wrote this little plugin.

= You = 

Feel free to ask if you have problems with this plugin. Feature requests are welcome too! 

== Installation ==
1. Unzip and upload the `multiple-featured-images` directory to the plugin directory (`/wp-content/plugins/`)
1. Activate the plugin through the 'Plugins' menu in WordPress
1. For registration of a new featured image please use the handy filter:

        add_filter( 'kdmfi_featured_images', function( $featured_images ) {
            $args = array(
                'id' => 'featured-image-2',
                'desc' => 'Your description here.',
                'label_name' => 'Featured Image 2',
                'label_set' => 'Set featured image 2',
                'label_remove' => 'Remove featured image 2',
                'label_use' => 'Set featured image 2',
                'post_type' => array( 'page' ),
            );

            $featured_images[] = $args;

            return $featured_images;
        });
1. Display the featured image in your theme (e.g. in header.php or single.php):

        kdmfi_the_featured_image( 'featured-image-2', 'full' );

== Frequently Asked Questions ==
= How do I register multiple new featured images? =

Use the handy filter to add multiple featured images.

For expample:

        add_filter( 'kdmfi_featured_images', function( $featured_images ) {
            $args_1 = array(
                'id' => 'featured-image-2',
                'desc' => 'Your description here.',
                'label_name' => 'Featured Image 2',
                'label_set' => 'Set featured image 2',
                'label_remove' => 'Remove featured image 2',
                'label_use' => 'Set featured image 2',
                'post_type' => array( 'page' ),
            );

            $args_2 = array(
                'id' => 'featured-image-3',
                'desc' => 'Your description here.',
                'label_name' => 'Featured Image 3',
                'label_set' => 'Set featured image 3',
                'label_remove' => 'Remove featured image 3',
                'label_use' => 'Set featured image 3',
                'post_type' => array( 'page', 'post' ),
            );

            $featured_images[] = $args_1;
            $featured_images[] = $args_2;

            return $featured_images;
        });


= How do I use a different size of the featured image? =

Simply add the size to the function call:

        kdmfi_the_featured_image( 'featured-image-2', 'full' );

You can choose every size that WordPress knows.

= How can I get the ID of the featured image? =

With this function call you can get the ID:

        kdmfi_get_featured_image_id( 'featured-image-2' );
        
*Note:* Since a featured image has only one individual id, there is no option 'size' in this function call.

= How can I get the URL of the featured image? =

With this function call you can get the URL:

        kdmfi_get_featured_image_src( 'featured-image-2', 'full' );

= Which functions do exist? =

1. If you need the ID only, use this function:

        kdmfi_get_featured_image_id( $image_id, $post_id );

    $post_id is optional, if you leave it out, the ID of the calling post is used.

1. To get the URL of the image:

        kdmfi_get_featured_image_src( $image_id, $size, $post_id );

    $post_id is optional (see above); $size is optional and defaults to 'full'.

1. To get the featured image in HTML as a string:

        kdmfi_get_the_featured_image( $image_id, $size, $post_id );

    Again, $size and $post_id are optional.

1. To display the featured image directly:

        kdmfi_the_featured_image( $image_id, $size, $post_id ) {

    Again, $size and $post_id are optional.

1. To check if the post has a featured image:

        kdmfi_has_featured_image( $image_id, $post_id ) {

    $post_id is optional. The function returns the id of the attachment if there's one and false if not.

== Screenshots ==
1. Admin meta box with multiple featured images.
2. Media uploader.
3. Multiple Featured Images Widget

== Changelog ==
= 0.4.3 =
* Backwards compatibility to PHP 5.3.10
* Added support for translations

= 0.4.2 =
* Bug fixes

= 0.4.1 =
* Bug fixes

= 0.4.0 =
* Completely rewritten; added Widget

= 0.3 =
* Bug fix: no output of url when a size is given

= 0.2 =
* Code completely rewritten

= 0.1 =
* Initial release.

== Upgrade Notice ==
= 0.4.0 = 
Code completely rewritten. Plugin is faster now and comes with a handy widget. 