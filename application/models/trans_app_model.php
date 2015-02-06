<?php
class trans_app_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('history_form_print','id_hstprint');
		$this->set_join('db_trbgtdiv','form_kode = kode_form');
		//$this->set_join('db_trbgtdiv','id_trbgt = id_field');
		//$this->set_join('db_mstbgt','code = kodebgt');
	}
	
	protected function before_fetch(){
	    $CI =& get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();
		$divisi = $session_id['divisi_id'];		
		$level = $session_id['level_id'];
		$parent = $session_id['id_parent'];	
		if ($parent == '1203'){
//die("elite");
		$this->db->where('id_parent',$parent);
		
	}else{
	//	die("bsu");
		$this->db->where('form_id',2);
		$this->db->where('divisi_id',$divisi);
		//$this->db->where('isnull(flag_id,0) !=',10);
		$this->db->where('flag_id !=',10);
		
	}
		//$this->db->where('divisi_id',$divisi);
		/*$this->db->select('id_trbgt,db_divisi.divisi_nm,db_trbgtdiv.flag_id as flag_id,descbgt
		,remark,amount,tanggal,appamount,apptanggal,db_trbgtdiv.divisi_id as divisi_id,code_id');
		$this->db->join('db_mstbgt','code = code_id');
		$this->db->join('db_divisi', 'db_divisi.divisi_id = db_mstbgt.divisi_id');
		
		$this->db->where('db_trbgtdiv.flag_id',1);
		if($level != 1){
			$this->db->where('db_trbgtdiv.divisi_id',$divisi);
		}
		
		$this->db->order_by('tanggal','desc');*/
		parent::before_fetch();
	}
	
		/*function count_rows(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$divisi = $session_id['divisi_id'];
			$level = $session_id['level_id'];
			if($level != 1){
				$this->db->where('db_trbgtdiv.divisi_id',$divisi);
			}
			return parent::count_rows();
		}*/

	
	
}
