<?php
	class claim_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_kontrak a','id_kontrak');
			$this->set_join('db_tendeva b','b.id_tendeva = a.id_tendeva');
			$this->set_join('db_mainjob c','c.mainjob_id = b.id_mainjob');
			$this->set_join('pemasok f','f.kd_supp_gb = b.id_vendor');
			//$this->set_join('db_subproject g','g.subproject_id = c.id_subproject');			
		}
		
		function before_fetch(){
			$project = array('41012','41011','1');
			$this->db->select('telepon,sign_1,sign_2,sign1_level,sign2_level,
			c.mainjob_total,c.mainjob_desc,b.no_tendeva,a.id_flag,a.id_kontrak,a.currency,
			a.no_spk,a.no_kontrak,f.kontak,f.nm_supplier,f.alamat,b.job,a.start_date,a.end_date,
			a.contract_amount,c.no_trbgtproj,isnull(a.id_lunas,0) as lunas');
			//$this->db->group_by('b.no_tendeva,a.id_flag,a.id_kontrak,no_spk,progress_amount,dp_amount,no_kontrak,a.pph_amount,nm_supplier,job,start_date,end_date,kontak,currency,alamat,contract_amount');
			$this->db->where('isnull(a.id_flag,0) >=',1); 
			$this->db->where_in('f.kd_project',$project );
			parent::before_fetch();
		}

	}



