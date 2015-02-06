<?php
	class prmonitoring_model extends DBModel{
		
			function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_pr a','id_pr');
			$this->set_join('db_divisi b','divisi_id = div_pr');
			$this->set_join('db_trbgtdiv c','trbgt_id = id_trbgt');
			
		}
		function before_fetch(){
		$this->db->select("description,status_pr,budgeted,remark,id_pr,no_pr,tgl_pr,tgl_aproval,div_pr,divisi_nm,req_pr,ket_pr,alasan_pr,a.id_pt,amount");
		$this->db->where('a.id_pt',44);
		parent::before_fetch();
	}
		
		
		
		
	}



