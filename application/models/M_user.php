<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function get_user()
    {
        $this->db->select('*');
        $this->db->from('tb_login');
        $qr = $this->db->get();
        return $qr->result();
    }

    public function insert_user($set_data)
    {
    	$cek = $this->db->get_where('tb_login', array('username' => $set_data['username']));
    	if($cek->num_rows() > 0){
    		return false;
    	}else{
    		return $this->db->insert('tb_login',$set_data);	
    	}
    }

    public function get_id_login($id_login)
    {
        $cek = $this->db->get_where('tb_login', array('id_login' => $id_login));
        if($cek){
            foreach ($cek->result() as $data) {
                $hasil=array(
                    'id_login' => $data->id_login,
                    'username' => $data->username,
                    'level' => $data->level,
                    'nama' => $data->nama,
                    );
            }
            return $hasil;
        }else{
            return false;
        }
    }

    public function update_user($set_data,$id_login)
    {
        return $this->db->update('tb_login',$set_data,array('id_login' => $id_login));
    }

    public function hapus_user($id_login)
    {
    	$this->db->where('id_login', $id_login);
    	return $this->db->delete('tb_login');
    }	

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */