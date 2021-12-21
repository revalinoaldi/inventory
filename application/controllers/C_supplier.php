<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status_login') != "login"){
            redirect(base_url('login'));
        };
        $this->load->model('M_supplier');
	}

	public function index()
	{
		$data['title'] = "Supplier";
        $data['content'] = "v_supplier";
        $data['get_supplier'] = $this->M_supplier->get_supplier();
        $this->load->view('v_masterpage',$data);
	}

	 public function simpan()
    {
        $post = $this->input->post();
        $set_data = array(
          'kd_supplier' => $post['kd_supplier'],
          'nama_supplier' => $post['nama_supplier'],
          'alamat_supplier' => $post['alamat_supplier'],
          'no_hp' => $post['no_hp'],
          'email' => $post['email'],
          'pic_supplier' => $post['pic_supplier'],
        );

        $insert = $this->M_supplier->insert_supplier($set_data);

        if($insert){
            $data['status'] = "sukses";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }

    public function get_data($kd_supplier)
    {
        $get = $this->M_supplier->get_kd_supplier($kd_supplier);
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
            'nama_supplier' => $post['nama_supplier'],
            'alamat_supplier' => $post['alamat_supplier'],
            'no_hp' => $post['no_hp'],
            'email' => $post['email'],
            'pic_supplier' => $post['pic_supplier'],   
        );

        $update = $this->M_supplier->update_kd_supplier($set_data,$post['kd_supplier']);
        if($update){
            $data['status'] = "sukses-update";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }


    public function get_auto()
    {
        $get_auto_number = $this->M_supplier->get_auto_number();
        echo json_encode($get_auto_number);
    }

    public function hapus($kd_supplier)
    {
    	$hapus = $this->M_supplier->hapus_supplier($kd_supplier);
    	 if($hapus){
            redirect('supplier');
        }else{
            redirect('supplier');
        }
    }

}

/* End of file C_supplier.php */
/* Location: ./application/controllers/C_supplier.php */