<?php
defined('BASEPATH') or die('Access Denied');	
class reminder_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_sp a','a.sp_id');
		$this->set_join('db_customer b','a.id_customer = b.customer_id');
		//$this->set_join('db_unit_bdm c','a.id_unit = c.unit_id');
		$this->set_join('db_billing d','a.sp_id = d.id_sp');
		
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		
		if($pt == 44){
		$this->set_join('db_unit_yogya c','a.id_unit = c.unit_id');	
		//$this->set_join('db_unit_yogya g','a.id_subproject = e.id_subproject');	
		}if($pt == 11){
		$this->set_join('db_unit_bdm c','a.id_unit = c.unit_id');	
		//$this->set_join('db_unit_bdm f','a.id_subproject = e.id_subproject');	
		}if($pt == 22){
		$this->set_join('db_unit_bdm c','a.id_unit = c.unit_id');	
		//$this->set_join('db_unit_bdm f','a.id_subproject = e.id_subproject');	
		}
		

	}
	
	 function before_fetch(){
		 // $this->db->select('a.gl_id, b.trans_date,a.module,a.voucher,b.acc_no,b.line_desc,b.debit,b.credit, a.status')
							// ->where_not_in('a.module','AJ') ;
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
	
							
		
		$this->db->select('sp_id,tgl_sales, customer_nama, unit_no, selling_price, price_manual, isnull(sum(d.amount),0) as billing, 
						isnull(sum(pay_amount),0) as payment, (isnull(sum(d.amount),0)-isnull(sum(pay_amount),0)) as balance, print_reminder')
							 ->group_by('sp_id,tgl_sales, customer_nama, unit_no, selling_price, price_manual,print_reminder')
							->where_in('a.id_pt',$pt) 
							->where('a.id_flag !=',10);
							
		 parent::before_fetch();	

	 }	
	 
	 		protected function filter_field($field){
		if($field == 'customer_nama'){
			$this->join_on_count = true;
		}elseif($field == 'unit_no'){
			$this->join_on_count = true;
		}		return $field;
	}	

}

            

           

            

			