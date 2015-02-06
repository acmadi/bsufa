<?php
defined('BASEPATH') or die('Access Denied');	
class postinginvoice_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_ledgerleasing a','a.id_ledger');
		$this->set_join('db_loo_sewa c','a.kd_tenant = c.kd_tenant');
		$this->set_join('db_customer d','c.id_customer = d.customer_id');
	}
	
	 function before_fetch(){
		 // $this->db->select('a.gl_id, b.trans_date,a.module,a.voucher,b.acc_no,b.line_desc,b.debit,b.credit, a.status')
							// ->where_not_in('a.module','AJ') ;
							
		//$status = array('0','10');
		$this->db->select('id_ledger, a.kd_tenant, no_invoice,convert(varchar(12), tgl_invoice, 105) as tgl_invoice,description, convert(varchar,CONVERT(money, trx_amount),1) as base_amount, a.id_flag, customer_nama')
							//->where_not_in('a.module','AJ') ;
						//	->limit(1)
							->where('a.id_flag',2)
							->where('c.status',2);
						//	->group_by('id_invoice,no_kontrak, kd_tenant, no_invoice,convert(varchar(12), tgl_invoice, 105) as tgl_invoice,description, convert(varchar,CONVERT(money, base_amount),1) as base_amount, id_flag') ;
							
		 parent::before_fetch();	

	 }	

}

            

           

            
