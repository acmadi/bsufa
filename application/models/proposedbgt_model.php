<?php
	class proposedbgt_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_mainjob','mainjob_id');
		}
		
		function before_fetch(){
			$this->db->where('isnull(id_flag,0) !=',10);
			parent::before_fetch();
		}
		
	}



