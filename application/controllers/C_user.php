<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status_login') != "login"){
            redirect(base_url('login'));
        };
        $this->load->model('M_user');
	}

	public function index()
	{
		$data['title'] = "User";
        $data['content'] = "v_user";
        $data['get_user'] = $this->M_user->get_user();
        $this->load->view('v_masterpage',$data);
	}

	 public function simpan()
    {
        $post = $this->input->post();
        $set_data = array(
          'username' => $post['username'],
          'password' => md5($post['password']),
          'level' => $post['level'],
          'nama' => $post['nama']
        );

        $insert = $this->M_user->insert_user($set_data);

        if($insert){
            $data['status'] = "sukses";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }

    public function get_data($id_login)
    {
        $get = $this->M_user->get_id_login($id_login);
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
            'nama' => $post['nama'],
            'level' => $post['level'],
        );

        $update = $this->M_user->update_user($set_data,$post['id_login']);
        if($update){
            $data['status'] = "sukses-update";
        }else{
            $data['status'] = "gagal";
        }
        echo json_encode($data);
    }

    public function hapus($id_login)
    {
    	$hapus = $this->M_user->hapus_user($id_login);
    	 if($hapus){
            redirect('user');
        }else{
            redirect('user');
        }
    }

}

/* End of file C_user.php */
/* Location: ./application/controllers/C_user.php */