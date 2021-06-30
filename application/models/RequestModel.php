<?php 

class RequestModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function today(){
		$date = date('Y-m-d');
		$query = $this->db->get_where('request_tbl',['request_date' => $date]);
		return $query->num_rows();
	}

	public function order(){
		$query = $this->db->get_where('request_tbl',['request_status' => 2]);
		return $query->num_rows();
	}

	public function verified(){
		$query = $this->db->get_where('request_tbl',['request_status' => 3]);
		return $query->num_rows();
	}

	public function verification(){
		$query = $this->db->get_where('request_tbl',['request_status' => 4]);
		return $query->num_rows();
	}

	public function confirm(){
		$query = $this->db->get_where('request_tbl',['request_status' => 5]);
		return $query->num_rows();
	}

	public function confirmed(){
		$query = $this->db->get_where('request_tbl',['request_status' => 6]);
		return $query->num_rows();
	}

	public function denyorder(){
		$query = $this->db->get_where('request_tbl',['request_status' => 7]);
		return $query->num_rows();
	}

	public function rejectrequest(){
		$query = $this->db->get_where('request_tbl',['request_status' => 8]);
		return $query->num_rows();
	}

	public function deniedsupply(){
		$query = $this->db->get_where('request_tbl',['request_status' => 9]);
		return $query->num_rows();
	}

	public function declinedsupply(){
		$query = $this->db->get_where('request_tbl',['request_status' => 10]);
		return $query->num_rows();
	}

	public function show(){
		$data = array('1', '3', '5', '6', '7', '8', '9', '10', '11');
		$this->db->select('*');
		$this->db->from('request_tbl');
		$this->db->where_in('request_status', $data);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function showAccounting(){
		$query = $this->db->get_where('request_tbl',['request_status' => 2]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function showWarehouse(){
		$query = $this->db->get_where('request_tbl',['request_status' => 4]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function updateStatus($request_id, $request_status){
		$this->db->where('request_id', $request_id);
		$result = $this->db->update('request_tbl', ['request_status' => $request_status]);
		return $result;
	}

	public function get($request_id){
		$query = $this->db->get_where('request_tbl',['request_id' => $request_id]);
		return $query->num_rows() > 0 ? $query->row_array() : $query->row_array();
	}

	public function showAll($project_id){
		$query = $this->db->get_where('request_tbl',['project_id' => $project_id]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}
}