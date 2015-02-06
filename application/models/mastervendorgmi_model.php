<?php
	class masterVendorgmi_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');
			parent::__construct('pemasokmaster','pemasokmaster.kd_supplier');
		}
		
		function nama_supp(){
			$this->db->order_by('PemasokMaster.nm_supplier','ASC');
			return $this->db->get('PemasokMaster')->result();
		}
		protected function before_fetch(){
			$session_id = $this->UserLogin->isLogin();
			$this->pt = $session_id['id_pt'];
			$this->db->select('pemasokmaster.kd_supplier as kd_supplier,
			db_subproject.nm_subproject as nm_project,pemasokmaster.nm_supplier as nm_supplier,
			pemasokmaster.alamat as alamat,pemasokmaster.kota as kota,pemasokmaster.supp_code as supp_code,pemasokmaster.kdkel_usaha as kdkel_usaha,
			pemasokmaster.telepon as telepon,pemasokmaster.fax as fax');
			$this->db->join('pemasok','pemasok.kd_supp_gb = pemasokmaster.kd_supp_gb');
			$this->db->join('db_subproject','pemasok.kd_project = db_subproject.subproject_id');
			$this->db->where('id_pt',$this->pt);
			$this->db->order_by('pemasokmaster.nm_supplier','ASC');
			$this->db->group_by('pemasokmaster.kd_supplier,pemasokmaster.supp_code,pemasokmaster.nm_supplier,db_subproject.nm_subproject,pemasokmaster.alamat,
			pemasokmaster.kota,pemasokmaster.kdkel_usaha,pemasokmaster.telepon,pemasokmaster.fax');
			parent::before_fetch();
		}
		
		protected function filter_field($field){
		/*if($field=='nm_supplier'){
		$f = "pemasokmaster.".$field;
		}elseif($field=='nm_project'){
		$f = "db_subproject.nm_subproject";
		}else{*/
		$f = "pemasokmaster.".$field;
		// }
		if($f == 'pemasokmaster.nm_supplier'){
			$this->join_on_count = true;
			}
		elseif($f== 'unit_no'){
			$this->join_on_count = true;
			}
		return $f;
		}	
	}
?>
