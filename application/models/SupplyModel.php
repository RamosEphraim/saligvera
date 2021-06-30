<?php 

class SupplyModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function show(){
		$query = $this->db->get_where('supply_tbl');
		return $query->num_rows() > 0 ? $query->result() : $query->result();
	}

	public function check($item,$description,$unit){
		$query = $this->db->get_where('supply_tbl',['unit' =>$unit,'description'=>$description,'item'=>$item]);
		return $query->num_rows() > 0 ? true : false;
	}

	public function add($item,$description,$unit,$quantity,$supplier,$supply_status){
		$data = array(
			'item' => $item,
			'description' => $description,
			'unit' => $unit,
			'stocks' => $quantity,
			'supplier' => $supplier,
			'supply_status' => $supply_status,
		);
		$result = $this->db->insert('supply_tbl', $data);
		return $result;
	}

	public function edit($supply_id){
		$query = $this->db->get_where('supply_tbl',['supply_id' => $supply_id]);
		return $query->num_rows() > 0 ? $query->row_array() : $query->row_array();
	}

	public function checkexist($item,$description,$unit,$supply_id){
		$query = $this->db->get_where('supply_tbl',['unit' =>$unit,'description'=>$description,'item'=>$item]);
		if($query->num_rows() > 0){
			$row = $query->row_array();
			return $row['supply_id'] == $supply_id ? true : false;
		}else{
			return true;
		}
	}

	public function update($supply_id,$item,$description,$unit,$quantity,$supplier,$supply_status){
		$data = array(
			'item' => $item,
			'description' => $description,
			'unit' => $unit,
			'stocks' => $quantity,
			'supplier' => $supplier,
			'supply_status' => $supply_status,
		);
		$result = $this->db->where(['supply_id' => $supply_id])->update('supply_tbl', $data);
		return $result;
	}

	public function updateStocks($supply_id,$solution){
		$this->db->where('supply_id', $supply_id);
		$result = $this->db->update('supply_tbl', ['stocks' => $solution]);
		return $result;
	}

}