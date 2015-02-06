<?php
	class mstbgtcurrent_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_mstbgt_update','id_mst');
		}


		protected function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$divisi = $session_id['divisi_id'];
			$id_parent = $session_id['id_parent'];
			//die($divisi);
			if ($id_parent == '1203' || $id_parent == '1201' || $id_parent == '1202'and $divisi == NULL){
			//die("disini");
			$this->db->where('id_parent',$id_parent);
					 
			}elseif ($id_parent == '5206' ){
			
			$this->db->where('id_parent',$id_parent);
			}
			
			elseif ($id_parent == '1204' and $divisi == NULL){
			//die("disini");exit();
			$this->db->where('id_parent',$id_parent);
					 
			}elseif($id_parent == '5206' and $pt == '55'){
			//die("ini");
			
			$this->db->where('id_parent',$id_parent);
				$this->db->where('divisi_id',$divisi);
			}
			
			else{
			//die("salah");
			$this->db->where('divisi_id',$divisi);
			}
			$this->db->order_by('code','asc');
			parent::before_fetch();
		}
		
		function count_rows(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$parent = $session_id['id_parent'];	
			$divisi = $session_id['divisi_id'];
			$lvl    = $session_id['level_id'];
			//die($lvl);
			
			if ($parent == '1203' || $parent == '1201' || $parent == '1202' and $divisi == NULL){
			//die("elite");
			$this->db->where('id_parent',$parent);
					 
			}elseif ($parent == '5206' ){
			
			$this->db->where('id_parent',$parent);
			}
			
			elseif ($parent == '1204' and $divisi == NULL){
			//die("pf");
			$this->db->where('id_parent',$parent);
					 
			}elseif($parent == '5206'  and $pt == '55'){
			//die("ini");
			
			$this->db->where('id_parent',$parent);
			$this->db->where('divisi_id',$divisi);
			
			}
			
			else{
			//die("bsu");
			$this->db->where('divisi_id',$divisi);
			}
			
			return parent::count_rows();
		}
		

		
	}
?>
