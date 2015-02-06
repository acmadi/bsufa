<?php
class kwitansi_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_kwitansi','kwitansi_id');
		$this->set_join('user_admin','id_user = user_id');
		$this->set_join('db_kary','id_ttd = id_kary');
	}
	
	
	protected function before_fetch()
	{
		$this->db->select('kwitansi_id,kwitansi_tgl,kwitansi_no,
		kwitansi_terima,kwitansi_jml,kwitansi_pembyr,kwitansi_ket1,
		kwitansi_ket2,kwitansi_ket3,username');
		$this->db->where('isnull(db_kwitansi.id_flag,0) !=','10');
		parent::before_fetch();
	}
	
	protected function filter_field($field){
		if($field == 'nama'){
			$this->join_on_count = true;
		}
		return $field;
	}	


}

