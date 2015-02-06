<?php
class generatefpajak_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_apinvoice','apinvoice_id');
		$this->set_join('db_fakturpajak','no_ap = doc_no','left');
		$this->set_join('pemasokmaster','vendor_acct = kd_supplier','left');

		
		//bikin view atau join
		
		
	}
	
	function before_fetch(){
		$idPt 	= $this->session->userdata('sesspt'); 
		$idProject	= $this->session->userdata('sessproject');
	
		$start 		= $this->session->userdata('sessstart');
		$end		= $this->session->userdata('sessend');
		//die($idPt." ".$idProject." ".$start." ".$end);
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
		$this->db->select("apinvoice_id,no_fakturpajak,date_fakturpajak,ttd_fakturpajak,doc_no,nm_supplier,npwp,dpp_ppn,(dpp_ppn * 10)/100 ppn");
		#$this->db->where('id_pt', $idPt);
		$this->db->where('dpp_ppn is not null');
		#$this->db->where('db_apinvoice.status', 2);
		$this->db->where('project_no', $idProject);
		 $this->db->where("inv_date BETWEEN '".$s."' AND '".$e."'"); 
		parent::before_fetch();
		
	
	}


}
