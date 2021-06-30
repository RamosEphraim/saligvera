<?php 

class OrderModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function add($request_id,$order_status){
		$result = $this->db->insert('order_tbl', ['request_id' => $request_id, 'order_status' => $order_status]);
		return $result;
	}

	public function show(){
		$data = array('1', '2');
		$this->db->select('*');
		$this->db->from('order_tbl');
		$this->db->where_in('order_status', $data);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function show_(){
		$data = array('3', '4');
		$this->db->select('*');
		$this->db->from('order_tbl');
		$this->db->where_in('order_status', $data);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function today(){
		$date = date('Y-m-d');
		$query = $this->db->get_where('order_tbl',['order_date' => $date]);
		return $query->num_rows();
	}

	public function verified(){
		$query = $this->db->get_where('order_tbl',['order_status' => 1]);
		return $query->num_rows();
	}

	public function denied(){
		$query = $this->db->get_where('order_tbl',['order_status' => 2]);
		return $query->num_rows();
	}

	public function today_(){
		$date = date('Y-m-d');
		$query = $this->db->get_where('order_tbl',['order_date' => $date]);
		return $query->num_rows();
	}

	public function verified_(){
		$query = $this->db->get_where('order_tbl',['order_status' => 3]);
		return $query->num_rows();
	}

	public function denied_(){
		$query = $this->db->get_where('order_tbl',['order_status' => 4]);
		return $query->num_rows();
	}
}