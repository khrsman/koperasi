/*
 * jQuery File Upload Plugin JS Example 8.0.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, regexp: true */
/*global $, window, navigator */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#upload_archive').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: site+'archive/upload/submit',
        maxFileSize: 1000000 //1MB,
    });

    // Enable iframe cross-domain access via redirect option:
    $('#upload_archive').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    )
    .bind('fileuploadadd', function(e, data){
        $(".cancel_upload_archive").show();
        $("#publish_material_status").addClass("disabled").attr('disabled', true);
        data.submit();
    })
    .bind('fileuploaddone', function (e, data) {
        $(".progress .bar").css("width", "0%");
        if(!$.isEmptyObject(data.result.error)){
            notify_error(data.result.error);
        } else {
            $(".loaded_archives").append(tmpl("template-loaded-archive", data.result.files)).slideDown(200);
            var nth = data.result.files.length - 1;
            $(".loaded_archives .archive_item:nth-child(n+"+nth+")").find("a.remove")
            .bind('click', function(s){
                if($(".loaded_archives > .archive_item").length < 2){
                    $(this).parent().parent().parent().hide();
                }
                $(this).parent().parent().remove();
                s.preventDefault();
            });
        }
        $("#publish_material_status").removeClass("disabled").attr('disabled', false);
        $(".cancel_upload_archive").hide();
    });

    // Load existing files:
    $('#upload_archive').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#upload_archive').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#upload_archive')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, null, {result: result});
    });

});
