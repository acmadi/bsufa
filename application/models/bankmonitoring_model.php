<?php
	class bankmonitoring_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_cashheader a','a.id_cash');	
			//parent::__construct('db_mapjurnal b','mapjurnal_id');	
			$this->set_join('db_cashdetail b','b.voucher = a.voucher', 'left outer');
			$this->set_join('db_bank c','c.bank_id = a.bankacc');
			$this->set_join('db_coa d','c.bank_coa = d.acc_no','left');
					
		}				
			function before_fetch(){
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			// $this->db->query("select id_cash ,voucher ,trans_date, status, cash_in, paidby,  descs,  trx_type, bank_nm, amount
// from db_cashheader a inner join db_cashdetail b
// on a.voucher=b.voucher inner join db_bank c
// on c.bank_id=a.bankacc
// UNION ALL
// select mapjurnal_id as id_cash, kwtbill_no as voucher, date_jurnal as trans_date, a.id_flag as status, acc_cf as cash_in, '' as paidby, remark as descs, 'MP' as trx_type, kwtbill_nm as bank_nm, debet as  amount
// from db_mapjurnal a inner join db_kwtbill b on a.id_kwtbill=b.kwtbill_id
// where a.id_flag<>10 and debet>0");
		$this->db->select("a.id_cash,a.voucher,convert(varchar(12), a.trans_date, 105)  as trans_date, a.status, a.cash_in, a.paidby,  a.descs, a.trx_type, d.acc_name as bank_nm,convert(varchar,CONVERT(money, base_amount),1) as base_amount, a.slipno, a.[from], b.amt_base");
			$this->db->distinct();
			$this->db->where_not_in('a.status',8);
			$this->db->where('a.trx_type','BM');
			$this->db->where('c.id_pt',$pt);
			parent::before_fetch();
			
					
		}
		// protected function filter_field($field){
		// if($field == 'a.amount'){
			// $this->join_on_count = true;
		// }elseif($field == 'voucher'){
			// $this->join_on_count = true;
		// }		return $field;
	// }

	}
?>
