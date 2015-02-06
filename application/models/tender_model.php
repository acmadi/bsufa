<?php
	class tender_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_tendeva a','a.id_tendeva');
			$this->set_join('db_mainjob b','a.id_mainjob = b.mainjob_id');
			$this->set_join('pemasokmaster c','c.kd_supp_gb = a.id_vendor');	
		}
		
		function before_fetch(){
			$this->db->select('a.no_tendeva,isnull(a.nilai_tender,0) as nilai_tender,c.nm_supplier,a.id_tendeva,a.date_tendeva,a.id_mainjob,b.no_trbgtproj,a.job,a.id_flag');
			parent::before_fetch();
		}
		
	}



