<?php
	class alokasiproj_model extends DBModel{
		
		function __construct(){ 
			
			parent::__construct('db_alokasiproj','id_alokasiproj');
			$this->set_join('db_subproject','project_id = subproject_id','left');
			$session_id = $this->UserLogin->isLogin();
			$this->pt = $session_id['id_pt'];
			
		}
		
		function before_fetch(){
		$this->db->select("id_alokasiproj,nm_subproject,alokasi,remark");
		$this->db->where('id_pt',$this->pt);
		$this->db->where('id_flag !=',10);
		
		parent::before_fetch();
	}


}
