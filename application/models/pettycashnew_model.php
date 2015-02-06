<?php
	class pettycashnew_model extends DBModel{
		
		function __construct(){ 	
			parent::__construct('db_pettynew','id_ptcash');
			
		}
		
		function before_fetch(){
			$this->db->where('flag_hapus', 0);
			parent::before_fetch();
		}

		function insertdata($table,$data)
		{
			$q = $this->db->insert($table, $data);
			return $q;
		}

		function updatedata($table,$pk,$value,$data)
		{
			$this->db->where($pk,$value);
			$q = $this->db->update($table, $data);
			return $q;
		}		

	}



