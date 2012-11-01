<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed'); 


class Validation
{
    
    
    /**
     * Superclass pointer
     */
    private $CI;
    
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    
    /**
     * 
     * @param type $fields
     * @param type $pay_method
     * @return type
     */
    public function validation_parser($fields = array(), $pay_method = NULL)
    {
        $pay_fields = $this->CI->config->item('fields_'.$pay_method);
        
        /**
         * Service specific fields
         */
        if(count($fields) > 0)
        {
            foreach($fields as $field => $field_opts)
            {
                if($field_opts['type'] != 'text')
                {
                    $this->CI->form_validation->set_rules($field, '', $field_opts['php_validation']);
                }
            }
        }
        
        /**
         * Payment method mandatory fields from config
         */
        foreach($pay_fields as $field => $field_opts)
        {
            if($field_opts['type'] != 'text')
            {
                $this->CI->form_validation->set_rules($field, '', $field_opts['php_validation']);
            }
        }
        
        
        return ($this->CI->form_validation->run() == FALSE) ? FALSE : TRUE;
    }
    
    
    /**
     * Finds payment method
     * @return type
     */
    public function get_paymethod()
    {
        foreach($this->CI->module->pay_methods as $pay_method)
        {
            if($this->CI->input->post($pay_method.'code') && $this->CI->input->post($pay_method.'code') != '99999999')
            {
                return $pay_method;
            }
        }
    }
    
    
}