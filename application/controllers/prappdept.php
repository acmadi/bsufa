<?php
	class prverifikasi extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('prappdept_model');
			$this->set_page_title('PR Approval Dept Head');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/prverifikasi';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
		}
		
		function index(){
			$this->set_grid_column('','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('kd_supplier','No.PR',array('width'=>60));
			$this->set_grid_column('','Tgl.PR',array('width'=>40));
			$this->set_grid_column('','Divisi',array('width'=>30));
			$this->set_grid_column('','Requestor',array('width'=>30));
			$this->set_grid_column('','Keterangan',array('width'=>30));
			$this->set_grid_column('','Alasan',array('width'=>30));
			$this->set_grid_column('','Appr 1',array('width'=>30));
			$this->set_grid_column('','Appr 2',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Purchase Verification','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
	
	}

