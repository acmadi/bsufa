<?php
	class workinginstapp extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('workinginst_model');
			$this->set_page_title('Working Instruction');
			$this->default_limit = 30;
			$this->template_dir = 'project/workinginstapp';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['tender'] = $this->db->select('id_tendeva,no_tendeva')
													   ->where('isnull(flag_id,0)','1')
													   ->get('db_tendeva')->result();								
		}				
		
		function index(){
			$this->set_grid_column('id_kontrak','id',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_spk','Budget Reff',array('width'=>60));
			$this->set_grid_column('no_kontrak','Contract.No',array('width'=>40));
			$this->set_grid_column('nm_subproject','Project',array('width'=>30));
			$this->set_grid_column('vendor_nm','Contractor',array('width'=>30));
			$this->set_grid_column('job','Job',array('width'=>30));
			$this->set_grid_column('start_date','Start Date',array('width'=>30));
			$this->set_grid_column('end_date','End Date',array('width'=>30));
			$this->set_grid_column('contract_amount','Contract Amount',array('width'=>30));
			$this->set_grid_column('','Addendum',array('width'=>30));
			$this->set_grid_column('','Deduction',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Working Instruction','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
	

		
		function save(){
			extract(PopulateForm());
			$data = array 
			(
				'flag_id' => 1
			);
			$this->db->where('id_kontrak',$id_kontrak);
			$this->db->update('db_kontrak',$data);

		}
		
	
	}

