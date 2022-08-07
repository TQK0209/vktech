(function($) {
    Drupal.behaviors.csdev_vktech = {
        attach(context, settings) {
            $('#form-create-social-post').submit(function(e){
                e.preventDefault();
                var data = $('#form-create-social-post').val();
                $.ajax({
                    url:'/api/social-create-post',
                    type:'post',
                    data:{content:data},
                    success:function(response){
                        console.log(response);
                    }
                })
                return false;
            });

            $( document ).ajaxComplete(function( event, xhr, settings) {
                //console.log(xhr);
                //var output = xhr.responseJSON[1].data;
                /* console.log(output);
                $('.view-id-social').remove();
                $('#block-system-main').append(output); */
                
            });


        },
    };
}(jQuery));