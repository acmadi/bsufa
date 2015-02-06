<?php
	class budgetalocation_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('project','kd_project');
		}		

		function before_fetch(){ 
			$this->db->select('*');
			$this->db->where('is_show','1');
			parent::before_fetch();
		}
	
		
	
	}
?>
