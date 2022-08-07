jQuery(document).ready(function($) {

    $('.search-button-toggle').click(function() {
        $('#block-search-form').show().append('<div class="btn-close-search-block"><i class="fa fa-times" aria-hidden="true"></i></div>');
        $('#search-block-form input[type=text]').focus();
        $('.btn-close-search-block').click(function() {
            $('#block-search-form').hide()
        });
    });
    

});