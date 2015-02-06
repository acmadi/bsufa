<?php
class leaseunit_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_unit_sewa ','nounit');
		$this->set_join('db_subproject ','subproject_id = kd_project');
		$this->set_join('db_unitstatus ','unitstatus_id = status');
		
		
		
		#jhh$this->set_join('db_custemrg','db_customer.customer_id = db_custemrg.id_customer');
	}
	
	
	protected function before_fetch(){
			$this->db->select('db_unit_sewa.id as id_unit, nounit,nm_subproject,luas,harga_meter,unitstatus_nm, status,lantai')
			->where('pt_id',12);
		
			parent::before_fetch();
		}
	
	//~ function joinall($id){
			//~ 
			//~ $this->db->join('db_negara','negara_id = id_negara','left');
			//~ $this->db->join('db_propinsi','propinsi_id = id_propinsi','left');
			//~ $this->db->join('db_etnis','etnis_id = id_etnis','left');
			//~ $this->db->join('db_motivie','motivie_id = id_motivie','left');
			//~ $this->db->join('db_tipemedia','tipemedia_id = id_tipemedia','left');
			//~ $this->db->join('db_media','media_id = id_media','left');
			//~ $this->db->join('db_profesi','profesi_id = id_profesi','left');
			//~ $this->db->join('db_group','group_id = id_group','left');
			//~ $this->db->join('db_kota','customer_tmpt_lhr = kota_id','left');
			//~ $this->db->join('db_agama','id_agama = agama_id','left');
			//~ $this->db->where('customer_id',$id);
			//~ return $this->db->get('db_customer')->row_array();
	//~ 
	//~ }
	//~ 
	//~ function additional($id){
			//~ 
			//~ 
			//~ 
			//~ $this->db->join('db_bisnis','id_bisnis = bisnis_id','left');
			//~ $this->db->join('db_customer','id_customer = customer_id','left');
			//~ $this->db->join('db_kota','id_kota1 = kota_id','left');
			//~ $this->db->join('db_propinsi','id_propinsi1 = propinsi_id','left');
			//~ $this->db->join('db_negara','id_negara1 = negara_id','left');
			//~ 
			//~ 
			//~ $this->db->where('id_customer',$id);
			//~ return $this->db->get('db_custcomp')->row();
			//~ 
	//~ }
	
	
	
	
	
}


