<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

    
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status_login') != "login"){
            redirect(base_url('login'));
        };

        $this->load->model('M_barang');
        $this->load->model('M_customer');
        
    }
    

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['content'] = "v_home";
        $data['count_customer'] = $this->M_customer->count_customer();
        $data['count_barang'] = $this->M_barang->count_barang();
        $data['count_barang_masuk'] = $this->M_barang->count_barang_masuk();
        $data['count_barang_keluar'] = $this->M_barang->count_barang_keluar();
        $where = array(
            'stok_awal <=' => 10
        );
        $data['get_barang'] = $this->M_barang->get_barang($where);
        $this->load->view('v_masterpage',$data);        
    }
    

}

/* End of file C_dashboard.php */
