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
    $('#preview_upload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: site+'profile/upload_img',
        maxFileSize: 1000000 //1MB,
    });

    // Enable iframe cross-domain access via redirect option:
    $('#preview_upload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    )
    .bind('fileuploadadd', function(e, data){
        data.submit();
    })
    .bind('fileuploaddone', function (e, data) {
        $(".progress .bar").css("width", "0%");
        if(!$.isEmptyObject(data.result.error)){
            notify(data.result.error);
        } else {
            $(".r200").attr("src", data.result.res200);
            $(".r50").attr("src", data.result.res50);
            $(".r36").attr("src", data.result.res36);
            $(".cv_profile_detail").slideDown(300).siblings(".cv_upload_photo").slideUp(300);
            $(".bar").css('width', "0%");
        }
    });

    // Load existing files:
    $('#preview_upload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#preview_upload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#preview_upload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, null, {result: result});
    });

});
