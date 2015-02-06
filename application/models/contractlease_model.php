<?php
class contractlease_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_kontrak_sewa','id_kontrak');
		$this->set_join('db_loo_sewa','db_loo_sewa.id = db_kontrak_sewa.id_loo');
		$this->set_join('db_unit_sewa','db_unit_sewa.id = db_loo_sewa.nounit');
		$this->set_join('db_customer','db_customer.customer_id = db_loo_sewa.id_customer');
	
	}
	
	function before_fetch(){
		//$project = array('41012','41011','1','41013');
		$this->db->select("db_kontrak_sewa.id_kontrak as id_kontrak,no_kontrak_sewa, convert(varchar(12), tgl_mulai, 105) as tgl_mulai, db_kontrak_sewa.status,convert(varchar(12), tgl_buka, 105) as tgl_buka,
		db_kontrak_sewa.hrg_meter,grace_period,customer_nama, db_unit_sewa.nounit,luas, kd_project, no_loo,id_loo, convert(varchar(12), tgl_selesai, 105) as  tgl_selesai");
		$this->db->where('db_loo_sewa.status !=',10 );
		parent::before_fetch();
	}
		protected function filter_field($field){
		if($field == 'customer_nama'){
			$this->join_on_count = true;
		}	return $field;
	}	

}


