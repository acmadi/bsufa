<?php
	class adendum extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('adendum_model');
			$this->set_page_title('Update Project Budget');
			$this->default_limit = 30;
			$this->template_dir = 'project/adendum';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['job'] = $this->db->where('id_kontrak',@$data->id_kontrak)
												->get('db_detailjob')->result();
		}
		
		function index(){
			$this->set_grid_column('id_kontrak','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_spk','SPK.No',array('width'=>60));
			$this->set_grid_column('no_kontrak','Contract.No',array('width'=>40));
			$this->set_grid_column('','Project',array('width'=>30));
			$this->set_grid_column('','Contractor',array('width'=>30));
			$this->set_grid_column('','Job',array('width'=>30));
			$this->set_grid_column('start_date','Start Date',array('width'=>30));
			$this->set_grid_column('end_date','End Date',array('width'=>30));
			$this->set_grid_column('contract_amount','Contract Amount',array('width'=>30));
			$this->set_grid_column('','Adendum',array('width'=>30));
			$this->set_grid_column('','Deduction',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Update Project','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
	
	}

