$(document).ready(function() {
    
    $('#checkout-payment').validate({

        onkeyup: false,
        errorClass: 'error',
        validClass: 'valid',

        highlight: function(element) {
            $(element).closest('div').addClass("f_error");
        },

        unhighlight: function(element) {
            $(element).closest('div').removeClass("f_error");
        },

        errorPlacement: function(error, element) {
            $(element).closest('div').append(error);
        }

    });

    $.validator.addMethod('choose_player', function(value, element){
        return value !== '';
    }, 'Lūdzu izvēlies lietotāju no saraksta');

    // Chosen select hack
    if(active_method === 'checkout')
    {
        var settings = $.data($('#checkout-payment')[0], 'validator').settings;
        settings.ignore += ':not(.chzn-done)';    
    }

});