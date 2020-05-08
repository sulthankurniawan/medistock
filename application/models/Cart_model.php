<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    private $_table = "carts";
    private $_table2 = "obtains";

    public $obtain_id;
    public $cart_id;
    public $user_id;
    public $total;
    public $created_at;
    public $status;

    public function getAll()
    {
        return $this->db->get($this->_table)->results();
    }
    
    public function getById($cart_id)
    {
        return $this->db->get_where($this->_table, ["cart_id" => $product_id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->cart_id = uniqid();
        $this->name = $post["name"];
        $this->category = $post["category"];
        $this->price = $post["price"];
        $this->description = $post["description"];
        $this->db->insert($this->_table, $this);
    }
	
}