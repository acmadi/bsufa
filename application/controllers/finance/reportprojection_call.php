<?
	#defined('BASEPATH') or die('Access Denied');
	
	class reportprojection_call extends AdminPage{

				
		function index(){	
		
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
			
				
			$data['project'] = $this->db->query("SELECT subproject_id, nm_subproject as project_name FROM db_subproject where id_pt='$pt'")->result();
			
			$this->parameters=$data;
	
			$this->loadTemplate('finance/reportprojection_view',$data);
		}
		function cetak(){
			extract(PopulateForm());
				// if(@$klik){
				
			// $this->load->view('gl/print/print_pnl');
				// }else if(@$ekspor){
			// $this->load->view('gl/print/print_pnl_excel');		
			// }
			$this->load->view('finance/print/print_projection_excel');			
			
		}
		
		
		
	}	
