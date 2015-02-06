<?php
	class mstbgtproj extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterVendor_model');
			$this->set_page_title('Master Project');
			$this->default_limit = 30;
			$this->template_dir = 'project/masterproj';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['lastid'] = $this->mstmodel->get_lastid("kd_supplier","pemasokmaster");
			$this->load->model('project_model','kdproj');
			$this->parameters['kd_project'] = $this->kdproj->project();
			$this->load->model('masterVendor_model','kdsup');
			$this->parameters['nm_supplier']=$this->kdsup->nama_supp();
		}
		
		function index(){
			$this->set_grid_column('','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('','Project Name',array('width'=>60));
			$this->set_grid_column('','Total Budget',array('width'=>40));
			$this->set_grid_column('','Start Date',array('width'=>30));
			$this->set_grid_column('','End Date',array('width'=>30));
			$this->set_grid_column('','Land',array('width'=>30));
			$this->set_grid_column('','SGFA',array('width'=>30));
			$this->set_grid_column('','GBA',array('width'=>30));
			$this->set_grid_column('','Remarks',array('width'=>30));						
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Master Project','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
	
	}

