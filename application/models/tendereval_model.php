<?php
	class tendereval_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_tendeva a','a.id_tendeva');
			$this->set_join('db_mainjob b','a.id_mainjob = b.mainjob_id');
			$this->set_join('pemasok c','c.kd_supp_gb = a.id_vendor');	
		}
		
		function before_fetch(){
		
		$project = array('41012','41011','1');
			$this->db->select('a.no_tendeva,isnull(a.nilai_tender,0) as nilai_tender,c.nm_supplier,a.id_tendeva,a.date_tendeva,a.id_mainjob,b.no_trbgtproj,a.job,a.id_flag')
			->group_by('a.no_tendeva,isnull(a.nilai_tender,0) ,c.nm_supplier,a.id_tendeva,a.date_tendeva,a.id_mainjob,b.no_trbgtproj,a.job,a.id_flag');
			$this->db->where_in('c.kd_project',$project );
			parent::before_fetch();
		}
		
	}



