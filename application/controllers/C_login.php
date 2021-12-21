<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }
    
    
    public function index()
    {
        $data['title'] = "Halaman Login";
        $this->load->view('v_login',$data);
    }

    public function proses_login(){
        $p = $this->input->post();

        $config = array(
	        array(
	                'field' => 'username',
	                'label' => 'Username',
	                'rules' => 'required',
	                'errors' => array(
	                		'required'      => '%s Harus Di isi'
	                	),
			        ),
	        array(
	                'field' => 'password',
	                'label' => 'Password',
	                'rules' => 'required',
	                'errors' => array(
	                        'required' => '%s Harus Di isi',
	                ),
	        )
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
        	$this->index();
        }
        else
        {
        	$username = $this->input->post('username');
        	$password = $this->input->post('password');

        	$cek_login = $this->M_login->cek_login($username,md5($password));

        	if($cek_login){
        		foreach ($cek_login as $val) {
					$set_session = array(
						'id_login' => $val->id_login,
						'username' => $val->username,
                        'level' => $val->level,
                        'nama' => $val->nama,
                        'foto' => $val->foto,
						'status_login' => true
					);
				}
				$this->session->set_userdata($set_session);
				redirect('home');	
        	}else{
        		$this->session->set_flashdata('gagal-login', 'Maaf Username / Password Anda Salah');
        		$this->index();
        	}
        }
    }

    public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

}

/* End of file C_login.php */
