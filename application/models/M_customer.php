<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_customer extends CI_Model {

    public function get_customer()
    {
        $this->db->select('*');
        $this->db->from('ms_customer');
        $qr = $this->db->get();
        return $qr->result();
    }

    public function insert_customer($set_data)
    {
        return $this->db->insert('ms_customer',$set_data);
    }

    public function get_kd_customer($kode_customer)
    {
        $cek = $this->db->get_where('ms_customer', array('kode_customer' => $kode_customer));
        if($cek){
            foreach ($cek->result() as $data) {
                $hasil=array(
                    'kode_customer' => $data->kode_customer,
                    'nama_customer' => $data->nama_customer,
                    'alamat_customer' => $data->alamat_customer,
                    'no_hp' => $data->no_hp,
                    'email' => $data->email,
                    );
            }
            return $hasil;
        }else{
            return false;
        }
    }

    public function update_kode_customer($set_data,$kode_customer)
    {
        return $this->db->update('ms_customer',$set_data,array('kode_customer' => $kode_customer));
    }

    public function get_auto_number()
	{

        $this->db->select('RIGHT(kode_customer,4) as kode', FALSE);
		  $this->db->order_by('kode_customer','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('ms_customer');      //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
		   $data = $query->row();      
		   $kode = intval($data->kode) + 1;    
		  }
		  else {      
		   //jika kode belum ada      
		   $kode = 1;    
		  }

		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "CUST-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;  
       
    }

    public function count_customer()
    {
        $this->db->select("count('id_customer') AS id_customer");
        $this->db->from('ms_customer');
        $get = $this->db->get();
        return $get->result();
    }

}

/* End of file M_customer.php */
