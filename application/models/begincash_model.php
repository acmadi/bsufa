<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Begincash_model extends DBModel {

	function __construct(){ 
		parent::__construct('db_dailycash a','id_dailycash');
		$this->set_join('db_subproject b','a.id_project = b.subproject_id');
		$this->set_join('bank c','a.bank_id = c.bank_id');
		$this->set_join('pt d','a.id_pt = d.id_pt');
	}

	
	function before_fetch(){
		$this->db->select("a.id_dailycash,a.id_pt,a.id_project as id_project,a.bank_id,a.begin_date,a.begin_amount,a.end_amount,c.namabank as namabank,c.nomorrek as nomorrek,d.nm_pt as nm_pt,b.nm_subproject as nm_subproject");
		$this->db->where('b.pt_id !=', '');
		parent::before_fetch();
		
	}

	protected function filter_field($field){
		if($field == 'nm_pt'){
			$this->join_on_count = true;
		}elseif($field == 'namabank'){
			$this->join_on_count = true;
		}elseif($field == 'nm_subproject'){
			$this->join_on_count = true;
		}		
		return $field;
	}

	function savedata($data){
		$this->db->insert('db_dailycash', $data);
	}

	function updatedata($id,$data){
		$this->db->where('id_dailycash', $id);
		$this->db->update('db_dailycash', $data);
	}

	function deletedata($id){
		$this->db->where('id_dailycash', $id);
		$this->db->delete('db_dailycash');
	}

}

/* End of file begincash_model.php */
/* Location: ./application/models/begincash_model.php */