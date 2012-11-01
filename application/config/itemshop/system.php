<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Valūtu nosaukumi konkrētajās valstīs
 */
$config['currency'] = array(
    'lv' => 'LVL',
    'lt' => 'LTL',
    'ee' => 'EUR',
    // Temp fix.
    'eu' => 'EUR',
);


/**
 * @todo replace this array with API function
 */
$config['countries'] = array (
    'lv' => 'Latvia'
);


/**
 * API server address
 */
$config['api_url'] = 'http://sms.airtel.lv/';


/**
 * Maximal shopping cart size
 * Change of this value isn't recommended
 */
$config['cart_size'] = 10;


/**
 * Payment options array
 */
$config['payment_options'] = array(
    
    'sms' => array(
        
        'limits' => array(
            'min' => '15',
            'max' => '500',
        ),
        'currency' => 'LVL',
        'name' => 'SMS',
    ),
    
    'paypal' => array(
        
        'limits' => array(
            'min' => '1.00',
            'max' => '300.00',
        ),
        'currency' => 'EUR',
        'name' => 'Paypal',
    ),
    
    'ibank' => array(
        
        'limits' => array(
            'min' => '1.00',
            'max' => '300.00',
        ),
        'currency' => 'LVL',
        'name' => 'iBanka',
    ),
    
);


/**
 * Checkout fields
 */
$config['fields_checkout'] = array(
    
    'mc_username' => array(
        'label' => 'Atrodi sevi',
        'type' => 'dropdown',
        'fill' => 'mandatory',
        'php_validation' => 'xss_clean|callback__minecraft_check_online',
        'options' => 'class="chosen choose_player"',
        'value' => set_select('mc_username'),
    ),
);


/**
 * Fields for payment type: SMS
 */
$config['fields_sms'] = array(
    
    'countries' => array(
        'label' => 'Valsts',
        'type' => 'dropdown',
        'fill' => 'mandatory',
        'php_validation' => 'xss_clean|alpha',
        'options' => 'class="chosen"',
        'value' => set_value('countries'),
    ),

    'prices_sms' => array(
        'label' => 'Cena',
        'type' => 'text',
        'fill' => 'mandatory',
        'value' => '',
    ),
    
    'smscode' => array(
        'label' => 'Nopirktais SMS kods',
        'type' => 'input',
        'fill' => 'mandatory',
        'ajax_validation' => 'required digits code',
        'php_validation' => 'trim|required|exact_length[8]|numeric|xss_clean',
        'options' => array(
            'name' => 'smscode',
            'value' => '',
            'maxlength' => '8',
            'minlength' => '8',
        ),
    ),  
);


/**
 * Fields for payment type: iBank
 */
$config['fields_ibank'] = array(

    'prices_ibank' => array(
        'label' => 'Cena',
        'type' => 'text',
        'fill' => 'mandatory',
        'value' => '',
    ),
    
    'ibankcode' => array(
        'label' => 'Nopirktais iBank kods',
        'type' => 'input',
        'fill' => 'mandatory',
        'ajax_validation' => 'required digits code',
        'php_validation' => 'trim|required|xss_clean|numeric|exact_length[8]',
        'options' => array(
            'name' => 'ibankcode',
            'value' => '',
            'maxlength' => '8',
            'minlength' => '8',
        ),
    ),  
);


/**
 * Fields for payment type: Paypal
 */
$config['fields_paypal'] = array(
    
    'prices_paypal' => array(
        'label' => 'Cena',
        'type' => 'text',
        'fill' => 'mandatory',
        'value' => '',
    ),
    
    'paypalcode' => array(
        'label' => 'Nopirktais Paypal kods',
        'type' => 'input',
        'fill' => 'mandatory',
        'ajax_validation' => 'required digits code',
        'php_validation' => 'trim|required|xss_clean|numeric|exact_length[8]',
        'options' => array(
            'name' => 'paypalcode',
            'value' => '',
            'maxlength' => '8',
            'minlength' => '8',
        ),
    ),  
);