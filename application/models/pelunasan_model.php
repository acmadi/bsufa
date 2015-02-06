<?php
class pelunasan_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_sp','sp_id');
		$this->set_join('db_billing','id_sp = sp_id','left');
		$this->set_join('db_customer','customer_id = id_customer','left');
		//$this->set_join('db_unit_yogya','unit_id = id_unit','left');
		$this->set_join('db_kwtbill','id_bill = id_billing','left');
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		
		if($pt == 44){
		$this->set_join('db_unit_yogya','unit_id = id_unit','left');
		//$this->set_join('db_unit_yogya','db_sp.id_subproject = db_unit_yogya.id_subproject');	
		}if($pt == 11){
		$this->set_join('db_unit_bdm','unit_id = id_unit','left');
		//$this->set_join('db_unit_bdm','db_sp.id_subproject = db_unit_bdm.id_subproject');	
		}if($pt == 22){
		$this->set_join('db_unit_bdm','unit_id = id_unit','left');
		//$this->set_join('db_unit_bdm','db_sp.id_subproject = db_unit_bdm.id_subproject');	
		}
		
		
	}
	
	protected function before_fetch()
	{
		//provate $ni = 
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		// $this->db->select('no_sp, sp_id, db_customer.customer_nama as customer_nama ,unit_no,sum(kwtbill_pay) as amt,
		// (select max(tgl_paydate) from db_billing where id_sp = 71) as tgl_paydate,selling_price, (selling_price-sum(kwtbill_pay)) as outstanding')
		$this->db->select('no_sp, sp_id, db_customer.customer_nama as customer_nama ,unit_no,sum(kwtbill_pay) as amt,
		selling_price, isnull(db_sp.id_print,0) as id_print,(selling_price-sum(kwtbill_pay)) as outstanding')
				 ->group_by('no_sp,sp_id,db_customer.customer_nama,unit_no,selling_price,db_sp.id_print')
				 //->having('sum(amount) = sum(pay_amount)');
				 ->having('round(sum(amount),0) >= selling_price')
				 ->or_having('round(sum(amount),0) >= selling_price - 100')
				 ->where('isnull(db_kwtbill.id_flag,0) !=',10)
				 ->where('db_sp.id_pt',$pt)
				// ->where('pay_sisa <=',5)
				 ->order_by('db_customer.customer_nama','asc');
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

