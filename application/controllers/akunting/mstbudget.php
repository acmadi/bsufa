<?php
	class mstbudget extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('mstbudget_model');
			$this->set_page_title('Master Budget');
			$this->default_limit = 10;
			$this->template_dir = 'budget/budget';
		}
		
		function index($print=false){
			$this->load->model('userlogin','user');
			$session_id = $this->user->isLogin();
			$id =  $session_id['id'];
			$this->set_grid_column('id_mst','ID',array('hidden'=>true));
			$this->set_grid_column('proj','Project');
			$this->set_grid_column('acc','Account');
			$this->set_grid_column('divisi','Divisi');
			$this->set_grid_column('code','Code');
			$this->set_grid_column('descacc','Description Account');
			$this->set_grid_column('bgt1','Januari');
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Master Budget','rownumbers'=>true));
			if($print){
				echo"tes";
			}
			parent::index();
		}
	
	}

