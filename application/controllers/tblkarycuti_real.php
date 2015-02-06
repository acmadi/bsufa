<?php
Class tblkarycuti_real extends DBController{
	function __construct(){
		parent::__construct('tblkarycuti_real_model');
		$this->set_page_title('List Karyawan');
		$this->default_limit = 15;
		$this->template_dir = 'hrd/tblkarycuti_real';
	}

	function index(){
		$this->set_grid_column('karycuti_id','ID',array('hidden'=>true));
		$this->set_grid_column('nama','Nama',array('width'=>175));
		$this->set_grid_column('divisi_nm','Divisi',array('width'=>150));
		$this->set_grid_column('tgl_aju','Tanggal Pengajuan',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('startdate_cuti','Mulai Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('enddate_cuti','Akhir Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('aju_cuti','Jumlah Cuti',array('width'=>20,'align'=>'center'));
		$this->set_grid_column('karycutijns_nm','Jenis Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('flowapp_nm','Status Approval',array('width'=>100));
		$this->set_jqgrid_options(array('width'=>900,'height'=>200,'caption'=>'List Karyawan','rownumbers'=>true));
		parent::index();
	}
	
}

