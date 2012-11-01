<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed'); 


class Ui
{
    
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    
    /**
     * Performs actions with CI sessions and controlls system messages activities
     * @param type $unset
     * @return type
     */
    public function system_messages($unset = TRUE)
    {
        $message = $this->CI->session->userdata('message');
        
        if($message)
        {
            $msgarray = explode('{d}', $message);
            $message = $this->show_message($msgarray[1], $msgarray[0]);
            
            /**
             *  Unsetting message after we are done displaying it.
             *  This is needed because of flashdata will null only on page refresh,
             *  but we want to show it anywhere in any time without refreshing page
             */
            if($unset)
            {
                $this->CI->session->unset_userdata('message');
            }
            
            return $message;
        }
    }    
    
    
    /**
     * Outputs html with message in it
     * @param type $message
     * @param type $type
     * @return type
     */
    public function show_message($message, $type)
    {
        return '<div class="alert alert-'.$type.'""><a class="close" data-dismiss="alert">×</a><strong>'.ucfirst($type).':</strong> '.$message.'</div>';
    }
    
    
    /**
     * 
     * @return type
     */
    public function show_payment_block()
    {
        return $this->CI->load->view('core/output/payment_block_tpl', NULL, TRUE);
    }
    
    
    /**
     * 
     * @param type $price
     * @param type $default_prices
     * @return type
     */
    public function sms_sendto($price, $default_prices)
    {
        // Default first country from list
        $first_country = array_shift(array_keys($this->CI->config->item('countries')));
            
        $data['first_key'] = $price;
        
        // Get real SMS price
        $data['price'] = $default_prices[$data['first_key']];
        
        // Default currency from current countries list
        //$data['curr_currency'] = $this->CI->config->item($first_country, 'currency');
        $data['curr_currency'] = 'Ls';
        
        // Default QR code data string, encoded to use in url.
        $data['qrdata'] = urlencode('SMSTO:'.$this->CI->config->item('short_number').':'.$this->CI->config->item('base_keyword').$data['first_key']);
        
        // Get HTML output
        $output = $this->CI->load->view('core/output/sendto_tpl', $data, TRUE);
        
        return $output;
    }
    
    
    public function show_breadcrumb()
    {
        return $this->CI->load->view('core/output/breadcrumb_tpl', NULL, TRUE);
    }
    
}