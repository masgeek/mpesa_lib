"use strict";
jQuery(document).ready(function () {
    jQuery(function ($) {
        $("#phone").mask("254999999999", {placeholder: " "});
        $("#amount").mask("9?999999999", {placeholder: " "});
        //$("#refNumber").mask("a9?9/9999999", {placeholder: " "});
    });

    jQuery('form').on('submit', function (e) {
        e.preventDefault();
    });

    jQuery('#c2b-button').on('click', function (e) {
        sendMpesaRequest();
    });

    jQuery('#stk-button').on('click', function (e) {
        sendMpesaSTKRequest();
    });

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

    function sendMpesaSTKRequest() {
        const formData = jQuery('#mpesa-form').serialize();
        const id = '#ajax-response';

        jQuery.ajax({
            type: 'POST',
            url: 'process-mpesa.php',
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
});