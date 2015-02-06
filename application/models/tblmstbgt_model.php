<?php
	class tblmstbgt_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_mstbgt','id_mst');
		}
		
		protected function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$id =  $session_id['id'];
			$lvl = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			$this->db->select('*,FORMAT(bgt1,0) as bgt1,
								FORMAT(bgt2,0) as bgt2,
								FORMAT(bgt3,0) as bgt3,
								FORMAT(bgt4,0) as bgt4,
								FORMAT(bgt5,0) as bgt5,
								FORMAT(bgt6,0) as bgt6,
								FORMAT(bgt7,0) as bgt7,
								FORMAT(bgt8,0) as bgt8,
								FORMAT(bgt9,0) as bgt9,
								FORMAT(bgt10,0) as bgt10,
								FORMAT(bgt11,0) as bgt11,
								FORMAT(bgt12,0) as bgt12,
								FORMAT(tot_mst,0) as tot_mst');
			
			
			
			if($lvl==1){
				$this->db->where('id_pt',$pt);
			}else{
				$this->db->where('user_id',$id);
			}
			parent::before_fetch();
		}
		
		protected function filter_field($field){
			if($field == 'bgt1'){
				$field = "FORMAT(bgt1,0)";
			}
			elseif($field == 'bgt2'){
				$field = "FORMAT(bgt2,0)";
			}
			elseif($field == 'bgt3'){
				$field = "FORMAT(bgt3,0)";
			}
			
			elseif($field == 'bgt4'){
				$field = "FORMAT(bgt4,0)";
			}
			
			elseif($field == 'bgt5'){
				$field = "FORMAT(bgt5,0)";
			}
			
			elseif($field == 'bgt6'){
				$field = "FORMAT(bgt6,0)";
			}
			
			elseif($field == 'bgt7'){
				$field = "FORMAT(bgt7,0)";
			}
			
			elseif($field == 'bgt8'){
				$field = "FORMAT(bgt8,0)";
			}
			
			elseif($field == 'bgt9'){
				$field = "FORMAT(bgt9,0)";
			}
			
			elseif($field == 'bgt10'){
				$field = "FORMAT(bgt10,0)";
			}
			
			elseif($field == 'bgt11'){
				$field = "FORMAT(bgt11,0)";
			}
			
			elseif($field == 'bgt12'){
				$field = "FORMAT(bgt12,0)";
				
			}
			elseif($field == 'tot_mst'){
				$field = "FORMAT(tot_mst,0)";
			}
			
			
		}
		
	}
?>
