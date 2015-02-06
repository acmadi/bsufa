<?php
	class tbltrbgt_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_trbgtdiv','id_trbgt');
		}
		protected function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$id =  $session_id['id'];
			$lvl = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			$this->db->select('*,FORMAT(amount,0) as amount');
			$this->db->where('flag <>',1);
			
			if($lvl==1){
				$this->db->where('id_pt',$pt);
			}else{
				$this->db->where('user_id',$id);
			}
			parent::before_fetch();
		}
		
		/*protected function filter_field($field){
			if($field == 'amount'){
				$field = "FORMAT(amount,0)";
			}
		}*/
		
	}
?>
