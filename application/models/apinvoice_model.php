<?php
	class apinvoice_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_apinvoice a','apinvoice_id');
			 $this->set_join('pemasokmaster c','a.vendor_acct = c.kd_supplier ');
			$this->set_join('project f','a.project_no = f.kd_project');		
		}		
		
		function before_fetch(){
		$session_id = $this->UserLogin->isLogin();
			
		$pt = $session_id['id_pt'];

		$q = $this->db->query("select * from db_subproject where id_pt = ".$pt." ")->result();
		foreach ($q as $row) {
			$project[] = $row->subproject_id;
		}
		$this->db->select('a.apinvoice_id as apinvoice_id,a.doc_no as doc_no,a.doc_date as doc_date,a.status as status,
		a.inv_no as inv_no,a.inv_date as inv_date,c.nm_supplier as nm_supplier,a.descs as descs,a.base_amt as base_amt');
		//$this->db->where_in('a.project_no',$project );
		$this->db->where_in('f.pt_project',$pt );
		parent::before_fetch();
	}
	
		protected function filter_field($field){
		if($field == 'nm_supplier'){
			$this->join_on_count = true;
		}elseif($field == 'doc_no'){
			$this->join_on_count = true;
		}		return $field;
	}	
	
	}
	
/*
<?php
	class apinvoice_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_apinvoice a','apinvoice_id');	
			$this->set_join('db_apinvoicedet b','b.doc_no = a.doc_no','left');
			 $this->set_join('pemasok c','a.vendor_acct = c.kd_supp_gb ','left');
			 $this->set_join('db_apjurnal d','d.voucher =a.doc_no','left');
			 $this->set_join('db_apinvoiceoth e','e.doc_no =a.doc_no','left');
			$this->set_join('db_subproject f','a.project_no =f.id_project','left');		
		}		
		
		function before_fetch(){
		$session_id = $this->UserLogin->isLogin();
			
			$pt = $session_id['id_pt'];
			
		$project = array('41012','41011','1','41013');
		$this->db->select("apinvoice_id,a.doc_no as doc_no,a.project_no, a.pph as percent_pph, a.cr_term,  a.ref_no,trx_type,po_no,vendor_name, category, total, paid, balance, ppn, b.pph, convert(varchar(12), due_date, 105) as due_date, 
		isnull(convert(varchar(12), doc_date, 105),'-') as doc_date,inv_no,isnull(convert(varchar(12), inv_date, 105),'-') as inv_date,vendor_acct,a.descs,convert(varchar,CONVERT(money, a.base_amt),1) as base_amt , a.status, nm_supplier, convert(varchar,CONVERT(money, d.debet),1) as debet, convert(varchar,CONVERT(money, d.credit),1) as credit")	
		 ->group_by('apinvoice_id,a.doc_no,a.project_no, a.pph, a.cr_term, a.ref_no, trx_type,po_no,vendor_name, category, total, paid, balance, ppn, b.pph, due_date, 
		doc_date,inv_no, inv_date,vendor_acct,a.descs,a.base_amt, a.status, nm_supplier,d.debet,d.credit');
		if($pt == '11' ){
		$this->db->where('f.id_pt !=',$pt );
		}else{
			$this->db->where_in('c.kd_project',$project );
		}
		
		parent::before_fetch();
	}
	
		protected function filter_field($field){
		if($field == 'nm_supplier'){
			$this->join_on_count = true;
		}elseif($field == 'doc_no'){
			$this->join_on_count = true;
		}		return $field;
	}	
	
	}
?>
*/
?>
