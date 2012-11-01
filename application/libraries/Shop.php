<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed'); 


class Shop
{
    
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    
    /**
     * Function returns row_id on TRUE or FALSE if no item is found
     * @param type $item_id item id from database
     * @return boolean 
     */
    public function search_cart_item($item_id)
    {
        foreach($this->CI->cart->contents() as $key => $value)
        {
            if($value['id'] == $item_id)
            {
                $data['row_id'] = $key;
                $data['qty'] = $value['qty'];
                
                return $data;
            }
        }
        return FALSE;
    }
    
    
    /**
     * 
     * @param type $item
     * @param type $enchantments
     */
    public function load_enchantments($item, $enchantments)
    {
        foreach($this->CI->module->pay_methods as $pay_method)
        {
            $result['price_'.$pay_method] = ($pay_method == 'sms') ? $item->price_sms_lv : $item->{'price_'.$pay_method};
        }
        
        // Set first segment which holds ench. info in query
        $s = 4;
        
        if(count($enchantments) > 0)
        {
            foreach($enchantments as $e)
            {
                // Get user selected enchantment level
                $ench_level = $this->CI->uri->segment($s);
                
                // Set current enchantment price
                $ench_price = 0;
                $db_ench_price = 0;
                
                // If users selected enchant level meets our requirements
                if($ench_level > 0 && $ench_level <= $e->level_limit)
                {
                    foreach($this->CI->module->pay_methods as $pay_method)
                    {
                        // Select enchantment price from db
                        $db_ench_price = ($pay_method == 'sms') ? $e->levelprice_sms_lv : $e->{'levelprice_'.$pay_method};
                        
                        // Calculate enchantment end price
                        $ench_price = $db_ench_price * $ench_level;
                        
                        // Add price to item
                        $result['price_'.$pay_method] += $ench_price;
                    }
                    
                    $result[$e->cmd] = $ench_level;
                }
                
                // Incrase segment until last enchantment in loop is reached
                $s++;
            }
        }
        
        return $result;
    }
    
    
    /**
     * Finds closest sms price
     * @param type $smscode
     * @param type $prices
     * @return type
     */
    public function get_closest_smscode($smscode, $prices)
    {
        foreach($prices as $code => $price)
        {
            if($code >= $smscode) return $code;
        }
    }
    
    
    public function calc_end_price()
    {
        // Define array keys
        foreach($this->CI->module->pay_methods as $pay_method)
        {
            $endprice['price_'.$pay_method] = 0;
        }
        
        // Calculate end prices
        foreach ($this->CI->cart->contents() as $key => $item)
        {
            foreach($this->CI->module->pay_methods as $pay_method)
            {
                if(isset($item['prices']))
                {
                    //$endprice['price_'.$pay_method] += ($pay_method == 'sms') ? $this->get_closest_smscode($item['prices']['price_sms'], $this->CI->module->sms_prices) : $item['prices']['price_'.$pay_method];
                    $endprice['price_'.$pay_method] += ($item['prices']['price_'.$pay_method] * $item['qty']);
                }
            }
        }
        
        // Convert SMS price CODE, format other payment amounts
        foreach($this->CI->module->pay_methods as $pay_method)
        {
            if($pay_method == 'sms')
            {
                $endprice['price_sms'] = $this->get_closest_smscode($endprice['price_sms'], $this->CI->module->sms_prices);
            }
            else
            {
                $endprice['price_'.$pay_method] = number_format($endprice['price_'.$pay_method], 2, '.', '');
            }
        }
        
        // Output
        return $endprice;
    }
    
    
    public function give_cmd($username, $item)
    {
        $enhanced = (isset($item['enchantments']) && count($item['enchantments']) > 0) ? TRUE : FALSE;
        
        $command = 'give ' . $username . ' ' . $item['options']['item_id'] . ' ' . $item['options']['pieces'] * $item['qty']  . ' ';
        
        if($enhanced === TRUE)
        {
            // Add durability
            $command .= '0';
            
            // Add enchantments to command
            foreach($item['enchantments'] as $name => $value)
            {
                // Add enchantment to command
                $command .= ' ' . $name.':'.$value;
            }
            
        }
        
        return $command;
    }
    
    
    /**
     * Returns key of active payment method
     * @param type $end_price
     * @return int
     */
    public function get_active_paymethod($end_price)
    {
        $i = 1;
        foreach($this->CI->module->pay_methods as $pay_method)
        {
            if($end_price['price_'.$pay_method] >= $this->CI->module->pay_options[$pay_method]['limits']['min'] && $end_price['price_'.$pay_method] <= $this->CI->module->pay_options[$pay_method]['limits']['max'])
            {
                return $i;
            }
            
            $i++;
        }
        
    }
    
    
}