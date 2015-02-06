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
		$this->set_grid_column('id_aset','ID',array('hidden'=>true));
		$this->set_grid_column('kd_aset','Kode Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nilai_aset','Nilai Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_penerimaan','Date',array('width'=>200, 'formatter' => 'cellColumn'));		
		$this->set_grid_column('remark','Description',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('status','Status Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'MUTASI ASSET','rownumbers'=>true,'sortname'=>'id_aset','sortorder'=>'asc'));
		parent::index();	
	}

	function mutasi($id)
	{
		$data['detail'] = $this->mutasiaset_model->getdetail('db_aset','id_aset',$id,'id_aset','asc')->result();
		$this->load->view('accounting/mutasiaset-mutasi',$data);
	}

	function jual($id)
	{
		$data['detail'] = $this->mutasiaset_model->getdetail('db_aset','id_aset',$id,'id_aset','asc')->result();
		$this->load->view('accounting/mutasiaset-jual',$data);
	}

	function savedata()
	{

	}

	function updatedata()
	{
		
	}
}