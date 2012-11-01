<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cart extends CI_Controller {
    
    
    /**
     * Constructor
     */
    public function __construct()        
    {
        parent::__construct();
        
        $this->load->model('core_model');
        
        $this->load->library('cart');
        $this->load->library('module');
        $this->load->library('ui');
        $this->load->library('error_handler');
        $this->load->library('validation');
        $this->load->library('shop');
        
        // Init
        $this->init();
    }
    
    
    private function init()
    {
        // Load minecraft rcon and minecraft query class
        $this->load->library('rcon_minecraft', $this->module->server_settings);
        $this->load->library('query_minecraft', $this->module->server_settings);
    }
    
    
    public function index()
    {
        redirect('cart/view_contents');
    }
    
    
    public function view_contents()
    {
        // Load output
        $data['content'] = 'cart/view_contents_tpl';
        $this->load->view('core/container_tpl', $data);
    }
    
    
    public function checkout()
    {
        // Get fields from config
        $data['fields'] = $this->config->item('fields_checkout');
        
        // Query server and get player list
        $players = $this->query_minecraft->get_players();

        // Insert players into select menu
        $data['fields']['mc_username']['data'][''] = 'Izvēlies savu lietotāju';
        
        if(count($players) > 0 && $players !== FALSE)
        {
            foreach($players as $player)
            {
                $data['fields']['mc_username']['data'][$player] = $player;
            }
        }
        
        
        if($this->input->post('submit_form'))
        {
            $pay_method = $this->validation->get_paymethod();
            $pay_code = $this->input->post($pay_method.'code');
            
            
            /**
             * Starting validation check
             */
            if($this->validation->validation_parser($data['fields'], $pay_method) == FALSE)
            {
                $this->session->set_userdata('message', 'error{d}Lūdzu pārbaudiet visus ievadītos datus!');
            }
            else 
            {
                // Get answer about code from airtel api
                $response = $this->{$pay_method.'code'}->code_response_wsearch($pay_code, TRUE);
                $end_price = $this->shop->calc_end_price();
                
                
                if($response['price'] >= $end_price['price_'.$pay_method])
                {
                    
                    foreach ($this->cart->contents() as $key => $item)
                    {
                        // Build command
                        $cmd = $this->shop->give_cmd($this->input->post('mc_username'), $item);
                        
                        // Execute command
                        $this->rcon_minecraft->communicate($cmd);
                    }
                    
                    // Destroy cart
                    $this->cart->destroy();
                    
                    // Set message
                    $this->session->set_userdata('message', 'info{d}Esi veiksmīgi apmaksājis sava groza saturu');
                    
                    // Activate {pay_method} code
                    $this->{$pay_method.'code'}->code_response_wsearch($pay_code, $this->module->testing);
                    
                    // Do redirect
                    redirect('main/shop/');
                }
                elseif($response['answer'] == 'code_not_found')
                {
                    $this->session->set_userdata('message', 'error{d}Ir ievadīts neeksistējošs "'.$pay_method.'" kods!');
                }
                else
                {
                    $this->session->set_userdata('message', 'error{d}Ir ievadīts nepareizas vērtības "'.$pay_method.'" kods!');
                }  
            }
        }
        
        
        // Load output
        $data['content'] = 'cart/checkout_tpl';
        $this->load->view('core/container_tpl', $data);
    }

    
    /**
     * Ajax callback function
     * Destroys cart contents
     */
    public function cart_destroy()
    {
        if( ! $this->input->is_ajax_request()) show_error('Direct access denied.', 500);
        
        // Do destroy
        $this->cart->destroy();
    }
    
    
    /**
     * Ajax callback function
     * Adds new item to cart
     */
    public function cart_add()
    {
        if( ! $this->input->is_ajax_request()) show_error('Direct access denied.', 500);
        
        // Get selected item data
        if( ! $item = $this->core_model->get_item($this->input->post('item_id')))
        {
            // Item does not exist
            echo 'Esat izvēlējies neeksistējošu mantu. Lūdzu pārbaudiet.';
        }
        else
        {
            if($this->cart->total_items() >= $this->config->item('cart_size'))
            {
                // Output message
                echo 'Groza maksimālais limits ir sasniegts.';
            }
            else
            {
                // Search for item, if not found add it
                if( ! $row_id = $this->shop->search_cart_item($item->id))
                {
                    $data = array(
                        'id' => $item->id,
                        'qty' => '1',
                        'price' => $item->price_sms_lv,
                        'name' => str_replace(array('(', ')'), '', $item->item_name),
                        'options' => array(
                            'pieces' => $item->pieces,
                            'item_id' => $item->item_id,
                            'image_id' => $item->image_id,
                        ),
                    );
                    
                    // Add extra data for enhanced items
                    if($this->uri->segment(3) == 'enhanced')
                    {
                        // Get item's enchantments
                        $enchantments = $this->core_model->get_enchantments(json_decode($item->enchantments));

                        // Load enchantments
                        $data['enchantments'] = $this->shop->load_enchantments($item, $enchantments);
                        
                        // Reload array
                        foreach($this->module->pay_methods as $pay_method)
                        {
                            $data['prices']['price_'.$pay_method] = $data['enchantments']['price_'.$pay_method];
                            
                            if($pay_method == 'sms')
                                $data['price'] = $data['enchantments']['price_sms'];
                            
                            // Unset
                            unset($data['enchantments']['price_'.$pay_method]);
                        }
                    }
                    else
                    {
                        foreach($this->module->pay_methods as $pay_method)
                        {
                            $data['prices']['price_'.$pay_method] = ($pay_method == 'sms') ? $item->price_sms_lv : $item->{'price_'.$pay_method};
                        }
                    }
                    
                    

                    // Insert into cart
                    $this->cart->insert($data);
                    
                    // Output message
                    echo 'Paldies. Manta pievienota Jūsu grozam.';
                }
                
                // Item is found, do qty update
                else
                {
                    if($this->uri->segment(3) != 'enhanced')
                    {
                        $data = array(
                            'rowid' => $row_id['row_id'],
                            'qty' => $row_id['qty'] + 1,
                        );
                        
                        // Update cart contents
                        $this->cart->update($data);
                        
                        // Output message
                        echo 'Mantas daudzums grozā palielināts par ' . $item->pieces . '.';
                    }
                    else
                    {
                        // Output message
                        echo 'Vienlaicīgi var pievienot tikai vienu šādu uzlabotu mantu.';
                    }
                }
            }
        }
    }
    
    
    /**
     * Ajax callback function
     * Removes item from cart
     */
    public function cart_remove()
    {
        if( ! $this->input->is_ajax_request()) show_error('Direct access denied.', 500);
        
        // Set array values
        $data = array(
            'rowid' => $this->uri->segment(3),
            'qty' => 0,
        );

        // Update cart contents
        $this->cart->update($data);
    }
    
    
    /**
     * Ajax callback function
     * Outputs json array with shopping cart stats
     */
    public function cart_stats()
    {
        if( ! $this->input->is_ajax_request()) show_error('Direct access denied.', 500);
        
        $data = array(
            'total' => number_format($this->cart->total() / 100, 2, '.', ''),
            'total_items' => $this->cart->total_items(),
        );
        
        // Output message
        echo json_encode($data);
    }
    
    
    /**
     * PHP Callback function
     * @param type $username
     * @return boolean
     */
    public function _minecraft_check_online($username)
    {
        // Query server and get player list
        $players = $this->query_minecraft->get_players();
        
        // Find player in list
        if( ! empty($players) && count($players) > 0)
        {
            foreach($players as $player)
            {
                 if(stristr($player, $username) !== FALSE)
                 {
                     return TRUE;
                 }
            }
        }
        
        $this->form_validation->set_message('_minecraft_check_online', 'Lietotājs neatrodas iekš spēles / ir izgājis.');
        return FALSE;
    }
    
    
}