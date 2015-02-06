<?php
	class mstbgtadj_model extends DBModel{
		function __construct(){ 
			parent::__construct('db_mstbgtadj','id_mstadj');
		}
		
		function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$pt = $session_id['id_pt'];
			#$this->db->order_by('id_mstadj','DESC');
			$this->db->where('id_pt',$pt);
			$this->db->join('db_mstbgt','codeadj = code');
			parent::before_fetch();
		}	
		protected function filter_field($field){
			if($field == 'descbgt'){
				$this->join_on_count = true;
			}
			return $field;
		}

	}
?>
