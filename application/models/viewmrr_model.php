<?php
	class viewmrr_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_barangpomsk a','a.BrgMsk_ID');
			$this->set_join('db_barangpoh b','b.BrgPOH_ID = a.BrgPOH_ID');
			// $this->set_join('db_pr c','c.id_pr = b.id_pr');
			
		}
		
		function before_fetch(){
			$this->db->select('a.BrgPOH_ID,a.BrgMsk_ID,b.no_po,a.no_mrr,a.tgl_mrr,nm_brg,qtyPO,qtyMsk');
			// $this->db->join('db_barangpoh b','b.brgpoh_id = a.brgpoh_id','left')
					   // ->join('db_pr c','c.id_pr = b.id_pr','left');
			parent::before_fetch();
		}
		
		
	}



