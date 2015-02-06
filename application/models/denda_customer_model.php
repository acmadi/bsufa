<?php
class denda_customer_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_denda','denda_id');
		$this->set_join('db_custprofil','customer_id = id_customer');
		$this->set_join('db_subproject','db_subproject.subproject_id = db_denda.id_project');
	}
	
	function before_fetch(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();
		$pt = $session_id['id_pt'];		
		$this->db->select('denda_id,denda_periode,customer_nama,nm_subproject
		as nm_project,denda_tglmulai,DATEADD(month,denda_top,denda_tglmulai) as denda_tglakhir,
		denda_top,denda_nilai,denda_paid,(denda_nilai - denda_paid) as denda_balance,denda_persentase');
		$this->db->where('db_denda.id_pt',$pt);
		parent::before_fetch();
	}
	
	function count_rows(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();
		$pt = $session_id['id_pt'];		
		$this->db->where('db_denda.id_pt',$pt);
		return parent::count_rows();
	}
	
	protected function filter_field($field){
		if($field == 'customer_nama'){
			$this->join_on_count = true;
		}else if($field == 'divisi_nm'){
			$this->join_on_count = true;
		}else if($field == 'flowapp_nm'){
				$this->join_on_count = true;
		}
			return $field;
	}

}

