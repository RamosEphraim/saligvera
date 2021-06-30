<?php 

class ProjectModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkexist($name,$contact,$worker_id){
		$query = $this->db->get_where('project_tbl',['name' =>$name, 'contact' =>$contact]);
		if($query->num_rows() > 0){
			$row = $query->row_array();
			return $row['worker_id'] == $worker_id ? true : false;
		}else{
			return true;
		}
	}

	public function check($project_name){
		$query = $this->db->get_where('project_tbl',['project_name' =>$project_name]);
		return $query->num_rows() > 0 ? true : false;
	}

	public function checkList($project_id,$task){
		$query = $this->db->get_where('checklist_tbl',['project_id' => $project_id,'task' =>$task]);
		return $query->num_rows() > 0 ? true : false;
	}

	public function UpdateCheckList($data){
		$this->db->where('check_id', $data['check_id']);
		if($data['start'] == '') {
			$result = $this->db->update('checklist_tbl', ['task_status' => 1, 'start' => date('Y-m-d')]);
		} else {
			$result = $this->db->update('checklist_tbl', ['task_status' => 0, 'end' => date('Y-m-d')]);
		}
		return $result;
	}

	public function addCheck($project_id,$task,$percentage,$status){
		$data = array(
			'project_id' => $project_id,
			'task' => $task,
			'percentage' => $percentage,
			'task_status' => $status
		);
		$result = $this->db->insert('checklist_tbl', $data);
		return $result;
	}

	public function showCheck($project_id){
		$query = $this->db->get_where('checklist_tbl', ['project_id' => $project_id ]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function checkListProgress($project_id){
		$query = $this->db->get_where('checklist_tbl', ['project_id' => $project_id, 'task_status' => 0])->result();
		$percentage = 0;
		foreach($query as $row) {
			$percentage += $row->percentage;
		}
		$this->db->where('project_id', $project_id);
		$result = $this->db->update('project_tbl', ['project_progress' => $percentage]);
		return $percentage;
	}

	public function showPhoto($project_id){
		$query = $this->db->get_where('photo_tbl', ['project_id' => $project_id ]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}


	public function add($first_ea,$second_ea,$third_ea,$project_name,$budget,$start_date,$end_date){
		$data = array(
			'first_ea' => $first_ea,
			'second_ea' => $second_ea,
			'third_ea' => $third_ea,
			'project_name' => $project_name,
			'project_budget' => $budget,
			'project_startdate' => $start_date,
			'project_enddate' => $end_date,
		);
		$result = $this->db->insert('project_tbl', $data);
		return $result;
	}

	public function update($project_id){
		$this->db->where('project_id', $project_id);
		$result = $this->db->update('project_tbl', ['project_status' => 1]);
		return $result;
	}

	public function updateProject($project_id,$first_ea,$second_ea,$third_ea,$project_name,$budget,$start_date,$end_date){
		$data = array(
			'first_ea' => $first_ea,
			'second_ea' => $second_ea,
			'third_ea' => $third_ea,
			'project_name' => $project_name,
			'project_budget' => $budget,
			'project_startdate' => $start_date,
			'project_enddate' => $end_date,
		);
		$this->db->where('project_id', $project_id);
		$result = $this->db->update('project_tbl',$data);
		return $result;
	}

	public function show(){
		$query = $this->db->get_where('project_tbl');
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function engr(){
		$query = $this->db->get_where('account_tbl',['type_role' => 1, 'account_status' => 1]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function arch(){
		$query = $this->db->get_where('account_tbl',['type_role' => 2, 'account_status' =>1]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function engr_(){
		$query = $this->db->get_where('account_tbl',['type_role' => 1]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function arch_(){
		$query = $this->db->get_where('account_tbl',['type_role' => 2]);
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function edit($project_id){
		$query = $this->db->get_where('project_tbl',['project_id' =>$project_id]);
		return $query->num_rows() > 0 ? $query->row_array() : $query->row_array();
	}

	public function getNew($project_name){
		$query = $this->db->get_where('project_tbl', ['project_name' => $project_name]);
		return $query->num_rows() > 0 ? $query->row_array() : $query->row_array();
	}

	public function workerStatus($project_id,$get){
		$this->db->where('project_id', $project_id);
		$result = $this->db->update('project_tbl', ['project_workers' => $get]);
		return $result;
	}


	public function Upload($image,$id) {
		$data =  array( 'photo' => $image, 'project_id' => $id );
		$result = $this->db->insert('photo_tbl',$data);
		return $result;
	}


	public function showSet($account_id){
		$this->db->select('*');
		$this->db->from('project_tbl');
		$this->db->where('first_ea', $account_id);
		$this->db->or_where('second_ea', $account_id);
		$this->db->or_where('third_ea', $account_id);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}
	

}