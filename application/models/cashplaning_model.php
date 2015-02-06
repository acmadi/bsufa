<?php
defined('BASEPATH') or die('Access Denied');

/*danu : edit
1. ganti join tbl menjadi view_cp
2. menghilangkan alias pada tabel karena diganti menjadi view_cp bukan join table
*/ 

class cashplaning_model extends DBModel{		
	function __construct(){ 
		//parent::__construct('view_cp','apinvoice_id');
		parent::__construct('db_apinvoice a','a.apinvoice_id');
			 $this->set_join('pemasokmaster b','a.vendor_acct = b.kd_supplier');
			 $this->set_join('project c','a.project_no = c.kd_project');
			 $this->set_join('db_cashplan d','a.apinvoice_id = d.id_ap','left');
			 //$this->set_join('pemasok b','a.vendor_acct = b.kd_supp_gb');
			 //$this->set_join('db_apledger c','c.doc_no = a.doc_no');
			 //$this->set_join('db_cashplan d','d.id_ap = a.apinvoice_id','left');
	}
	
	 function before_fetch(){
		$status = array('0','1','2','7');
		// $this->db->select('apinvoice_id, doc_no, nm_supplier,doc_date,inv_no,inv_date,trx_amt, status, descs, malloc_amt, plan_amount as mdoc_amt, plan_date, plan_amount')
							//->where_in('kd_project',$project )
							//->where_not_in('status',0)  ;
		$this->db->select("ISNULL( d.plan_date , '-') as plan_date,a.apinvoice_id as apinvoice_id,a.status as status,a.doc_no as doc_no,b.nm_supplier as nm_supplier,a.doc_date as doc_date,a.descs as descs,a.base_amt as base_amt");
		$this->db->where('c.pt_project','11');
		$this->db->where_in('a.status',$status);
							//->or_where('a.status',2)  ; 
							//$this->set_join('db_gldetail b','a.voucher = b.voucher');
							//->get('db_glheader a')->result();  
							
		 parent::before_fetch();	

	}	

}