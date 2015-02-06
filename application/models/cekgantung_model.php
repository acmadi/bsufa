<?php
	class cekgantung_model extends DBModel{
		
		function __construct(){ 	
			parent::__construct('view_bankpayment','id_plan');
			
		}
		
		function before_fetch(){
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];

			$status = 5;
			$this->db->where_in('status',$status);
			$this->db->where('pt_project',$pt);
			
			parent::before_fetch();
		}

	}



