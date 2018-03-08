/**
 * PLUGIN APPLICATION
 */

var kdmfiApplication = function($) {
    
    var obj = {
        init: function() {

            $('.kdmfi-add-media').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var postid = $(this).data('postid');
                var title = $(this).data('title');
                var button = $(this).data('button');
                var nonce = $(this).data('nonce');

                // Create file frame.
                var file_frame = wp.media.frames.file_frame = wp.media({
                    title: title,
                    button: {
                        text: button
                    },
                    multiple: false  // Set to true to allow multiple files to be selected
                });

                // Hande file frame event
                file_frame.on( 'select', function() {
                    attachment = file_frame.state().get('selection').first().toJSON();

                    $.post( ajaxurl, {
                        action: 'kdmfi_set_featured_image',
                        photoid: attachment.id,
                        postid: postid,
                        kdmfi_id: id,
                        sec: nonce
                    }, function( response ) {
                       if( response ) {
                           var container = '.kdmfi-image-container-' + id + ' a';
                           $(container).html( response );

                           $('.hide-if-no-image-' +  id).show();
                       } 
                    });                    
                });            

                // Open file frame
                file_frame.open();
            });

            $('.kdmfi-media-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var postid = $(this).data('postid');
                var nonce = $(this).data('nonce');
                var label_set = $(this).data('label_set');

                $.post( ajaxurl, {
                    action: 'kdmfi_remove_featured_image',
                    postid: postid,
                    kdmfi_id: id,
                    label_set: label_set,
                    sec: nonce
                }, function( response ) {
                    var container = '.kdmfi-image-container-' + id + ' a';
                    $(container).html( response );

                   $('.hide-if-no-image-' +  id).hide();
                });
            });            

        },
        
        lateInit: function() {
        }
    };
    
    return obj;
};

/**
 * INIT PLUGIN APP
 */

var kdmfiApp = new kdmfiApplication(jQuery);

(function($) {
    
    $(document).ready(function() {
        kdmfiApp.init();
    });
    
    $(window)
        .load(function() {
            //kdmfiApp.lateInit();
        });
    
})(jQuery);