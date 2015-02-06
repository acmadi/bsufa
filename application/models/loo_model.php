<?php
class loo_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_loo_sewa a','a.id');
		$this->set_join('db_unit_sewa b','a.nounit = b.id','left');
		$this->set_join('db_customer c','c.customer_id = a.id_customer');
		$this->set_join('db_subproject d','d.id_project = b.kd_project');
	}
	
	
	function before_fetch(){
		
		$this->db->select('a.id as id,no_loo,b.nounit as nounit,luas,hrg_meter,hrg_tot,customer_nama as nama,nm_subproject,a.status')
						->where_in('d.pt_id',12) 
						->where('a.status !=',10) ;
		parent::before_fetch();
		
	}
	
	
	
}


