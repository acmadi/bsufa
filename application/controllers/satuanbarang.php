<?php
	class satuanbrg extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('satuanbrg_model');
			$this->set_page_title('Satuan Barang');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/satuanbrg';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
		}
		
		function index(){
			$this->set_grid_column('','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('satuan','Satuan',array('width'=>60));
			$this->set_grid_column('pembagi','Remark',array('width'=>40));
			
			$this->set_jqgrid_options(array('width'=>800,'height'=>200,'caption'=>'Satuan Barang','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		function save(){
			extract(PopulateForm());
			$data = array 
			(
				'satuan' => $satuan,
				'pembagi' => $pembagi
			);
			
			$this->db->insert('satuan',$data);
			redirect("satuanbrg");
		}
			
	
	}

