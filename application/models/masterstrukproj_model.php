<?php
	class masterstrukproj_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
				parent::__construct('db_subproject','subproject_id'); // Edit By Abas : 22 Oct 2012
			/*parent::__construct('db_sbgtproj a','a.id_sbgtproj');
			$this->set_join('db_costproj b','b.id_scostproj = a.id_scostproj');
			$this->set_join('db_hbgtproject c','c.project_id = a.id_hbgbtproj');
			$this->set_join('db_subproject d','c.project_id = d.subproject_id');
			*/
		}
		
		function before_fetch(){
			#$this->db->select('a.id_sbgtproj,a.nilai_scost,c.kode_bgtproj,b.nm_scost,c.tot_bgtproj,c.remark,d.nm_subproject');
			#$this->order_by('d.nm_subproject','ASC');
			$this->db->select('subproject_id,nm_subproject,isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 1),0) as land,
								isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 2),0) as construction,
								isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 3),0) as softcost,
								isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 4),0) as infrastructure,
								isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 5),0) as permite,
								isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 6),0) as idc,
								isnull((select sum(nilai_scost) from db_sbgtproj where id_hbgbtproj = subproject_id
								and id_scostproj = 7),0) as kawasan
											
			');
			$this->db->where('pt_id',44);
			parent::before_fetch();
		}
		
	}



