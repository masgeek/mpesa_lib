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

    jQuery('#register-button').on('click', function (e) {
        registerC2BUrl();
    });

    function sendMpesaRequest() {

        const formData = jQuery('#mpesa-form').serialize();
        jQuery.ajax({
            type: 'POST',
            url: 'process-mpesa-c2b.php',
            dataType: "json",
            data: formData,
            success: function (data, textStatus, XMLHttpRequest) {
                processResponse(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(errorThrown);
            }
        });
    }

    function sendMpesaSTKRequest() {
        const formData = jQuery('#mpesa-form').serialize();

        jQuery.ajax({
            type: 'POST',
            url: 'process-mpesa.php',
            dataType: "json",
            data: formData,
            success: function (data, textStatus, XMLHttpRequest) {
                processResponse(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(errorThrown);
            }
        });
    }

    function registerC2BUrl() {
        const formData = jQuery('#mpesa-form').serialize();

        jQuery.ajax({
            type: 'POST',
            url: 'register-c2b-url.php',
            dataType: "json",
            data: formData,
            success: function (data, textStatus, XMLHttpRequest) {
                processResponse(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(errorThrown);
            }
        });
    }

    function processResponse(data) {
        const id = '#ajax-response';
        jQuery(id).html('');
        jQuery(id).append(data);
        console.log(data);
    }
});