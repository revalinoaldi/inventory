<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends CI_Controller {

     
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status_login') != "login"){
            redirect(base_url('login'));
        };
        $this->load->model('M_barang');
    }
    

    public function lap_customer()
    {
        $data['title'] = "Laporan Customer";
        $data['content'] = "v_lap_customer";
        $data['get_customer'] = $this->M_barang->get_customer();
        $this->load->view('v_masterpage',$data);
    }

    public function lap_barang()
    {
        $data['title'] = "Laporan Master Barang";
        $data['content'] = "v_lap_barang";
        $data['get_barang'] = $this->M_barang->get_barang();
        $this->load->view('v_masterpage',$data);
    }

    public function lap_tr_barang_masuk()
    {
        $data['title'] = "Laporan Transaksi Barang Masuk";
        $data['content'] = "v_lap_tr_barang_masuk";
        $tgl_awal = null;
        $tgl_akhir = null;
        if(isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])){
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');
        }
        $data['get_tr'] = $this->M_barang->get_tr_barang($tgl_awal,$tgl_akhir);
        $this->load->view('v_masterpage',$data);
    }

    public function lap_tr_barang_keluar()
    {
        $data['title'] = "Laporan Transaksi Barang Keluar";
        $data['content'] = "v_lap_tr_barang_keluar";
        $tgl_awal = null;
        $tgl_akhir = null;
         if(isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])){
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');
        }
        $data['get_penjualan'] = $this->M_barang->get_tr_jual_barang($tgl_awal,$tgl_akhir);
        $this->load->view('v_masterpage',$data);
    }

    public function cetak_customer()
    {
        $url = base_url();
       
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHeader('Laporan Customer||');
        $mpdf->SetFooter('Halaman||{PAGENO}');

        $mpdf->defaultfooterfontsize=9;
        $mpdf->defaultfooterfontstyle='serif';
        $mpdf->defaultfooterline=2;

        $data['get_customer'] = $this->M_barang->get_customer();
		$html = $this->load->view('v_cetak_customer', $data, TRUE);
        $mpdf->WriteHTML($html);
        
		$mpdf->Output();
    }

    public function cetak_barang()
    {
        $url = base_url();
       
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHeader('Laporan Barang||');
        $mpdf->SetFooter('Halaman||{PAGENO}');

        $mpdf->defaultfooterfontsize=9;
        $mpdf->defaultfooterfontstyle='serif';
        $mpdf->defaultfooterline=2;

        $data['get_barang'] = $this->M_barang->get_barang();
		$html = $this->load->view('v_cetak_barang', $data, TRUE);
        $mpdf->WriteHTML($html);
        
		$mpdf->Output();
    }

    public function cetak_trmasuk()
    {
        $url = base_url();
       
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHeader('Laporan Transaksi Barang Masuk||');
        $mpdf->SetFooter('Halaman||{PAGENO}');

        $mpdf->defaultfooterfontsize=9;
        $mpdf->defaultfooterfontstyle='serif';
        $mpdf->defaultfooterline=2;
        $tgl_awal = null;
        $tgl_akhir = null;
        if(isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])){
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');
        }
        $data['get_tr'] = $this->M_barang->get_tr_barang($tgl_awal,$tgl_akhir);
		$html = $this->load->view('v_cetak_trmasuk', $data, TRUE);
        $mpdf->WriteHTML($html);
        
		$mpdf->Output();
    }

    public function cetak_trkeluar()
    {
        $url = base_url();
       
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHeader('Laporan Transaksi Barang Keluar||');
        $mpdf->SetFooter('Halaman||{PAGENO}');

        $mpdf->defaultfooterfontsize=9;
        $mpdf->defaultfooterfontstyle='serif';
        $mpdf->defaultfooterline=2;
        $tgl_awal = null;
        $tgl_akhir = null;
        if(isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])){
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');
        }
        $data['get_penjualan'] = $this->M_barang->get_tr_jual_barang($tgl_awal,$tgl_akhir);
		$html = $this->load->view('v_cetak_trkeluar', $data, TRUE);
        $mpdf->WriteHTML($html);
        
		$mpdf->Output();
    }

}

/* End of file C_laporan.php */
