<?php
	class masterproj_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_hbgtproject a','a.id_hbgtproj');
			$this->set_join('db_subproject b','b.subproject_id = a.project_id');
		}
		
		protected function before_fetch(){			
			$this->db->select('a.id_hbgtproj,b.nm_subproject,a.tgl_startproj,a.tgl_endproj,a.kode_bgtproj,( select sum(nilai_bgtproj) from  db_bgtproj_update c where isnull(flag_id,0) != 10 
and c.id_subproject=a.project_id ) as tot_bgtproj,
			a.land_bgtproj,a.sgfa,a.gba,a.remark');
			parent::before_fetch();
		}
	}


