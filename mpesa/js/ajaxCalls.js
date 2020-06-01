"use strict";

function sendMpesaRequest() {

    const formData = jQuery('#mpesa-form').serialize();
    const id = '#ajax-response';

    jQuery.ajax({
        type: 'POST',
        url: 'process-mpesa-c2b.php',
        dataType: "json",
        data: formData,
        success: function (data, textStatus, XMLHttpRequest) {
            jQuery(id).html('');
            jQuery(id).append(data.resp);
            console.log(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(errorThrown);
        }
    });
}