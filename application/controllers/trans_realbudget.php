<?php
class trans_realbudget extends DBController{
	private $divisi;
	function __construct(){
		parent::__construct('trans_realbudget_model');
		$this->set_page_title('Proposed Budget');
		$this->template_dir = 'accounting/trans_realbudget';
		$session_id = $this->UserLogin->isLogin();
	    $this->user_account = $session_id['username'];

	}

	function get_json(){
		$this->set_custom_function('tgl_print','indo_date');
		$this->set_custom_function('apptanggal','indo_date');
		parent::get_json();
	}


	protected function setup_form($data=false){
		#give parameter
		/*$session_id = $this->UserLogin->isLogin();
		$divisi = $session_id['divisi_id'];	
		$coa = "";
		$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
		$this->parameters['kodebgt'] = $this->mstmodel->getbudget($divisi);*/	
	}
	
	
	function index(){
		$this->set_grid_column('id_hstprint','ID',array('hidden'=>true));
		$this->set_grid_column('kode_form','Batch.No',array('width'=>20,'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_print','Date',array('width'=>15,'formatter' => 'cellColumn'));
		$this->set_grid_column('remark','Description',array('width'=>70,'formatter' => 'cellColumn'));
		//$this->set_grid_column('tanggal','Tgl.Proposed',array('width'=>40,'align'=>'center','formatter' => 'cellColumn'));
		//$this->set_grid_column('amount','Proposed',array('width'=>70,'align'=>'right','formatter' => 'numberFormat'));
		//$this->set_grid_column('apptanggal','Tgl.Realisasi',array('width'=>40,'align'=>'center','formatter' => 'cellColumn'));
		//$this->set_grid_column('appamount','Realisasi',array('width'=>70,'align'=>'right','formatter' => 'numberFormat2'));
		//$this->set_grid_column('flag_id','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>860,'height'=>300,'caption'=>'List of Proposed Budget','rownumbers'=>true,'sortname'=>'id_hstprint','sortorder'=>'desc'));
		if($this->user_account!="")parent::index();
		else redirect("user/login");
	}	
}
