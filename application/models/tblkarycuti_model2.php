<?php
	class tblkarycuti_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_karycuti','karycuti_id');
			$this->set_join('db_kary','id_kary = kary_id');
			$this->set_join('db_divisi','divisi_id = id_divisi');
			$this->set_join('db_karycutijns','karycutijns_id = jns_cuti');
			$this->set_join('db_flowapp','id_flowapp = flowapp_id ');
			
		}
		
		protected function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$divisi = $session_id['divisi_id'];	
			$this->db->select('karycuti_id,nama,divisi_nm,tgl_aju,aju_cuti,karycutijns_nm,flowapp_nm');
			if($divisi!=1){
				$this->db->where('id_divisi',$divisi);
			}
			parent::before_fetch();
		}
		
		
		protected function filter_field($field){
			if($field == 'nama'){
				$this->join_on_count = true;
			}else if($field == 'divisi_nm'){
				$this->join_on_count = true;
			}else if($field == 'flowapp_nm'){
				$this->join_on_count = true;
			}
			return $field;
		}
		
		function namadiv($divisi){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$divisi = $session_id['divisi_id'];	
			if($divisi == 1){
			$this->db->order_by('nama','asc');			 
			return $this->db->get('db_kary')->result();
			}
			else{
			$this->db->where('id_divisi',$divisi);
			$this->db->order_by('nama','asc');			 
			return $this->db->get('db_kary')->result();}
		}


		function karycutipar(){
			return $this->db->get('db_karycutipar')->row_array();
			
		}
		
		function approv_id(){
			$this->db->order_by('id_transaksi','DESC');
			return $this->db->get('db_approval')->row_array();
		}
		
		function flowapp(){
			$this->db->join('db_karylvl','karylvl_id = id_flowapp');
			return $this->db->get('db_flowapp')->result();
		}
		
		
		
		function joinall_table($id){
								
				
			$this->db->join('db_karycutipar','id_kary = kary_id');
			$this->db->join('db_kary','db_kary.id_kary = db_karycuti.kary_id');
			$this->db->join('db_karycutijns','karycutijns_id = jns_cuti');
			$this->db->join('db_karyjab','karyjab_id = id_karyjab');
			$this->db->join('db_karycutials','karycutials_id = id_karycutials');
			$this->db->where('karycuti_id',$id);
			return $this->db->get('db_karycuti')->row_array();
		
					
		}
		
		function jumlah_cuti($idkary){
			$this->db->select('sum(aju_cuti) as tes')
					  ->where('kary_id',$idkary)
					  ->get('db_karycuti')
					  ->row_array();
		}
		
		
		function viewkary($id){
								
			$this->db->join('db_karycutipar','id_kary = kary_id');
			$this->db->join('db_kary','db_kary.id_kary = db_karycuti.kary_id');
			$this->db->join('db_divisi','db_divisi.divisi_id = db_karycuti.id_divisi');
			$this->db->join('db_karycutijns','karycutijns_id = jns_cuti');
			$this->db->join('db_karycutials','karycutials_id = id_karycutials');
			$this->db->join('db_karyjab','karyjab_id = id_karyjab');
			$this->db->where('transaksi_id',$id);
			return $this->db->get('db_karycuti')->row_array();
		}
				
		
		
		
		
	}
?>
