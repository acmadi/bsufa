<?php
class frontoffice_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_fo ','fo_id');
		
		
		
		#jhh$this->set_join('db_custemrg','db_customer.customer_id = db_custemrg.id_customer');
	}
	
	function before_fetch(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();	
		$attribute = $session_id['id_attr']; 
		
		#$this->db->select('id_cs,customer_nama,customer_hp,cstipe_nm,csdesc_nm,tgl_complaint,note,flag_id');
		$user = $session_id['id'];
			
		#$this->db->where('id_flag',2);
		#S$this->db->like('attribute',$attribute,'after');
		parent::before_fetch();
		
	}
	
	
	
	
	
}


