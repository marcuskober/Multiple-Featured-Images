=== Multiple Featured Images ===
Contributors: marcuskober
Tags: post thumbnail, featured image, custom post type, multiple featured images, multiple featured image, woocommerce, woo-commerce
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QTM2NGDLKR9TE
Requires at least: 3.5
Requires PHP: 5.3
Tested up to: 4.9.4
Stable tag: trunk
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html

Enables multiple featured images for all post types (including custom post types and WooCommerce products). Comes with a widget and a handy shortcode for displaying the featured images.

== Description ==

You need more than one featured image for posts, pages and/or custom post types? Then this plugin is for you!

Enable multiple featured images for all post types (including custom post types and WooCommerce products) and show the images with a widget or the handy shortcode.

= Features =

* Add as many featured images as you need.

* Add the featured images to any post type (post, page or even custom post types and WooCommerce products).

* It is possible to use different featured images for different post types. Easily you can add two new featured images to pages and three to posts, if you need it that way.

* Fully customizable output - so it's multilingual.

* Handy shortcode for displaying the featured images everywhere.

* Widget for displaying featured images in sidebars, etc.

= History =

For one of my customers I had to assign two featured images to pages. One featured image was used as the header image and the other as a small button for the submenu. The images had to be different too (so I couldn't simply use different images sizes) and so I wrote this little plugin.

> **IMPORTANT NOTE TO THOSE UPDATING FROM 0.3:** The Plugin comes with a new method for registering featured images and updates the post meta key. It is fully backwards compatible, but if you are calling the post metas directly then please update your code accordingly. The new format of the post meta key is kdmfi_YOUR_ID.

= Contribute =

Feel free to ask if you have problems with this plugin. But please keep in mind, that this plugin is developed in the author's spare time - so it may take some time to answer.
Feature requests are welcome too!

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

For expample, this code adds two additional featured images to pages and one additional featured image to posts:

    add_filter( 'kdmfi_featured_images', function( $featured_images ) {
      // Add featured-image-2 to pages and posts
      $args_1 = array(
        'id' => 'featured-image-2',
        'desc' => 'Your description here.',
        'label_name' => 'Featured Image 2',
        'label_set' => 'Set featured image 2',
        'label_remove' => 'Remove featured image 2',
        'label_use' => 'Set featured image 2',
        'post_type' => array( 'page', 'post' ),
      );

      // Add featured-image-2 to pages only
      $args_2 = array(
        'id' => 'featured-image-3',
        'desc' => 'Your description here.',
        'label_name' => 'Featured Image 3',
        'label_set' => 'Set featured image 3',
        'label_remove' => 'Remove featured image 3',
        'label_use' => 'Set featured image 3',
        'post_type' => array( 'page' ),
      );

      // Add the featured images to the array, so that you are not overwriting images that maybe are created in other filter calls
      $featured_images[] = $args_1;
      $featured_images[] = $args_2;

      // Important! Return all featured images
      return $featured_images;
    });

= How do I register additional featured images for WooCommerce? =

The post type of WooCommerce products is "procut". So you are able to define multiple featured images as seen above, just add "product" to "post_type".

Let's say you want to add a detail image to WooCommerce products. Then this code is for you:

    add_filter( 'kdmfi_featured_images', function( $featured_images ) {
  		$args = array(
				'id' => 'product-image-detail',
				'desc' => 'The detail image of the product.',
				'label_name' => 'Product detail image',
				'label_set' => 'Set product detail image',
				'label_remove' => 'Remove product detail image',
				'label_use' => 'Set product detail image',
				'post_type' => array( 'product' ),
  		);

  		$featured_images[] = $args;

  		return $featured_images;
    });

Now you are able to display the image via shortcode, widget or by including a display function (seen below) in your WooCommerce theme files.

= How do I display the featured image? =

Use one of the functions for retrieving the image. E.g. kdmfi_the_featured_image( 'featured-image-2', 'full'); or use the new widget "Multiple featured images" or the new shortcode!
The widget can be found under Appearance -> Widgets.

= How do I use the shortcode? =

Shortcode usage:

[kdmfi_featured_image id="featured-image-2" size="full"]

Possible attributes for the shortcode:

* id: the id of the featured image, e.g. featured-image-2, **requried**
* size: the desired size, defaults to "full"
* post_id: the ID of the post to which the featured image is assigned, defaults to the current ID
* class: the classes for the image tag, defaults to "kdmfi-featured-image"
* alt: the alt attribute for the image tag, defaults to the title of the used image
* title: the title attribute for the image tag, empty by default

**Filter**

If you need to change the image tag created by the shortcode, please use the filter "kdmfi_shortcode_html".

Example use:

    add_filter( 'kdmfi_shortcode_html', function( $html, $shortcode_atts, $post_id) {

      // do something

      return $html;
    }, 10, 3);

The filter callback gets the image tag html, the used shortcode attributes and the ID of the post where the shortcode is used.

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

        kdmfi_the_featured_image( $image_id, $size, $post_id );

    Again, $size and $post_id are optional.

1. To check if the post has a featured image:

        kdmfi_has_featured_image( $image_id, $post_id );

    $post_id is optional. The function returns the id of the attachment if there's one and false if not.

== Screenshots ==
1. Admin meta box with multiple featured images.
2. Media uploader.
3. Multiple Featured Images Widget

== Changelog ==

= 0.5.0 =
* Added shortcode for displaying the image
* Changed the meta key from _kdmfi_ to kdmfi_ to enable API access again

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

= 0.5.0 =
Plugin comes now with a handy shortcode to display your additional featured images everywhere.

= 0.4.0 =
Code completely rewritten. Plugin is faster now and comes with a handy widget.
