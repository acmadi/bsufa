<?php
	class prmonitoring extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('prmonitoring_model');
			$this->set_page_title('Purchase Request Monitoring');
			$this->default_limit = 50;
			$this->template_dir = 'procurement/prmonitoring';
			$session_id = $this->UserLogin->isLogin();
			$this->users = $session_id['username'];
		}
		
		protected function setup_form($data=false){
		}
		
		function get_json(){
		$this->set_custom_function('tgl_pr','indo_date');
		$this->set_custom_function('tgl_aproval','indo_date');
		//$this->set_custom_function('kwitansi_jml','currency');
		parent::get_json();
		}		
		function index(){
			$this->set_grid_column('id_pr','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_pr','No.PR',array('width'=>20,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_pr','Tgl.PR',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>20,'formatter' => 'cellColumn'));
			$this->set_grid_column('req_pr','Requestor',array('width'=>15,'align'=>'center','formatter' => 'cellColumn'));
			$this->set_grid_column('ket_pr','Keterangan',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('status_pr','Status',array('width'=>15,'align'=>'center','formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>375,'caption'=>'Purchase Request Monitoring','rownumbers'=>true));
			if($this->users!="")parent::index();
			else die("The Page Not Found");
		}
		
		function view($id){
			//die($id);
		}		
		
		function printprpen($id){
			#die($id);
			$data['id'] = $id;
			$this->load->view('procurement/print/print_prequisition',$data);
		}
		
	
	}

