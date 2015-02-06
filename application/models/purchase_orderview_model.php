<?php
	class purchase_orderview_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_barangpoh','brgpoh_id');
			// $this->set_join('db_divisi b','div_pr = divisi_id');
			// $this->set_join('db_barangpoh c','c.id_pr = a.id_pr','left');

			
		}
		
		function before_fetch(){
		//	$this->db->join('db_barangpoh c','c.id_pr = a.id_pr','left');
					//->where('id_pt',44);	\
					$this->db->where('id_pt',44);		 	
			parent::before_fetch();
			
		}
		
}



