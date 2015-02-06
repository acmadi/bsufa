<?php
	class barangmasuk_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_barangpoh a','BrgPOH_ID');
			$this->set_join('db_pr b','a.id_pr = b.id_pr');
		}
		
		function before_fetch(){
			$this->db->select('BrgPOH_ID,reff_pr,no_po,tgl_po,kirm_tgl,divisi_nm,
							   ket_po,nm_supp,up_supp,status_pr,a.id_pr,almt_supp,
							   kota_supp,matauang,telp_supp,fax_supp');
			
			parent::before_fetch();
		}
		
		
	}



