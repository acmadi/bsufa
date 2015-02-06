<?php
	class tbltrbgt extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tbltrbgt_model');
			$this->set_page_title('List Of Realization Budget');
			$this->default_limit = 10;
			#$this->template_dir = 'bsuportal/mis/budget';
		}
		
		function index(){
			$this->set_grid_column('id_trbgt','ID',array('hidden'=>true));
			$this->set_grid_column('code','Code',array('width'=>25,'align'=>'left'));
			$this->set_grid_column('amount','Amount',array('width'=>20,'align'=>'right'));
			$this->set_grid_column('date','Date ',array('width'=>25,'align'=>'center'));
			$this->set_grid_column('remark','Remark',array('width'=>120,'align'=>'left'));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'List Of Realization Budget','rownumbers'=>true));
			parent::index();
		}
	
	}
?>
