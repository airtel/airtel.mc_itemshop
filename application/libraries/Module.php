<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed'); 


class Module
{
    
    /**
     * Variables
     */
    private $CI;
    
    public $active_module = NULL;
    
    public $active_method = NULL;
    
    public $active_category = NULL;
    
    public $active_item = NULL;
    
    public $pay_methods = array();
    
    public $pay_options = array();
    
    public $testing = FALSE;
    
    public $categories = array();
    
    public $server_settings = array();
    
    public $sms_prices = array();
    
    
    public function __construct()
    {
        $this->CI =& get_instance();
        
        // Geting active module from router
        $this->active_module = $this->CI->uri->segment(1);
        
        // Active method name
        $this->active_method = $this->CI->uri->segment(2);
        
        // Active category id
        $this->active_category = $this->CI->uri->segment(3);
        
        // Active item id
        $this->active_item = ($this->CI->uri->segment(4) != 'error') ? $this->CI->uri->segment(4) : NULL;
        
        // Loading configs
        $this->CI->load->config('itemshop/master');
        $this->CI->load->config('itemshop/system');

        // Load payment libraries
        $this->CI->load->library('payments/smscode');
        $this->CI->load->library('payments/paypalcode');
        $this->CI->load->library('payments/ibankcode');
        
        
        // Set minecraft server connection settings
        $this->server_settings = $this->CI->config->item('minecraft_server_settings');
        
        // Get active pay methods
        $this->pay_methods = $this->CI->config->item('minecraft_payments');
        
        $this->pay_options = $this->CI->config->item('payment_options');
        
        // Load code testing param
        $this->testing = $this->CI->config->item('testing');
        
        // SMS prices
        $this->sms_prices = $this->CI->smscode->get_prices('lv');
        
        $this->init();
    }
    
    
    public function init()
    {
        // Set active categories
        $this->categories = $this->CI->core_model->get_categories();        
        
        // Check uri inputs
        $this->security_layer();
        
        // Setting active segments
        if(empty($this->active_category) && $this->CI->uri->rsegment(2) == 'shop')
        {
            $this->active_category = $this->categories[0]->id;
            
            redirect($this->active_module.'/shop/'.$this->active_category);
        }
        
        /*if($this->CI->uri->rsegment(2) == 'checkout')
        {
            if( empty($this->active_category) OR empty($this->active_item))
            {
                // Set error message
                $this->CI->session->set_userdata('message', 'error{d}Piekļuve sadaļai bez norādītās kategorijas un aktivās mantas nav iespējama');
                
                // Redirect
                redirect('main/shop/'.$this->categories[0]->id.'/error');
            }
        }*/
    }
    
    
    private function security_layer()
    {
        if($this->CI->uri->segment(1) != 'main')
        {
            return NULL;
        }
        
        if( ! empty($this->active_category) && isset($this->active_category))
        {
            if( ! ctype_digit($this->active_category))
            {
                // Set error message
                $this->CI->session->set_userdata('message', 'error{d}Piekļuve pie neeksistējošas kategorijas nav iespējama.');

                // Redirect
                redirect('main/shop/'.$this->categories[0]->id.'/error');
            }
            
            if( ! $this->category_exists($this->active_category, $this->categories))
            {
                // Set error message
                $this->CI->session->set_userdata('message', 'error{d}Piekļuve pie neeksistējošas vai atslēgtas kategorijas nav iespējama.');

                // Redirect
                redirect('main/shop/'.$this->categories[0]->id.'/error');
            }
        }

        if( ! empty($this->active_item) && isset($this->active_item))
        {
            $message = 'error{d}Piekļuve pie neeksistējošas mantas nav iespējama.';
            
            if( ! ctype_digit($this->active_item))
            {
                // Set error message
                $this->CI->session->set_userdata('message', $message);
                
                // Redirect
                redirect('main/shop/'.$this->categories[0]->id.'/error');
            }
            else
            {
                if( ! $this->CI->core_model->get_item($this->active_item, $this->active_category))
                {
                    // Set error message
                    $this->CI->session->set_userdata('message', $message);

                    // Redirect
                    redirect('main/shop/'.$this->categories[0]->id.'/error');
                }
            }
        }
    }
    
    
    /**
     * Searches in categories for valid active category
     * @param type $category_id
     * @param type $categories
     * @return boolean
     */
    private function category_exists($category_id, $categories)
    {
        
        foreach ($categories as $key)
        {
            if($key->id == $category_id)
            {
                return TRUE;
            }
        }

        return FALSE;
    }
    
    
}