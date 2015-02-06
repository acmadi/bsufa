<?php
	class tblkarycuti_real_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_karycuti','karycuti_id');
			$this->set_join('db_kary','id_kary = kary_id');
			$this->set_join('db_divisi','divisi_id = id_divisi');
			$this->set_join('db_karycutijns','karycutijns_id = jns_cuti');
			$this->set_join('db_flowapp','id_flowapp = flowapp_id');
		}
		
		protected function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$level = $session_id['level_id'];
			$kary_id = 	$session_id['kary_id'];
			$divisi = $session_id['divisi_id'];
			$chief = $session_id['id_chief'];
			$this->db->select('karycuti_id,nama,divisi_nm,tgl_aju,aju_cuti,
			karycutijns_nm,flowapp_nm','startdate_cuti','enddate_cuti');
			$this->db->where('chief_id',$chief);			
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
		
		function jumlah_cuti($idkary){
			$this->db->select('sum(aju_cuti) as tes')
					  ->where('kary_id',$idkary)
					  ->get('db_karycuti')
					  ->row_array();
		}
		
				
		
		
		
		
	}
