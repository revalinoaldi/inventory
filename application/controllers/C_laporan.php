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
        $result = $this->M_barang->get_tr_jual_barang($tgl_awal,$tgl_akhir);
        $resq;
        foreach ($result as $res) {
            $resCount = $this->M_barang->get_detail_b_keluar($res->id_tr_k)->row();
            $res->jumlah_beli = $resCount->jumlah_beli;
            $resq[] = $res;
        }

        $data['get_penjualan'] = $resq;
        $this->load->view('v_masterpage',$data);
    }

    public function eoq()
    {
        $data['title'] = "Laporan Transaksi Barang Keluar";
        $data['content'] = "v_lap_eoq";
        $tglBarang = [
            'tgl_tr_k >=' => date('Y-01-1', strtotime('-1 years')),
            'tgl_tr_k <=' => date('Y-12-t', strtotime('-1 years')),
        ];
        $tglBarangMasuk = [
            'tgl_masuk >=' => date('Y-01-1', strtotime('-1 years')),
            'tgl_masuk <=' => date('Y-12-t', strtotime('-1 years')),
        ];
         if(isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])){
            $tglBarang = [
                'tgl_tr_k >=' => date('Y-m-d', strtotime($this->input->get('tgl_awal'))),
                'tgl_tr_k <=' => date('Y-m-d', strtotime($this->input->get('tgl_akhir'))),
            ];

            $tglBarangMasuk = [
                'tgl_masuk >=' => date('Y-m-d', strtotime($this->input->get('tgl_awal'))),
                'tgl_masuk <=' => date('Y-m-d', strtotime($this->input->get('tgl_akhir'))),
            ];
        }

        $barang = $this->M_barang->get_barang();
        $resBarang;
        foreach ($barang as $res) {
            
            $res->total = $this->M_barang->get_sum_barang_kd1($res->kd_barang,$tglBarang);
            $res->totalMasuk = $this->M_barang->get_sum_barang_kd2($res->kd_barang,$tglBarangMasuk);
            $resBarang[] = $res;
        }

        $data['barang'] = $resBarang;
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
        $result = $this->M_barang->get_tr_jual_barang($tgl_awal,$tgl_akhir);
        $resq;
        foreach ($result as $res) {
            $resCount = $this->M_barang->get_detail_b_keluar($res->id_tr_k)->row();
            $res->jumlah_beli = $resCount->jumlah_beli;
            $resq[] = $res;
        }

        $data['get_penjualan'] = $resq;
		$html = $this->load->view('v_cetak_trkeluar', $data, TRUE);
        $mpdf->WriteHTML($html);
        
		$mpdf->Output();
    }

}

/* End of file C_laporan.php */
