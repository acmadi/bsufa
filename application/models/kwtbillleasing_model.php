<?php
class kwtbillleasing_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_kuitansi','kwitansi_id');
		// $this->set_join('db_billing','id_bill = id_billing');
		// $this->set_join('db_sp','id_sp = sp_id');
		
		
		
		
	}
	
	function before_fetch(){
	
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		
		$this->db->select("kwitansi_id,kwitansi_paydate,kwitansi_no,kwitansi_pay,isnull(id_print,0) as id_print, kwitansi_remark");
		$this->db->where('isnull(id_flag,0) !=',10);
		parent::before_fetch();
		
		
	 
	}
	
	
	
	
	


}
