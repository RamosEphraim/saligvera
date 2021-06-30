<?php 

class AccountModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function check($surname,$firstname,$middlename,$email){
		$query = $this->db->get_where('account_tbl',['surname' =>$surname, 'firstname' =>$firstname, 'middlename' =>$middlename, 'email' =>$email]);
		return $query->num_rows() > 0 ? true : false;
	}

	public function add($username,$surname,$firstname,$middlename,$email,$contact,$role,$type){
		$data = array(
			'username'   	 => $username,  'surname' 	 => $surname,
			'firstname'  	 => $firstname, 'middlename' => $middlename,
			'email' 	 	 => $email,  	'contact' 	 => $contact,
			'password' 	 	 => password_hash('password', PASSWORD_BCRYPT),
			'account_status' => 1, 'role' => $role,
			'type_role' 	 => $type, 'pincode' => rand(1111,9999),
		);
		$result = $this->db->insert('account_tbl', $data);
		return $result;
	}

	public function edit($account_id){
		$query = $this->db->get_where('account_tbl',['account_id' =>$account_id]);
		return $query->num_rows() > 0 ? $query->row_array() : $query->row_array();
	}

	public function show($role){
		$query = $this->db->get_where('account_tbl',['role' => $role]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function update($account_id,$account_status){
		$this->db->where('account_id', $account_id);
		$result = $this->db->update('account_tbl', ['account_status' => $account_status]);
		return $result;
	}

	public function showUser(){
		$role = array('1','2','3','4','5');
		$this->db->select('*');
		$this->db->from('account_tbl');
		$this->db->where_in('role', $role);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function checkexist($surname,$firstname,$middlename,$email,$account_id){
		$query = $this->db->get_where('account_tbl',['surname' =>$surname, 'surname' => $surname, 'middlename' => $middlename , 'email' => $email]);
		if($query->num_rows() > 0){
			$row = $query->row_array();
			return $row['account_id'] == $account_id ? true : false;
		}else{
			return true;
		}
	}

	public function updateGeneral($surname,$firstname,$middlename,$email,$contact,$account_id){
		$data = array(
			'surname' => $surname,
			'firstname' => $firstname,
			'middlename' => $middlename,
			'email' => $email,
			'contact' => $contact,
		);
		$this->db->where('account_id', $account_id);
		$result = $this->db->update('account_tbl', $data);
		return $result;
	}

	public function updatePassword($account_id,$password){
		$this->db->where('account_id', $account_id);
		$result = $this->db->update('account_tbl', ['password' => $password]);
		return $result;
	}


	

}