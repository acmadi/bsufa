<?php
	class projbgt_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_bgtproj a','coa_no');
		}
		
		
		function before_fetch(){
			$this->db->select('coa_no,kode_bgtproj,nm_bgtproj,
							   (select isnull(sum(nilai_bgtproj),0) from db_bgtproj b where coa_no = a.coa_no) as jan12')
				     ->group_by('coa_no,kode_bgtproj,nm_bgtproj');
				    # ->order_by('coa_no','asc');
			parent::before_fetch();
		}
	}



