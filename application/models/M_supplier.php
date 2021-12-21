<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {

	public function get_supplier()
    {
        $this->db->select('*');
        $this->db->from('ms_supplier');
        $qr = $this->db->get();
        return $qr->result();
    }

     public function insert_supplier($set_data)
    {
        return $this->db->insert('ms_supplier',$set_data);
    }

    public function get_kd_supplier($kd_supplier)
    {
        $cek = $this->db->get_where('ms_supplier', array('kd_supplier' => $kd_supplier));
        if($cek){
            foreach ($cek->result() as $data) {
                $hasil=array(
                    'kd_supplier' => $data->kd_supplier,
                    'nama_supplier' => $data->nama_supplier,
                    'alamat_supplier' => $data->alamat_supplier,
                    'no_hp' => $data->no_hp,
                    'email' => $data->email,
                    'pic_supplier' => $data->pic_supplier,
                    );
            }
            return $hasil;
        }else{
            return false;
        }
    }

    public function update_kd_supplier($set_data,$kd_supplier)
    {
        return $this->db->update('ms_supplier',$set_data,array('kd_supplier' => $kd_supplier));
    }

    public function get_auto_number()
	{

        $this->db->select('RIGHT(kd_supplier,4) as kode', FALSE);
		  $this->db->order_by('kd_supplier','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('ms_supplier');      //cek dulu apakah ada sudah ada kode di tabel.    
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
		  $kodejadi = "SUP-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;  
       
    }

    public function count_supplier()
    {
        $this->db->select("count('id_supplier') AS id_supplier");
        $this->db->from('ms_supplier');
        $get = $this->db->get();
        return $get->result();
    }

    public function hapus_supplier($kd_supplier)
    {
    	$this->db->where('kd_supplier', $kd_supplier);
    	return $this->db->delete('ms_supplier');
    }

}

/* End of file M_supplier.php */
/* Location: ./application/models/M_supplier.php */