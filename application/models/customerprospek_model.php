<?php
class customerprospek_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_customer','customer_id');
		$this->set_join('db_custcomp','customer_id = id_customer','left');
		$this->set_join('db_subproject','subproject = subproject_id','left');
		$this->set_join('db_kary','sales = id_kary','left');
		
		
		
		#jhh$this->set_join('db_custemrg','db_customer.customer_id = db_custemrg.id_customer');
	}
	
	function before_fetch(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();	
		$attribute = $session_id['id_attr']; 
		
		$this->db->select('customer_id,regdate,venue,customer_nama,customer_hp,nm_subproject,fu_stat,nama');
		$user = $session_id['id'];
			
		$this->db->where('db_customer.id_flag',2);
		$this->db->like('attribute',$attribute,'after');
		parent::before_fetch();
		
	}
	
	function joinall($id){
			
			
			$this->db->join('db_filter','filter_id = id_filter','left');
			$this->db->join('db_negara','negara_id = id_negara','left');
			$this->db->join('db_propinsi','propinsi_id = id_propinsi','left');
			$this->db->join('db_etnis','etnis_id = id_etnis','left');
			$this->db->join('db_motivie','motivie_id = id_motivie','left');
			$this->db->join('db_tipemedia','tipemedia_id = id_tipemedia','left');
			$this->db->join('db_media','media_id = id_media','left');
			$this->db->join('db_profesi','profesi_id = id_profesi','left');
			$this->db->join('db_group','group_id = id_group','left');
			$this->db->join('db_kota','customer_tmpt_lhr = kota_id','left');
			$this->db->join('db_agama','id_agama = agama_id','left');
			$this->db->where('customer_id',$id);
			return $this->db->get('db_customer')->row_array();
	
	}
	
	function additional($id){
			
			
			$this->db->join('db_kary','id_kary = sales','left');
			$this->db->join('db_bisnis','id_bisnis = bisnis_id','left');
			$this->db->join('db_customer','id_customer = customer_id','left');
			$this->db->join('db_kota','id_kota1 = kota_id','left');
			$this->db->join('db_propinsi','id_propinsi1 = propinsi_id','left');
			$this->db->join('db_negara','id_negara1 = negara_id','left');
			
			
			$this->db->where('id_customer',$id);
			return $this->db->get('db_custcomp')->row();
			
	}
	
	function mod($id){
			
			
			$this->db->join('db_kary','id_kary = mod','left');
			$this->db->join('db_subproject','subproject_id = subproject','left');		
			$this->db->where('id_customer',$id);
			return $this->db->get('db_custcomp')->row();
			
	}
	
	function followup($id){
		
		
		$this->db->join('db_custcomp','customer_id = id_customer','left');
		$this->db->join('db_prospectstat','prospectstat_id = fu_stat','left');
		$this->db->join('db_followup','db_followup.id_customer = db_customer.customer_id','left');
		$this->db->join('db_fumedia','followup_media = fumedia_id','left');
		$this->db->where('customer_id',$id);
		$this->db->order_by('followup_id','desc');
		return $this->db->get('db_customer')->row_array();
		
		
	
		
				
		}
	function sales(){
		$session_id = $this->UserLogin->isLogin();
		$idattr =  $session_id['id_attr'];
		
		
		$this->db->where('attr_id',$idattr);
		return $this->db->get('db_kary')->row();
		
		}
	
	
	
	
	
}


