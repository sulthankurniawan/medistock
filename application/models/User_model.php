<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "users";

    public $user_id;
    public $username;
    public $password;
    public $email;
    public $full_name;
    public $phone;
    public $role;
    public $last_login;
    public $image = "default.jpg";
    public $created_at;

    public function rules()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required'],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required'],
            
            ['field' => 'full_name',
            'label' => 'Full_name',
            'rules' => 'required'],

            ['field' => 'phone',
            'label' => 'Phone',
            'rules' => 'numeric'],

            ['field' => 'role',
            'label' => 'Role',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->user_id = uniqid();
        $this->username = $post["username"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->email = $post["email"];
        $this->full_name = $post["full_name"];
        $this->phone = $post["phone"];
        $this->role = $post["role"];
        $this->image = $this->_uploadImage();
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->user_id = $post["id"];
        $this->username = $post["username"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->email = $post["email"];
        $this->full_name = $post["full_name"];
        $this->phone = $post["phone"];
        $this->role = $post["role"];

        if (!empty($_FILES["image"]["name"])) {
            $this->image = $this->_uploadImage();
        } else {
            $this->image = $post["old_image"];
        }

        $this->db->update($this->_table, $this, array('user_id' => $post['id']));
    }

    public function delete($id)
    {
        $this->deleteImage($id);
        return $this->db->delete($this->_table, array("user_id" => $id));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './upload/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->user_id;
        $config['overwrite']			= true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }

    private function _deleteImage($id)
    {
        $user = $this->getById($id);
        if ($user->image != "default.jpg") {
            $filename = explode(".", $user->image)[0];
            return array_map('unlink', glob(FCPATH."upload/user/$filename.*"));
        }
    }


    public function doLogin(){
		$post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('email', $post["email"])
                ->or_where('username', $post["email"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // periksa role-nya
            $isAdmin = $user->role == "admin";
            $isCustomer = $user->role == "customer";

            // jika password benar dan dia admin
            if($isPasswordTrue && $isAdmin){ 
                // login sukses
                $this->session->set_userdata(['user_logged' => $user]);
                // $this->_updateLastLogin($user->user_id);
                return 'admin';
            }
            // jika password benar dan dia customer
            if($isPasswordTrue && $isCustomer){
                // login sukses
                $this->session->set_userdata(['user_logged' => $user]);
                // $this->_updateLastLogin($user->user_id);
                return 'customer';
            }
        }
        
        // login gagal
		return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

}