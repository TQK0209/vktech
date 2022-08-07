jQuery(document).ready(function($) {


    $('.more-profile').hover(function() {
        
        $('.log-out-social').css('display', 'block');
    });
    $(document).click(function() {
        $('.log-out-social').css('display', 'none');
    });

    /*  $('#block-formblock-social-post .field-name-field-social-images .panel-heading').dblclick(function() {
        $('#block-formblock-social-post .field-name-field-social-images .panel-body').hide();
    });
    $('#block-formblock-social-post .field-name-field-social-images .panel-heading').click(function() {
        $('#block-formblock-social-post .field-name-field-social-images .panel-body').show();
    });  */

//     $(document).ready(function ()
// {
//     $(".region-sidebar-second img").fancybox();
// });
$(".page-user .page-header").text("Trang cá nhân");


});