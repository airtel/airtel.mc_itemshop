<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Core_model extends CI_Model {
    
    
    /**
     * Get all category's items
     * @param type $category_id
     * @return type
     */
    public function get_items($category_id, $sub_type = NULL)
    {
        $q = $this->db->select('i.id, i.category, i.item_name, i.image_id, i.sub_type, i.sub_material, i.price_sms_lv, i.pieces')
                      ->from('items i')
                      ->where('i.category', $category_id)
                      ->where('i.active', '1')
                      ->where('i.sub_type', $sub_type)
                      ->join('categories c', 'c.id = i.category')
                      ->get();
        
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
    }
    
    
    /**
     * 
     * @param type $item_id
     * @return type
     */
    public function get_item($item_id)
    {
        $q = $this->db->where('id', $item_id)
                      ->where('active', '1')
                      ->get('items');
        
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
    }
    
    
    /**
     * 
     * @param type $list
     * @return type
     */
    public function get_enchantments($list = array())
    {
        $q = $this->db->where_in('enchantment_id', $list)
                      ->get('enchantments');
        
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
    }
    
    
    /**
     * 
     * @return type
     */
    public function get_categories()
    {
        $q = $this->db->where('active', '1')
                      ->get('categories');
        
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
    }

    
    /**
     * 
     * @param type $category_id
     * @return type
     */
    public function get_category($category_id)
    {
        $q = $this->db->where('id', $category_id)
                      ->where('active', '1')
                      ->get('categories');
        
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
    }
    
    
}