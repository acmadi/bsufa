<?php
	class masterVendor_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('pemasok','kd_supplier');
		}
		
		function nama_supp(){
			$this->db->order_by('nm_supplier','ASC');
			return $this->db->get('PemasokMaster')->result();
		}
		protected function before_fetch(){
			$this->db->select('pemasok.kd_supplier as kd_supplier,
			project.nm_project as nm_project,pemasok.nm_supplier as nm_supplier,
			pemasok.alamat as alamat,pemasok.kota as kota,pemasok.kdkel_usaha as kdkel_usaha,
			pemasok.telepon as telepon,pemasok.fax as fax');
			$this->db->join('project','pemasok.kd_project = project.kd_project');
			$this->db->order_by('pemasok.nm_supplier','ASC');
			$this->db->group_by('pemasok.kd_supplier,pemasok.nm_supplier,project.nm_project,pemasok.alamat,
			pemasok.kota,pemasok.kdkel_usaha,pemasok.telepon,pemasok.fax');
			parent::before_fetch();
		}
	}
?>
