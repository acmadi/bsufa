<?php
class spcustomer_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_sp a','a.sp_id');
		$this->set_join('db_customer b','a.id_customer = b.customer_id');
		$this->set_join('db_subproject c','a.id_subproject = c.subproject_id');
		$this->set_join('db_paytipe d','a.id_paytipe = d.paytipe_id');	
		//$this->set_join('db_unit_yogya e','a.id_unit = e.unit_id');		
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		
		if($pt == 44){
		$this->set_join('db_unit_yogya e','a.id_unit = e.unit_id');	
		//$this->set_join('db_unit_yogya g','a.id_subproject = e.id_subproject');	
		}if($pt == 11){
		$this->set_join('db_unit_bdm e','a.id_unit = e.unit_id');	
		//$this->set_join('db_unit_bdm f','a.id_subproject = e.id_subproject');	
		}if($pt == 22){
		$this->set_join('db_unit_bdm e','a.id_unit = e.unit_id');	
		//$this->set_join('db_unit_bdm f','a.id_subproject = e.id_subproject');	
		}if($pt == 66){
		$this->set_join('db_unit_bdm e','a.id_unit = e.unit_id');	
		//$this->set_join('db_unit_bdm f','a.id_subproject = e.id_subproject');	
		}
		
	}
	
	function before_fetch(){
	  /*$CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();
		$pt = $session_id['id_pt'];		
		$this->db->where('db_denda.id_pt',$pt);*/
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
	
		
		$this->db->select('sp_id,tgl_sales,no_sp,nm_subproject,
		customer_nama,paytipe_nm,pl,dp,bf,unit_no')
				->where('a.id_flag',1)
				->where('c.pt_id',$pt)
				->group_by('sp_id,tgl_sales,no_sp,nm_subproject,
		customer_nama,paytipe_nm,pl,dp,bf,unit_no') ;
		parent::before_fetch();
	
		
	}
	

	protected function filter_field($field){
		if($field == 'customer_nama'){
			$this->join_on_count = true;
		}elseif($field == 'nm_subproject'){
			$this->join_on_count = true;
		}elseif($field == 'paytipe_nm'){
			$this->join_on_count = true;
		}elseif($field == 'unit_no'){
			$this->join_on_count = true;
		}
		return $field;
	}
	
		
	function joinall($id){
			$this->db->where('customer_id',$id);
			return $this->db->get('db_customer')->row_array();
	
	}
	
	function additional($id){	
			$this->db->join('db_bisnis','id_bisnis = bisnis_id','left');
			$this->db->join('db_customer','id_customer = customer_id','left');
			$this->db->join('db_kota','id_kota1 = kota_id','left');
			$this->db->join('db_propinsi','id_propinsi1 = propinsi_id','left');
			$this->db->join('db_negara','id_negara1 = negara_id','left');
			
			
			$this->db->where('id_customer',$id);
			return $this->db->get('db_custcomp')->row();
			
	}
	
	
	
	
	
	
	
}


