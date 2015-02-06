<?php
	class updateprojbgt_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_bgtproj_update a','a.id_bgtproj_update');
			$this->set_join('db_costproj b','a.id_sbgtproj = b.id_scostproj');
			$this->set_join('db_subproject c','c.subproject_id = a.id_subproject');
			$this->set_join('db_ssubbgtproj d','d.id_ssubbgtproj = a.id_ssubbgtproj');
		}
		
		
		function before_fetch(){
			$this->db->select('nm_subproject,nm_scost,nm_ssubbgtproj,kode_bgtproj,nm_bgtproj,tgl_bgtproj,nilai_bgtproj');
			parent::before_fetch();
		}
	}



