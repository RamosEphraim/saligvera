<?php 

class WorkerModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkexist($name,$contact,$worker_id){
		$query = $this->db->get_where('worker_tbl',['name' =>$name, 'contact' =>$contact]);
		if($query->num_rows() > 0){
			$row = $query->row_array();
			return $row['worker_id'] == $worker_id ? true : false;
		}else{
			return true;
		}
	}

	public function check($name,$contact){
		$query = $this->db->get_where('worker_tbl',['name' =>$name, 'contact' =>$contact]);
		return $query->num_rows() > 0 ? true : false;
	}

	public function add($name,$position,$contact,$address,$realname){
		$data = array(
			'name' => $name,
			'position' => $position,
			'contact' => $contact,
			'address' => $address,
			'worker_status' => 1,
			'worker_img' => $realname,
		);
		$result = $this->db->insert('worker_tbl', $data);
		return $result;
	}

	public function edit($worker_id){
		$query = $this->db->get_where('worker_tbl',['worker_id' =>$worker_id]);
		return $query->num_rows() > 0 ? $query->row_array() : $query->row_array();
	}

	public function update($name,$position,$contact,$address,$worker_status,$worker_id,$project_id){
		$data = array(
			'name' => $name,
			'position' => $position,
			'contact' => $contact,
			'address' => $address,
			'worker_status' => $worker_status,
			'project_id' => $project_id,
		);
		$this->db->where('worker_id', $worker_id);
		$result = $this->db->update('worker_tbl', $data);
		return $result;
	}

	public function show(){
		$query = $this->db->get_where('worker_tbl');
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function show_(){
		$query = $this->db->get_where('worker_tbl', ['worker_status' => 1]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function worker($project_id){
		$query = $this->db->get_where('worker_tbl', ['project_id' => $project_id]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function gethw($worker_id){
		$query = $this->db->get_where('worker_tbl', ['worker_id' => $worker_id]);
		return $query->num_rows();
	}

	public function hw($project_id){
		$query = $this->db->get_where('worker_tbl', ['project_id' => $project_id]);
		return $query->num_rows();
	}

	public function apply($worker_id,$project_id){
		$this->db->where('worker_id', $worker_id);
		$result = $this->db->update('worker_tbl', ['project_id' => $project_id, 'worker_status' => 3]);
		return $result;
	}
	

}