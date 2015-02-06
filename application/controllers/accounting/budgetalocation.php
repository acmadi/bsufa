<?php
	class Budgetalocation extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('budgetalocation_model');
			$this->set_page_title('Budget Alocation');
			$this->default_limit = 30;
			$this->template_dir = 'accounting/budgetalocation';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		
		function get_json(){
			//$this->set_custom_function('trx_amt','currency');
			parent::get_json();
		}
		
		function index(){
			#die("test");
			//$this->budgetalocation_model->index();
			$this->set_grid_column('pt_project','ID',array('hidden'=>true));
			$this->set_grid_column('kd_project','Kode Project',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_project','Nama Project',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('alokasi_persen','Persen',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'BUDGET','rownumbers'=>true,'sortname'=>'pt_id','sortorder'=>'DESC'));
			parent::index();		
		}
		
		function show_project($id){
		$this->db->query("update project set is_show = 0");
		$this->db->query("update project set is_show = 1 where kd_project like '$id%' and judul = 'N'");
		}
		
		function set_alokasi(){
			$url= $this->input->post('url');
			$kp = $this->input->post('kodeproject');
			$pp = $this->input->post('persen');
			$this->db->query('SET IDENTITY_INSERT db_alokasibgt OFF');
			$this->db->query("insert into db_alokasibgt (id_subproject,alokasi_persen) values ('$kp','$pp')");
			redirect('accounting/budgetalocation');
		}

		
	}
?>
