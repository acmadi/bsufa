<?php
defined('BASEPATH') or die('Access Denied');	
class coa_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_coa a','a.acc_no');
		 $this->set_join('db_currency b','a.currency_cd = b.currency_id');

	}
    function before_fetch(){
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
		$this->db->where('id_pt',$pt );
		$this->db->select('acc_no,acc_name,[level],[type],group_acc,b.currency_cd,a.status');	
		parent::before_fetch();	
  }
  
}



	

