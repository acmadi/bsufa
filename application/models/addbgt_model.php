<?php
	class addbgt_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_bgtproj_update_add a','id_bgtproj_update_add');
			//~ $this->set_join('db_divisi b','a.id_divisi = b.divisi_id  ');
			
		}
		
		function before_fetch(){
			
			$this->db->select('id_bgtproj_update_add,isnull(flag_id,0)as flag,tgl_bgtproj,remark,nilai_bgtproj,id_user');
			
			$this->db->order_by('id_bgtproj_update_add','desc');
			parent::before_fetch();
		}
		
		

	}



