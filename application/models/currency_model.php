<?php
defined('BASEPATH') or die('Access Denied');	
class currency_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_currency','currency_id');
	}
	
	function before_fetch(){
		$this->db->select('currency_id,currency_cd,currency_name,
		currency_date,currency_amount,status');	
		parent::before_fetch();	

	}	

	
}
