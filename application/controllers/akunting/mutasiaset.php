<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mutasiaset extends DBController {

	function __construct()
	{
		parent::__construct('mutasiaset_model');
		$this->set_page_title('MUTASI ASSET');
		$this->default_limit = 20;
		$this->template_dir = 'accounting/mutasiaset';
		$this->load->model('mutasiaset_model');
	}

	function index()
	{
		$this->set_grid_column('','ID',array('hidden'=>true));
		$this->set_grid_column('','Kode Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('','Nilai Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('','Date',array('width'=>200, 'formatter' => 'cellColumn'));		
		$this->set_grid_column('','Description',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('','Status Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'MUTASI ASSET','rownumbers'=>true,'sortname'=>'','sortorder'=>''));
		parent::index();	
	}

	function savedata()
	{

	}

	function updatedata()
	{
		
	}
}