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


<?php
	/*
	class masterVendor_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('pemasokmaster a','a.kd_supplier');
		}
		
		function nama_supp(){
			$this->db->order_by('nm_supplier','ASC');
			return $this->db->get('PemasokMaster')->result();
		}
		protected function before_fetch(){
			$session_id = $this->UserLogin->isLogin();
			$this->pt = $session_id['id_pt'];
			$this->db->select('a.kd_supplier as kd_supplier,a.nm_supplier as nm_supplier,
			a.alamat as alamat,a.kdkel_usaha as kdkel_usaha');
			/*$this->db->select('pemasokmaster.kd_supplier as kd_supplier,
			db_subproject.nm_subproject as nm_project,pemasokmaster.nm_supplier as nm_supplier,
			pemasokmaster.alamat as alamat,pemasokmaster.kota as kota,pemasok.kdkel_usaha as kdkel_usaha,
			pemasokmaster.telepon as telepon,pemasokmaster.fax as fax');
			$this->db->join('pemasok','pemasok.kd_supp_gb = pemasokmaster.kd_supp_gb');
			$this->db->join('db_subproject','pemasok.kd_project = db_subproject.subproject_id');
			$this->db->where('id_pt',$this->pt);
			$this->db->order_by('pemasokmaster.nm_supplier','ASC');
			$this->db->group_by('pemasokmaster.kd_supplier,pemasokmaster.nm_supplier,db_subproject.nm_subproject,pemasokmaster.alamat,
			pemasokmaster.kota,pemasok.kdkel_usaha,pemasokmaster.telepon,pemasokmaster.fax');*/
		/*
			parent::before_fetch();
		}
	}
	*/
?>
