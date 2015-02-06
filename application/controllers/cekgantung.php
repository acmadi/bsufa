<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cekgantung extends DBController {

	function __construct()
	{
		parent::__construct('cekgantung_model');
		$this->set_page_title('BANK IN TRANSIT');
		$this->default_limit = 20;
		$this->template_dir = 'cb/cekgantung';
		$this->load->model('cekgantung_model');
	}
	
	function get_json(){
		$this->set_custom_function('slip_date','indo_date');
		$this->set_custom_function('payment_date','indo_date');
		$this->set_custom_function('trans_date','indo_date');
		$this->set_custom_function('amount','currency');
		$this->set_custom_function('amt_balance','currency');
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id_plan','ID',array('hidden'=>true));
		$this->set_grid_column('doc_no','No AP',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('voucher','Kode BK',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('no_arsip','No Cek',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('descs','Desc',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('amount','Amount',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('amt_balance','Balance',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('slip_date','Tgl Bayar',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('trans_date','Tgl Cek',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('payment_date','Tgl Cair',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'BANK IN TRANSIT','rownumbers'=>true,'sortname'=>'id_plan','sortorder'=>'desc'));
		parent::index();	
	}
}