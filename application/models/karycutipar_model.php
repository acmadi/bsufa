<?php
	class karycutipar_model extends Model{
		
		function __construct(){
			parent::model();
		}
		
		function selectkarycutipar(){
			
			return $this->db->get('db_karycutipar')->result();
		}
		
	
	
	}	
			
?>
