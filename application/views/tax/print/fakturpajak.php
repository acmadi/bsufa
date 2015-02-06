<?php
class fakturpajak extends DBController{
	function __construct(){
		parent::__construct('fakturpajak_model');
		$this->set_page_title('List Faktur Pajak');
		$this->template_dir = 'tax/fakturpajak';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
	
	}


	protected function setup_form($data=false){
		
									
	}

	function get_json(){
		#$this->set_custom_function('jml_byr','currency');
		parent::get_json();
	}



	function index(){
		$this->set_grid_column('id_fakturpajak','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('no_ap','AP No',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('no_fakturpajak','Tax no',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('nilai_fakturpajak','Tax Amount',array('width'=>30,'align'=>'center'));
		#$this->set_grid_column('doc_path','Document',array('width'=>30,'align'=>'center','formatter' => 'link');
		$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'List Faktur Pajak','rownumbers'=>true,'sortname'=>'id_fakturpajak','sortorder'=>'desc'));
	parent::index();
	}
	
	function nong($id){
		die($id);
	}
}

