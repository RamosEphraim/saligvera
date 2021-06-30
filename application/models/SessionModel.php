<?php

class SessionModel extends CI_Model{

	public function userDetails($sessionID){
		$this->db->select('*');
		$this->db->from('account_tbl');
		$this->db->where('account_id', $sessionID);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return "";
		}
	}

}