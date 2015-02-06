<?php
class generateespt extends DBController{
	function __construct(){
		parent::__construct();

		$this->template_dir = 'tax/generateespt';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
		
	}


	protected function setup_form($data=false){
		$this->parameters['pt'] = $this->db->query("select * from pt")->result();
	}

	function get_json(){
		$this->set_custom_function('trx_amount','currency');
		$this->set_custom_function('tax_amount','currency');
		$this->set_custom_function('date_fakturpajak','indo_date');
		parent::get_json();
	}

	function index(){
	
	$this->parameters['pt'] = $this->db->query("select * from pt")->result();
	$this->parameters['projek'] = $this->db->query("select * from db_subproject")->result();
	
	$this->parameters['strPost']		= 0;

	//clear session
	$this->session->set_userdata('sesspt', '');
	$this->session->set_userdata('sessproject', '');
	$this->session->set_userdata('sessstart', '');
	$this->session->set_userdata('sessend', '');
		
	if($this->input->post('submit') == TRUE) {
		$this->parameters['strPost']		= 1;

		//set session
		$this->session->set_userdata('sesspt', $this->input->post('pt'));
		$this->session->set_userdata('sessproject', $this->input->post('subproject'));
		$this->session->set_userdata('sessstart', $this->input->post('startdate'));
		$this->session->set_userdata('sessend', $this->input->post('enddate'));
	

		$this->parameters['ptsess'] = $this->db->query("select * from pt where id_pt = ".$this->input->post('pt')."")->row();
		$this->parameters['projeksess'] = $this->db->query("select * from db_subproject where subproject_id = ".$this->input->post('subproject')."")->row();
		$this->parameters['startdates'] = $this->session->userdata('sessstart');
		$this->parameters['enddates'] = $this->session->userdata('sessend');
		
		
		
		$this->set_grid_column('id_invoice','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('no_fakturpajak','NO Faktur Pajak',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('date_fakturpajak','Tanggal Faktur Pajak',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('no_invoice','NO INV',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('customer_nama','Nama Customer',array('width'=>30,'align'=>'left'));
		#$this->set_grid_column('npwp','NPWP',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('trx_amount','DPP',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('tax_amount','PPN',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('ttd_fakturpajak','TTD',array('width'=>30,'align'=>'left'));
		$this->set_jqgrid_options(array('width'=>1230,'height'=>400,'caption'=>'Faktur Pajak PPN KELUARAN','rownumbers'=>true,'sortname'=>'id_invoice','sortorder'=>'desc'));
	}
	parent::index();
	}
	
	function gen(){
		
		 $this->load->view('tax/print/espt_excel');	
	
	}
}

