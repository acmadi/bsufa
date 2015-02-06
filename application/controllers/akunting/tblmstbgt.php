<?php
	class tblmstbgt extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tblmstbgt_model');
			$this->set_page_title('Master Budget');
			$this->default_limit = 10;
		}
		
		function index(){
			$this->set_grid_column('id_mst','ID',array('hidden'=>true));
			$this->set_grid_column('code','Code',array('width'=>180,'align'=>'center'));
			$this->set_grid_column('descbgt','Nama',array('width'=>600,'align'=>'left'));
			$this->set_grid_column('proj','Project',array('width'=>150,'align'=>'left'));
			$this->set_grid_column('bgt1','Jan',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt2','Feb',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt3','Mar',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt4','Apr',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt5','Mei',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt6','Jun',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt7','Jul',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt8','Ags',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt9','Sep',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt10','Okt',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt11','Nop',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('bgt12','Des',array('width'=>120,'align'=>'left'));
			$this->set_grid_column('tot_mst','Total',array('width'=>120,'align'=>'left'));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Master Budget','rownumbers'=>true));
			parent::index();
		}
	
	}
?>
