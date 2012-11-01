<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Main extends CI_Controller {
    
    
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
        redirect('main/shop');
    }
    
    
    public function shop()
    {
        // Get category data
        $data['category'] = $this->core_model->get_category($this->module->active_category);
        
        // All category items
        if($this->module->active_category == '1')
        {
            $data['items_armor'] = $this->core_model->get_items($this->module->active_category, 'armor');
            $data['items_weapon'] = $this->core_model->get_items($this->module->active_category, 'weapon');
        }
        else 
        {
            $data['items'] = $this->core_model->get_items($this->module->active_category);
        }
        
        
        // Load output
        $data['content'] = 'main/main_tpl';
        $this->load->view('core/container_tpl', $data);
    }

    
    public function get_enchantments()
    {
        if( ! $this->input->is_ajax_request()) show_error('Direct access denied.', 500);        
        
        $data['item'] = $this->core_model->get_item($this->module->active_item, $this->module->active_category);
        $data['enchantments'] = $this->core_model->get_enchantments(json_decode($data['item']->enchantments));
        
        $this->load->view('core/output/enchantments_tpl', $data);
    }    
    
    
}