jQuery(document).ready(function($) {
    $('#edit-field-social-images input[type=file]').attr('accept', 'image/*');
    $('#edit-field-video input[type=file]').attr('accept', 'video/*');
    $('#edit-field-file input[type=file]').attr('accept', 'doc,docx,pdf,txt,rar,zip,gz,gif,pptx,sql,xls,xlsx');

    $('.toggle-field').click(function() {
        let e_id = $(this).attr('data_id');
        $('#' + e_id + '>div').find('input[type=file]').click();
        $('#' + e_id + '>div').find('input[type=file]').change(function() {
            console.log(e_id);
            if ($('#' + e_id + '>div').find('input[type=file]').val() != 0) {
                $('#' + e_id + '>div').show();
                $('.toggle-field').hide();
                $('.toggle-close-file').show();
                $('.toggle-field[data_id=' + e_id + ']').show().css('width', '50%');
            }
        });
    });
    $('#edit-field-social-images input').change(function(e) {
        let imgFiles = $(this).prop('files');
        var output = '';
        for (let i = 0; i < imgFiles.length; i++) {
            let imgURL = window.URL.createObjectURL(e.target.files[i]);
            output += '<img src="' + imgURL + '">';
        }
        $('#edit-field-social-images fieldset .panel-body img').remove();
        $('#edit-field-social-images fieldset .panel-body').append(output);
    });
    $('#edit-field-video input').change(function(e) {
        var output = '';
        let videoURL = window.URL.createObjectURL(e.target.files[0]);
        output += '<video width="auto" height="240" controls><source src="' + videoURL + '" type="video/mp4"></video>';
        $('#edit-field-video .video-widget.form-managed-file video').remove();
        $('#edit-field-video .video-widget.form-managed-file').append(output);
    });

    //Close
    $('.toggle-close-file').click(function(){
        if($('.field-name-field-file .panel-body button[value=Remove]').length>0){
            $('.field-name-field-file .panel-body button[value=Remove]').mousedown();
        }
        
        $('.toggle-field').show().css('width','33.3333333%');
        $('.toggle-close-file').hide();
        $('#social-post-node-form .field-name-field-social-images>div,#social-post-node-form .field-name-field-video>div,#social-post-node-form .field-name-field-file>div').hide();
        $('#social-post-node-form .field-name-field-file>div').hide();
        $('#social-post-node-form input[type=file]').val('');
    });


});