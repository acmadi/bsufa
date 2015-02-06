<?php
class cekgiro_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('tranbank','tranbank_id');
		$this->set_join('projec','tranbank.kd_project = project.kd_project');
	}
		
	function before_fetch(){
		#$this->db->select('project.nm_project as nm_project');
		#$this->db->join('project','project.kd_project = tranbank.kd_project');
		$this->db->where('bank_out !=',0);
	}	

}


