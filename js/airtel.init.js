$(document).ready(function() {
    
    // Le fire init
    airtel_init.transformSelect();
    airtel_init.tooltips();
    
    // Le cart
    airtel_cart.cartDestroy();
    airtel_cart.cartItemAdd();
    airtel_cart.cartItemAddEnhanced();
    airtel_cart.cartItemRemove();
    airtel_cart.cartCheckoutButton();
    airtel_cart.cartCheckoutSubmit();
    
    // Le modals
    airtel_modal.enchantmentsModal();
    
    // Le payments
    airtel_payments.ibank_anchor(); 
    airtel_payments.paypal_anchor(); 
    airtel_payments.paymentTabs();
    
});


/**
 * Init
 */
airtel_init = {
    
    transformSelect: function()
    {
        // Pasive chosens without any additional js functionality
        $('.chosen').chosen({
            disable_search_threshold: 25
        });
    },
    
    /**
     * Enables tooltips with title as selector tag
     */
    tooltips: function()
    {
        $('[title]').tooltip({placement: 'top'});
    }
    
};


/**
 * Miscellaneous functions
 */
airtel_misc = {
    
    /**
     * Gets closest obj key from given obj
     */
    getNextClosest: function(obj, value)
    {
        for(var i in obj) {
            //if (Number(i) > value) {
            if (Number(i) >= value) {
                return i;
            }    
        }
        return false;
    },
    
    calcPrice: function(item_price, level_price)
    {
        $('.enchantment-menu option:selected').each(function(){
        
            if($(this).val() > 0)
            {
                item_price += Number($(this).val() * level_price);
            }

        });

        return item_price;
    }    
    
};


/**
 * Payment functions
 */
airtel_payments = {
    
    ibank_anchor: function()
    {
        // Open window on click and set timer
        $("#airtel_ibank_system").click(function (e) {

            e.preventDefault();
            
            // Get changed values
            var key = $('#ibank_key').text();
            var href = 'http://ibank.airtel.lv/handler/index/' + key + '/LVL/';

            // Open window
            window.airtel_ibank_window = window.open(href, 'ibank_airtel', 'width=800, height=700, scrollbars=yes, status=yes, resizable=yes, screenx=200, screeny=100');

            // Open notification
            $('#payment-window-notification').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Set function to check window status
            airtel_payments.ibank_check_status();

            // Check interval
            setTimeout('airtel_payments.ibank_check_status()', 2000);
        
        });
    },
    
    ibank_check_status: function()
    {
        if (window.airtel_ibank_window.closed === false) {} else {
            $('#payment-window-notification').modal('hide');
        }
        setTimeout('airtel_payments.ibank_check_status()', 500);
    },
            
    paypal_anchor: function ()
    {
        $("#airtel_paypal_system").click(function (e) {
            
            // Prevent default action
            e.preventDefault();
            
            // Get changed values
            var key = $('#paypal_key').text();
            var href = 'http://paypal.airtel.lv/handler/index/' + key + '/EUR/';

            // Open window
            window.airtel_paypal_window = window.open(href, 'paypal_airtel', 'width=1000, height=768, scrollbars=yes, status=yes, resizable=yes, screenx=200, screeny=100');

            // Open notification
            $('#payment-window-notification').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Set function to check window status
            airtel_payments.paypal_check_status();

            // Check interval
            setTimeout('airtel_payments.paypal_check_status()', 2000);
            
            
        });
    },
            
    paypal_check_status: function()
    {
        if (window.airtel_paypal_window.closed === false) {} else {
            $('#payment-window-notification').modal('hide');
        }
        setTimeout('airtel_payments.paypal_check_status()', 500);
    },

    paymentTabs: function()
    {
        // Clearing inputs that could been filled by user into non-active tabs, so that on submit there
        // would be only one pay-method code filled.
        $('a[data-toggle="tab"]').on('shown', function (e) {

            // Prevent default action
            e.preventDefault();

            // Set value to non-active tab input to bypass validation
            $('.tab-pane:not(.active) .code').val('99999999');

            // Active tab input is cleared
            $('.tab-pane.active .code').val('');
        });    
    }
            
};


/**
 * Cart functions
 */
airtel_cart = {
    
    cartDestroy: function() {
        
        $('#cart-destroy').on('click', function (e) {

            e.preventDefault();
            
            $.get(site_url + 'cart/cart_destroy/', function() {
               
                // Clear cart table
                $('.cart-table tbody').children('tr').remove();
                
                // Update breadcrumb
                airtel_cart.updateBreadcrumb();
                
                // Show notification
                airtel_notifications.signal('Grozs ir iztukšots.');
                
            });
        });
    },
    
    updateBreadcrumb: function() {
        
        $.get(site_url + '/cart/cart_stats/', function(response) {

            $('#total').html(response.total);
            $('#total-items').html(response.total_items);
            $('#cart-total').html(response.total);
            
        }, 'json');
        
    },
    
    cartItemAdd: function() {
     
        $('.cart-add').on('click', function(e) {
            
            e.preventDefault();
            
            // Get item id
            var item_id = $(this).data('item-id');
            
            // Send POST data
            $.post(site_url + '/cart/cart_add/', { item_id: item_id }, function(response) {
                
                // Update breadcrumb
                airtel_cart.updateBreadcrumb();
                
                // Show notification
                airtel_notifications.signal(response);
                
            }, 'html');

        });
        
    },
    
    cartItemAddEnhanced: function() {
        
        $('#cart-add-enhanced').on('click', function(e) {

            e.preventDefault();
            
            // Build enchantments query
            var segments = '';
            $('select.enchantment-menu option:selected').each(function() {
                segments += '/' + $(this).val();
            });

            // Get item ID
            var item_id = $('#cart-add-enhanced').data('item-id');            
            
            // Send POST data
            $.post(site_url + '/cart/cart_add/enhanced' + segments, { item_id: item_id }, function(response) {
                
                // Update breadcrumb
                airtel_cart.updateBreadcrumb();
                
                // Show notification
                airtel_notifications.signal(response);
                
            }, 'html');
            
        });
    },
    
    cartItemRemove: function() {

        // Remove item
        $('.cart-table tbody tr').on('click', function (e) {
            
            e.preventDefault();
            
            var row_id = $(this).attr('id');
            
            smoke.confirm('Vai vēlies izmest mantu no groza ?', function(e) {
                
                // If ok is pressed, lets remove item from cart
                if(e) {
                    
                    $.get(site_url + '/cart/cart_remove/' + row_id, function() {

                        // Update breadcrumb
                        airtel_cart.updateBreadcrumb();

                        // Remove TR row
                        $('#' + row_id).remove();

                    });
                    
                }
                
            });

        });
    },
    
    cartCheckoutButton: function() {
        
        $('#cart-checkout').on('click', function(e) {
            
            e.preventDefault();
            
            $.get(site_url + '/cart/cart_stats/', function(response) {

                if(response.total_items > 0)
                {
                    window.location = site_url + '/cart/checkout';
                }
                else
                {
                    airtel_notifications.signal('Vajadzētu iemest grozā kādu mantu pirms veic apmaksu...');
                }
            }, 'json');            
        });
    },
    
    cartCheckoutSubmit: function() {
        
        //form-submit
        
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            
            $('#checkout-payment').trigger('submit');
        });
    }
    
};


airtel_modal = {
    
    enchantmentsModal: function() {

        // Destroy old modal data
        $('body').on('hidden', '#enchantments-modal', function () {
            $(this).removeData('modal');
        });

        // Modal open and load content
        $('.responsive').delegate('img', 'click', function(e) {

            e.preventDefault();

            // Get item-id from img
            var item_id = $(this).data('item-id');
            
            // Add item-id to button
            $('#cart-add-enhanced').data('item-id', item_id);
            
            // Load data into modal
            $('#enchantments-modal').modal({
                remote: base_url + 'main/get_enchantments/' + category_id + '/' + item_id
            });

        });        
    }
    
};


/**
 * Notifications
 */
airtel_notifications = {
    
    signal: function(text) {
        
        smoke.signal(text, 3000);
        
    }
    
    //bsAlert: function(type, message) {
    //    $("#alert-area").append($("<div class='alert-message " + type + " fade in' data-alert><p> " + message + " </p></div>"));
    //    $(".alert-message").delay(2000).fadeOut("slow", function () { $(this).remove(); });
    //}
    
};