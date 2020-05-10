<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("cart_model");
        $this->load->library("form_validation");
        $this->load->model("obtain_model");
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["carts"] = $this->cart_model->getAll();
        $data["obtains"] = $this->obtain_model->getAll();
        $this->load->view("customer/transaction", $data);
        // $this->load->view("customer/transaction");
    }
}
