<?php
	class project_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('project','kd_project');	
		}
		
		function project(){
			return $this->db->get('project')->result();
		}
	}
?>
