<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    private $_table = "carts";

    public $cart_id;
    public $user_id;
    public $total;
    public $created_at;
    public $status;

	function getAll(){
		$hasil=$this->db->get('tbl_produk');
		return $hasil->result();
	}
	
}