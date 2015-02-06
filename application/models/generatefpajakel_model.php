<?php
class generatefpajakel_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_invoice','id_invoice');
		$this->set_join('db_loo_sewa','db_loo_sewa.kd_tenant = db_invoice.kd_tenant','left');
		$this->set_join('db_customer','db_customer.customer_id = db_loo_sewa.id_customer','left');
		$this->set_join('project','db_invoice.id_subproject = project.kd_project','left');
		$this->set_join('db_fakturpajak','no_ap = no_invoice','left');
		
		//bikin view atau join
		
		
	}
	
	function before_fetch(){
		$idPt 	= $this->session->userdata('sesspt'); 
		$idProject	= $this->session->userdata('sessproject');
	
		$start 		= $this->session->userdata('sessstart');
		$end		= $this->session->userdata('sessend');
	
		$s = inggris_date($start);
		$e = inggris_date($end);
		/*
		$ap = "	select * from 
				db_apinvoice 
				left join db_fakturpajak on no_ap = db_apinvoice.doc_no
				where dpp_ppn IS NOT NULL and project_no = ".$idProject.
				" order by apinvoice_id desc"; 
		
		$this->db->query($ap)->result();
		//var_dump($ini);exit;
		*/
		$this->db->select("id_invoice,nm_project,no_fakturpajak,date_fakturpajak,ttd_fakturpajak,db_invoice.id_subproject, no_invoice,trx_amount,tax_amount,customer_nama");
		#$this->db->where('id_pt', $idPt);
		$this->db->where('db_invoice.id_subproject', $idProject);
		$this->db->where('db_invoice.tgl_payment is not null');
		$this->db->where('db_invoice.id_flag', 1);
		$this->db->where("tgl_invoice BETWEEN '$s' AND '$e'", NULL, FALSE); 
		parent::before_fetch();
		
	
	}


}
