<?php
	class cjc_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_cjc a','a.id_cjc');
			$this->set_join('db_kontrak b','a.id_kontrak = b.id_kontrak');
			$this->set_join('db_tendeva c','c.id_tendeva = b.id_tendeva');
			$this->set_join('db_mainjob d','d.mainjob_id = c.id_mainjob');
			$this->set_join('pemasokmaster e','e.kd_supp_gb = c.id_vendor');
			
		}
		
		function before_fetch(){
			$this->db->select('nm_supplier,b.job,id_cjc,date_cjc,no_kontrak,no_cjc,
				claim_amount,contract_amount,mainjob_desc,no_trbgtproj,a.pph,
				a.id_kontrak,remark,isnull(a.flag_id,0) as flag_id');
			//$this->db->where('isnull(a.id_flag,0)','1');
			parent::before_fetch();
		}
		
	}


