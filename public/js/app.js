$(document).ready(function(){
    $("#form-contactInfo").validate({
        errorElement: "span", // contain the error msg in a span tag
        errorClass: 'help-block',
        errorPlacement: function (error, element) { // render error placement for each input type
            if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                error.insertAfter($(element).closest('.form-group').children('div').children().last());
            } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                error.insertAfter($(element).closest('.form-group').children('div'));
            } else {
                error.insertAfter(element);
                // for other inputs, just perform default behavior
            }
        },
        highlight: function (element) {
            $(element).closest('.help-block').removeClass('valid');
            // display OK icon
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error has-feedback').find('.symbol').removeClass('ok').addClass('required');
            $(element).closest('.form-group').find(".glyphicon-ok").remove();
            $(element).after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
            // add the Bootstrap error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error');
            // set error class to the control group
        },
        success: function (label, element) {
            label.addClass('help-block');
            // mark the current input as valid and display OK icon
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success has-feedback').find('.symbol').removeClass('required').addClass('ok');
            $(element).closest('.form-group').find(".glyphicon-remove").remove();
            $(element).after("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
        },
        rules:{
            "company" : {
                required : true
            },
            "phone" : {
                required : true,
                digits: true
            }
        }
    });
    var uploadObj = $("#mulitplefileuploader").uploadFile({
        url: BASE_URL+"/employers/ajaxUploadFile",
        dragDrop:true,
        fileName: "files",
        allowedTypes:"jpg,png,gif",
        returnType:"json",
        onSuccess:function(files,data,xhr)
        {
            if(data.status == 'SUCCESS'){
                var html = '<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 item-upload"><div>' +
                    '<a href="'+data.file_url+'" target="_blank"><img src="'+data.file_url+'" class="img-responsive"></a>' +
                    '</div>' +
                    '<div class="file-info">'+data.file_name+'</div>' +
                    '<div class="ajax-file-upload-red delete-file" data-id="'+data.id+'" data-name="'+data.file_name+'>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>' +
                    '</div>';
                $('.box-upload').append(html);
                $('.ajax-file-upload-statusbar').fadeOut().remove();
                $('.bottom-upload').css('margin-top', $('.upload-file-project').height() + 10);
            }else{
                $('#status').html(data.message );
            }
        },
        showDelete:false,
        deleteCallback: function(data,pd)
        {
            BootstrapDialog.confirm('Do you want to remove item?', function(result) {
                if (result == true) {
                    $.post(BASE_URL + "employers/ajaxDeleteFile", {
                            op: "delete",
                            id: data.id,
                            name: data.file_name
                        },
                        function (resp, textStatus, jqXHR) {
                            var res = $.parseJSON(resp);
                            if(res.redirect_url != undefined){
                                window.location.href = res.redirect_url;
                            }
                            //Show Message
                            //$("#status").append("<div>File Deleted</div>");
                        });
                    pd.statusbar.hide(); //You choice to hide/not.
                    $('.bottom-upload').css('margin-top', $('.upload-file-project').height() + 10);
                }
            });
        }
    });
    // delete file
    $('body').on('click', '.delete-file', function(){
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var $this = $(this);
        BootstrapDialog.confirm('Are you sure?', function(result) {
            if(result == true) {
                $.ajax({
                    type: "POST",
                    data: ({op: 'delete', id: id, name: name}),
                    url: BASE_URL + 'employers/ajaxDeleteFile/',
                    beforeSend: function () {
                        //$('.btn-send-message').attr('disabled', true);
                    },
                    success: function (data) {
                        var res = $.parseJSON(data);
                        if (res.status == 'SUCCESS') {
                            $this.parents('.item-upload').remove();
                            $('.bottom-upload').css('margin-top', $('.upload-file-project').height() + 10);
                        }
                    }
                });
            }
        });
    });
});
