<?php

	Class printbgt_model extends Model{
		function __construct(){
			parent::Model();
		}
		
		function get_data($id){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$id =  $session_id['id'];
			$lvl = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			
			if($lvl==1){
				$this->db->where('id_pt',$pt);
			}else{
				$this->db->where('user_id',$id);
			}
			
			return $this->db->get('db_mstbgt')->result();
		}

	
	}
?>
