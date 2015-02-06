<?php
class viewcustomerlease_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_kontrak_sewa a','a.id_kontrak');
		$this->set_join('db_loo_sewa b','a.id_loo = b.id');
		$this->set_join('db_customer c','b.id_customer = c.customer_id');
		$this->set_join('db_subproject d','b.id_subproject = d.subproject_id');
		$this->set_join('db_unit_sewa e','b.nounit = e.id');		

				
	}
	
	function before_fetch(){	
	
		$this->db->select('id_kontrak,kd_tenant, no_kontrak_sewa,e.nounit,tgl_loo,nm_subproject,customer_nama')
				->where('b.status !=',10)
				->where('d.pt_id',12);
		parent::before_fetch();
		
	}
	
	
	protected function filter_field($field){
		if($field == 'customer_nama'){
			$this->join_on_count = true;
		}elseif($field == 'kd_tenant'){
			$this->join_on_count = true;
		}		return $field;
	}	
	
	// function joinall($id){
			// $this->db->where('customer_id',$id);
			// return $this->db->get('db_customer')->row_array();
	
	// }
	
	// function additional($id){	
			// $this->db->join('db_bisnis','id_bisnis = bisnis_id','left');
			// $this->db->join('db_customer','id_customer = customer_id','left');
			// $this->db->join('db_kota','id_kota1 = kota_id','left');
			// $this->db->join('db_propinsi','id_propinsi1 = propinsi_id','left');
			// $this->db->join('db_negara','id_negara1 = negara_id','left');
			
			
			// $this->db->where('id_customer',$id);
			// return $this->db->get('db_custcomp')->row();
			
	// }
	
}


