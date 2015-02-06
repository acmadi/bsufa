<?php
class reschedule_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_sp a','a.sp_id');

		$this->set_join('db_billing b','b.id_sp = a.sp_id','left');
		$this->set_join('db_customer c','c.customer_id = a.id_customer','left');

		$this->set_join('db_kwtbill d','d.id_bill = b.id_billing','left');
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		
		if($pt == 44){
		$this->set_join('db_unit_yogya e','e.unit_id = a.id_unit','left');
		
		}if($pt == 11){
		$this->set_join('db_unit_bdm e','e.unit_id = a.id_unit','left');
		
		}if($pt == 22){
		$this->set_join('db_unit_bdm e','e.unit_id = a.id_unit','left');
		
		}
		
		
	}
	
	protected function before_fetch()
	{
		$i = 10;
		
		$session_id = $this->UserLogin->isLogin();
   		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
	
		
		$this->db->select('no_sp, sp_id, customer_nama,e.unit_no,sum(kwtbill_pay) as amt,a.id_flag as flag_id
		,selling_price, (selling_price-sum(kwtbill_pay)) as outstanding')
				 
				->group_by('no_sp,sp_id,customer_nama,e.unit_no,selling_price,a.id_flag')
				->where('a.id_flag !=',10)
				->where('a.id_pt',$pt)	
				#->having('sum(amount) = sum(pay_amount)')
				#->having('round(sum(amount),0) >= selling_price')
				#->or_having('round(sum(amount),0) >= selling_price - 100')
				->order_by('customer_nama','asc');
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

