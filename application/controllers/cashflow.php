<?php
	class cashflow extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct();
			$this->template_dir = 'cb/cashflow';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->id_pt = $session_id['id_pt'];
			
		}
		
		function index(){
			/* judul cash flow per project */
			$qry_cf = "select * from cash_proj where kd_project = 11101 order by kodecash asc";
			$data['judulcf'] = $this->db->query($qry_cf)->result();
			
			/* bank per project */
			$qry_bank = "select * from db_bank where id_subproject = 11101 order by bank_id asc";
			$data['bankcf'] = $this->db->query($qry_bank)->result();
			
			$this->load->view('cb/cashflow-view',$data);
		}	
			
		
	
	}

