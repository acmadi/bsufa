<?php
	class reclassbgt_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_bgtproj_update_temp a','id_reclass');
			$this->set_join('db_divisi b','a.id_divisi = b.divisi_id  ');
			
		}
		
		function before_fetch(){
			$this->db->select('id_reclass,tgl_bgtproj,id_user,b.divisi_nm,id_flag ');
			$this->db->group_by('id_reclass,tgl_bgtproj,id_user,b.divisi_nm,id_flag');
			$this->db->order_by('id_reclass','desc');
			parent::before_fetch();
		}
		
		

	}



