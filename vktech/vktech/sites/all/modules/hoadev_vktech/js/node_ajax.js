(function($) {
    Drupal.behaviors.hoadev_vktech = {
        attach(context, settings) {
            // Code goes here.
            function prepend_node_view(node_html) {
                $(this).prepend(note_html);

            }


        },
    };
}(jQuery));