<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    
	public function cek_login($username,$password)
	{
		$qr = $this->db->get_where('tb_login',array('username' => $username,'password' => $password));
		if($qr->num_rows() > 0){
			return $qr->result();
		}else{
			return false;
		}
	}

	public function get_user($id_login)
	{
		$qr = $this->db->get_where('tb_login',array('id_login' => $id_login));
		if($qr->num_rows() > 0){
			return $qr->result();
		}else{
			return false;
		}
	}

	public function update_user($set_data,$id_login)
	{
		return $this->db->update('tb_login',$set_data,array('id_login' => $id_login));
	}

}

/* End of file M_login.php */
