<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_customer extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status_login') != "login"){
            redirect(base_url('login'));
        };
        $this->load->model('M_customer');
        $this->load->model('M_login');
    }
    

    public function index()
    {
        $data['title'] = "Customer";
        $data['content'] = "v_customer";
        $data['get_customer'] = $this->M_customer->get_customer();
        $this->load->view('v_masterpage',$data);
    }

    public function simpan()
    {
        $post = $this->input->post();
        $set_data = array(
          'kode_customer' => $post['kode_customer'],
          'nama_customer' => $post['nama_customer'],
          'alamat_customer' => $post['alamat_customer'],
          'no_hp' => $post['no_hp'],
          'email' => $post['email']  
        );

        $insert = $this->M_customer->insert_customer($set_data);

        if($insert){
            $data['status'] = "sukses";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }

    public function get_data($kd_customer)
    {
        $get = $this->M_customer->get_kd_customer($kd_customer);
        if($get){
            echo json_encode($get);
        }else{
            $data['data'] = "Gagal";
            echo json_encode($data);
        } 
    }

    public function update()
    {
        $post = $this->input->post();
        $pass = "";
        $id_login = $post['id_login'];
        $foto_lama = $post['foto_lama'];
        if(!empty($post['password'])){
            $pass = md5($post['password']);
        }else{
            $pass = $post['password_lama'];
        }
        $set_data = array(
            'password' => $pass,
            'nama' => $post['nama'],
            'foto' => $this->_pr_upload_gambar($foto_lama)
        );

        $update = $this->M_login->update_user($set_data,$id_login);
        if($update){
            $data['status'] = "sukses-update";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }

    public function _pr_upload_gambar($foto_lama)
    {
        if(!empty($_FILES['foto']['name'])){
            $nmfile = md5($_FILES['foto']['name']);
            $config['upload_path']          = './upload';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG|JPEG';
            $config['file_name']            = md5($nmfile);
            $config['overwrite']            = true;
            $config['max_size']             = 2024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                return $this->upload->data("file_name");
            }
            
            return "default.png";
        }else{
            return $foto_lama;
        }
        
    }

    public function rubah()
    {
        $post = $this->input->post();
        $set_data = array(
            'nama_customer' => $post['nama_customer'],
            'alamat_customer' => $post['alamat_customer'],
            'no_hp' => $post['no_hp'],
            'email' => $post['email']   
        );

        $update = $this->M_customer->update_kode_customer($set_data,$post['kode_customer']);
        if($update){
            $data['status'] = "sukses-update";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }


    public function get_auto()
    {
        $get_auto_number = $this->M_customer->get_auto_number();
        echo json_encode($get_auto_number);
    }

     public function profil()
    {
        $id_login =  $this->session->userdata('id_login');
        $data['title'] = "Profil";
        $data['content'] = "v_profil";
        $data['get_user'] = $this->M_login->get_user($id_login);
        $this->load->view('v_masterpage',$data);
    }

}

/* End of file C_customer.php */
