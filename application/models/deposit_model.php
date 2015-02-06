<?php
	class deposit_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_deposit','deposit_id');
							
		}	
		function before_fetch(){
		//$project = array('41012','41011','1');
		$this->db->select("deposit_id, no_deposit, convert(varchar(12), date, 105) as date, description, kd_tenant, base_amt,id_flag");
		//$this->db->where('status',0 );
		parent::before_fetch();
	}
	}
?>
