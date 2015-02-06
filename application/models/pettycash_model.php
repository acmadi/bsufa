<?php
	class pettycash_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_pettyclaim','pettycash_id');
							
		}	
		function before_fetch(){
		//$project = array('41012','41011','1');
		$this->db->select("pettycash_id, claim_no, convert(varchar(12), claim_date, 105) as claim_date, type, acc_no, credit,debet, saldo, petty_desc,status");
		//$this->db->where('status',0 );
		parent::before_fetch();
	}
	}
?>
