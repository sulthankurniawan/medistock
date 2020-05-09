<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Obtain_model extends CI_Model
{
    private $_table = "obtains";

    public $obtain_id;
    public $cart_id;
    public $product_id;
    public $quantity;

    public function getAll()
    {
        return $this->db->get($this->_table)->results();
    }
    
    public function getById($cart_id)
    {
        return $this->db->get_where($this->_table, ["cart_id" => $cart_id])->row();
    }

    public function getCart($cart_id, $user_id, $product_id)
    {
        $query3 = $db->query("SELECT * FROM carts WHERE user_id='".$user_id."'");
        $query4 = $db->query("SELECT * FROM obtains WHERE cart_id='".$cart_id."'");
        $query5 = $db->query("SELECT * FROM products WHERE product_id='".$product_id."'");

        $query = $db->query("SELECT * FROM products JOIN obtains ON obtain_id JOIN carts ON cart_id JOIN users ON user_id WHERE user_id='".$user_id."'");

        foreach ($query->getResult() as $row)
        {
            return $row->product_name;
            return $row->name;
            return $row->body;
        }
    }

    public function save()
    {
        $post = $this->input->post();
        $this->obtain_id = uniqid();
        $this->cart_id = $post["cart_id"];
        $this->product_id = $post["product_id"];
        $this->quantity = $post["quantity"];
        $this->db->insert($this->_table, $this);
    }
	
}