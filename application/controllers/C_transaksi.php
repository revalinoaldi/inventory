<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_transaksi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status_login') != "login"){
            redirect(base_url('login'));
        };
        $this->load->model('M_transaksi');
    }
    
    private function _index()
    {
        
    }

}

/* End of file C_transaksi.php */
