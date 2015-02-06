<?php
	class useraccess_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('user_admin','id_user');
			$this->set_join('user_group','id_group = group_id');
			$this->set_join('db_divisi','user_admin.divisi_id = db_divisi.divisi_id');
			$this->set_join('pt','pt.id_pt = user_admin.id_pt');
		}
		
		function before_fetch(){
			$this->db->select('group_name,username,kary_id,status,ket,divisi_nm');
			parent::before_fetch();
		}
		
		
	}
			
?>
