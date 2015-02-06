<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class historyjurnal extends DBController {

	function __construct()
	{
		parent::__construct('historyjurnal_model');
		$this->set_page_title('HISTORY JOURNAL ASSET');
		$this->default_limit = 30;
		$this->template_dir = 'accounting/historyjurnal';
	}

	function get_json()
	{
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id','ID',array('hidden'=>true));
		$this->set_grid_column('kd_aset','Kode Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_brg','Nama Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nilai_aset','Nilai Aset',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('debet','Nilai Depresiasi',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('post_date','Post Date',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'HISTORY JOURNAL ASSET','rownumbers'=>true,'sortname'=>'','sortorder'=>'asc'));
		parent::index();	
	}

}

/* End of file historyjurnal.php */
/* Location: ./application/controllers/historyjurnal.php */