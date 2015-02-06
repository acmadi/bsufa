<?php
class kwt_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_kwtbill','kwtbill_id');
		$this->set_join('db_billing','id_bill = id_billing');
		$this->set_join('db_sp','id_sp = sp_id');
		
		
		
		
	}
	
	function before_fetch(){
	
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		if($pt == 44){
		$this->db->select("kwtbill_id,kwtbill_paydate,kwtbill_no,kwtbill_pay,isnull(db_kwtbill.id_print,0) as id_print, kwtbill_remark");
		$this->db->where('isnull(db_kwtbill.id_flag,0) !=',10);
		$this->db->where('kwtbill_reff',NULL);
		$this->db->where('id_pt',$pt);
		parent::before_fetch();
		}if($pt == 11){
		$this->db->select("kwtbill_id,kwtbill_paydate,kwtbill_no,kwtbill_pay,isnull(db_kwtbill.id_print,0) as id_print, kwtbill_remark");
		$this->db->where('isnull(db_kwtbill.id_flag,0) !=',10);
		$this->db->where('kwtbill_reff',1111);
		$this->db->where('id_pt',$pt);
		parent::before_fetch();
		}if($pt == 22){
		$this->db->select("kwtbill_id,kwtbill_paydate,kwtbill_no,kwtbill_pay,isnull(db_kwtbill.id_print,0) as id_print, kwtbill_remark");
		$this->db->where('isnull(db_kwtbill.id_flag,0) !=',10);
		$this->db->where('id_pt',$pt);
		//$this->db->where('kwtbill_reff',1111);
		parent::before_fetch();
		} if($pt == 66){
		$this->db->select("kwtbill_id,kwtbill_paydate,kwtbill_no,kwtbill_pay,isnull(db_kwtbill.id_print,0) as id_print, kwtbill_remark");
		$this->db->where('isnull(db_kwtbill.id_flag,0) !=',10);
		$this->db->where('id_pt',$pt);
		//$this->db->where('kwtbill_reff',1111);
		parent::before_fetch();
		} 
		
	 
	}
	
	
	
	
	


}
