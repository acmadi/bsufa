<?php
class tagihan_search extends DBController{
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tagihan_model');
			$this->set_page_title('Pencarian Tagihan');
			$this->default_limit = 30;
			$this->template_dir = 'accounting/tagihan_search';
		}

		function get_json(){
			$this->set_custom_function('nilai','currency');
			parent::get_json();
		}

		
		function index(){
			$this->set_grid_column('tagihan_id','ID Tagihan',array('hidden'=>true,'width'=>2,'align'=>'center'));
			$this->set_grid_column('noinvoice','No. Invoice',array('width'=>60));
			$this->set_grid_column('nilai','Nilai Tagihan',array('width'=>40,'align'=>'right'));
			$this->set_grid_column('uraian','Keterangan',array('width'=>180));
			$this->set_grid_column('penagih','Nama Penagih',array('width'=>80));
			$this->set_jqgrid_options(array('width'=>890,'height'=>200,'caption'=>'Pencarian Tagihan','rownumbers'=>true));
			parent::index();
		}		


}
