<?php
defined('BASEPATH') or die('Access Denied');	
class term_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_term','id_term');
	}
	
	// function before_fetch(){
		// $this->db->select('acc_no,acc_name,level,
		// type,group_acc,currency_cd,status');	
		// parent::before_fetch();	

	// }	

	
}
