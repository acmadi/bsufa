<?php
defined('BASEPATH') or die('Access Denied');

/*danu : edit
1. ganti join tbl menjadi view_cp
2. menghilangkan alias pada tabel karena diganti menjadi view_cp bukan join table
*/ 

class cashplaningx_model extends DBModel{		
	function __construct(){ 
		//parent::__construct('view_cp','apinvoice_id');
		parent::__construct('db_apinvoice a','a.apinvoice_id');
			 $this->set_join('pemasokmaster b','a.vendor_acct = b.kd_supplier');
			 //$this->set_join('pemasok b','a.vendor_acct = b.kd_supp_gb');
			 $this->set_join('db_apledger c','c.doc_no = a.doc_no');
			 $this->set_join('db_cashplan d','d.id_ap = a.apinvoice_id','left');
	}
	
	 function before_fetch(){
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			$kodeprojek = $this->db->query("select subproject_id from db_subproject where id_pt = ".$pt."")->result();
			foreach($kodeprojek as $row){
				$project[] = $row->subproject_id;
			}
	 
	 //	$project = array('41012','41011','1','41013');
		 $this->db->select('apinvoice_id, a.doc_no, b.nm_supplier,a.doc_date,a.inv_no,a.inv_date,a.trx_amt, a.status, a.descs, c.malloc_amt, d.plan_amount as mdoc_amt, d.plan_date, d.plan_amount')
							->where_in('b.kd_project',$project )
							->where_not_in('a.status',0)  ;
							
							//->or_where('a.status',2)  ; 
							//$this->set_join('db_gldetail b','a.voucher = b.voucher');
							//->get('db_glheader a')->result();  
							
		 parent::before_fetch();	

	}	

}