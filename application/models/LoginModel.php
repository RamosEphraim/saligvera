<?php 

class LoginModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function loginUser($username){
		$query = $this->db->get_where('account_tbl',['username' => $username,'account_status' => 1]);
		return $query->num_rows() > 0 ? $query->row_array() : '';
	}

	

}