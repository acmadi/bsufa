<?php
	class purchase_order extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('purchase_order_model');
			$this->set_page_title('Purchase Request Monitoring');
			$this->default_limit = 50;
			$this->template_dir = 'procurement/purchase_order';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
		}
		
		function index(){
			$this->set_grid_column('id_pr','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('','No.PO',array('width'=>20));
			$this->set_grid_column('','Tgl.PR',array('width'=>30));
			$this->set_grid_column('','Kirim Tgl.',array('width'=>20));
			$this->set_grid_column('','Batal',array('width'=>15,'align'=>'center'));
			$this->set_grid_column('','Divisi',array('width'=>30));
			$this->set_grid_column('','Reff PR#',array('width'=>30));
			$this->set_grid_column('','Keterangan',array('width'=>30));
			$this->set_grid_column('','Supplier',array('width'=>30));
			$this->set_grid_column('','PIC Supplier',array('width'=>30));
			$this->set_grid_column('','Total',array('width'=>15,'align'=>'center'));
			$this->set_grid_column('','RP/$',array('width'=>30));
			$this->set_grid_column('','Kurs',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'Purchase Request Monitoring','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		function view($id){
			//die($id);
		}		
		
	
	}

