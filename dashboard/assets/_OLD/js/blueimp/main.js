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
        maxFileSize: 100000000 //100MB,
    });

    // Enable iframe cross-domain access via redirect option:
    $('#upload_archive').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    ).bind('fileuploaddone', function (e, data) {
        $(".progress .bar").css("width", "0%");
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
