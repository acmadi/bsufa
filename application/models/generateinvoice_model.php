<?php
defined('BASEPATH') or die('Access Denied');	
class generateinvoice_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_invoice a','a.kd_tenant');
		$this->set_join('db_subproject b','a.id_subproject = b.subproject_id');
		$this->set_join('db_loo_sewa c','a.kd_tenant = c.kd_tenant');
		$this->set_join('db_customer d','c.id_customer = d.customer_id');
	}
	
	 function before_fetch(){
		 // $this->db->select('a.gl_id, b.trans_date,a.module,a.voucher,b.acc_no,b.line_desc,b.debit,b.credit, a.status')
							// ->where_not_in('a.module','AJ') ;
							
		$status = array('5');
		$this->db->select('a.no_kontrak, a.kd_tenant,  convert(varchar(12), tgl_invoice, 105) as tgl_invoice ,description, SUM(trx_amount) as base_amount, a.id_flag, nm_subproject, customer_nama')
							//->where_not_in('a.module','AJ') ;
							->where_in('a.id_flag',$status) 
							->where('c.status',2) 
							->where('pt_id',12) 
							->group_by('a.no_kontrak, a.kd_tenant, tgl_invoice,description, a.id_flag, nm_subproject,customer_nama')
;
							
		 parent::before_fetch();	

	 }	

}

            

           

            
