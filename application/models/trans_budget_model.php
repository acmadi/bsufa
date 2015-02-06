<?php
class trans_budget_model extends DBModel{
	
	
	function __construct(){ 
		parent::__construct('db_trbgtdiv','id_trbgt');
		#$this->set_join('db_mstbgt','code = code_id');
		#$this->set_join('db_divisi', 'db_divisi.divisi_id = db_mstbgt.divisi_id');
	}
	
	protected function before_fetch(){		
		$this->db->select('id_trbgt,form_kode, tanggal, description,amount,
		appamount,flag_id,divisi_id,code_id,status_bgt,remark,divthn');
		//$this->db->order_by('id_trbgt','desc');
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();
		$divisi = $session_id['divisi_id'];		
		$level = $session_id['level_id'];
		$pt = $session_id['id_pt'];
		$parent = $session_id['id_parent'];
		$group = $session_id['group_id'];
		#die($group);
		if($level == 3){
			//die("test");
			$this->db->where('db_trbgtdiv.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
		}elseif($parent == '5207'){
			//die("disini");
			$this->db->where('db_trbgtdiv.divisi_id',$divisi);		
			$this->db->where('db_trbgtdiv.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
		
		}elseif($parent == '5205'){
			//die("disini");
			$this->db->where('db_trbgtdiv.divisi_id',$divisi);		
			$this->db->where('db_trbgtdiv.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
		
		}elseif($group == '49'){
			$this->db->where('db_trbgtdiv.divisi_id',83);		
			#$this->db->where('db_trbgtdiv.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
		
		}else{
			//die("coba");
			$this->db->where('db_trbgtdiv.divisi_id',$divisi);		
			//$this->db->where('db_trbgtdivk.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);

		}
		parent::before_fetch();
	}
	
	function count_rows(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();
		$divisi = $session_id['divisi_id'];		
		$level = $session_id['level_id'];
		$pt = $session_id['id_pt'];
		$parent = $session_id['id_parent'];
		if($level == 3){
			$this->db->where('db_trbgtdiv.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
		}else{
			$this->db->where('db_trbgtdiv.divisi_id',$divisi);		
			$this->db->where('db_trbgtdiv.id_parent',$parent);
			$this->db->where('db_trbgtdiv.id_pt',$pt);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
		}		
		
		//$this->db->where('db_trbgtdiv.divisi_id',$divisi);
		/*if($level!=1) 
		{
			$this->db->where('db_trbgtdiv.divisi_id',$divisi);
		}
		else
		{
		$this->db->where('db_trbgtdiv.divisi_id',$divisi);	
		$this->db->where('db_trbgtdiv.flag_id',0);
		}*/
		return parent::count_rows();
	}
	
	protected function filter_field($field){
		if($field == 'descbgt'){
			$this->join_on_count = true;
		}
		return $field;
	}	
}
