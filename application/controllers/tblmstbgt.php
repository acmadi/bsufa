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
			$this->set_grid_column('proj','Project');
			$this->set_grid_column('acc','Account');
			$this->set_grid_column('divisi','Divisi');
			$this->set_grid_column('code','Code');
			$this->set_grid_column('descacc','Description Account');
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Master Budget','rownumbers'=>true));
			parent::index();
		}
	
	}
?>
