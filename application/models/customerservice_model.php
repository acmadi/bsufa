<?php
class customerservice_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_cs a','id_cs');
		$this->set_join('db_customer b','b.customer_id = a.id_customer','left');
		$this->set_join('db_cstipe c','a.id_cstipe = c.cstipe_id','left');
		$this->set_join('db_csdesc d','a.id_csdesc = d.csdesc_id','left');
		
		
		
		#jhh$this->set_join('db_custemrg','db_customer.customer_id = db_custemrg.id_customer');
	}
	
	function before_fetch(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();	
		$attribute = $session_id['id_attr']; 
		
		$this->db->select('id_cs,customer_nama,customer_hp,cstipe_nm,csdesc_nm,tgl_complaint,note,flag_id');
		$user = $session_id['id'];
			
		#$this->db->where('id_flag',2);
		#S$this->db->like('attribute',$attribute,'after');
		parent::before_fetch();
		
	}
	
	function customerservice($id){
		
			
			
			$this->db->join('db_customer','id_customer = customer_id','left');
			$this->db->join('db_kota','id_kota = kota_id','left');
			$this->db->join('db_cstipe','id_cstipe = cstipe_id','left');
			$this->db->join('db_csdesc','id_csdesc = csdesc_id','left');
			$this->db->join('db_divisi','divisi_id = id_disdivisi','left');
			$this->db->join('db_subproject','id_subproject = subproject_id','left');
			
			$this->db->where('id_cs',$id);
			return $this->db->get('db_cs')->row_array();
	
	}
	
	function followup($id){
		
		
		$this->db->join('db_csfollowup','db_csfollowup.id_customer  = db_cs.id_customer','left');
		$this->db->join('db_fumedia','followup_media = fumedia_id','left');
		$this->db->join('db_csfustat','csfustat_id = flag_id','left');
		$this->db->where('id_cs',$id);
		$this->db->order_by('followup_id','desc');
		return $this->db->get('db_cs')->row_array();
		
	}
	
	
	
}


