<?php
defined('BASEPATH') or die('Access Denied');	
class unidentified_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_unidentified a','unidentiacc_id');
		$this->set_join('db_bank b','b.bank_id = a.id_bank');
	}
	
	function before_fetch(){
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		
		$this->db->select('unidentiacc_id,received_date,pay_date,
		pay_unidenti,amount_unidenti,reference,bank_nm');
		$this->db->where_in('a.id_pt',$pt);		
		parent::before_fetch();	


	}	

	
}
