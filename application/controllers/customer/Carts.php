<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller{
	
    public function __construct()
    {
		parent::__construct();
        $this->load->model("cart_model");
        $this->load->library("form_validation");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));

	}

	function index() // fungsi untuk menampilkan Cart
    { 
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td>'.$items['name'].'</td>
					<td>'.$items['category'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	function add_to_cart(){ // fungsi Add To Cart
		$data = array(
			'id' => $this->input->post('produk_id'), 
			'name' => $this->input->post('produk_nama'), 
			'price' => $this->input->post('produk_harga'), 
			'qty' => 1, 
		);
		$this->cart->insert($data);
		echo $this->show_cart(); // tampilkan cart setelah added
	}

    

    function load_cart() // load data cart
    { 
		echo $this->show_cart();
	}

    function hapus_cart() //fungsi untuk menghapus item cart
    { 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}
}