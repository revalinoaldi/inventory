<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function get_auto_number()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(no_booking,4)) AS kd_max FROM tb_booking_header WHERE DATE(tgl_booking)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy').$kd;
	}

}

/* End of file M_transaksi.php */
