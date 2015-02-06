<?php
	class mstbank_model extends DBModel{
		function __construct(){ 
			parent::__construct('db_bank','id_bank');
		}
		
		function list_coa(){
			return $this->db->get('db_coa')->result();
		}

		function matauang(){
			return $this->db->get('db_curr')->result();
		}
		
		function divisi(){
			return $this->db->get('db_divisi')->result();
		}
	}
