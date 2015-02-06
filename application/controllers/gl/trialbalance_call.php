<?
	#defined('BASEPATH') or die('Access Denied');
	
	class trialbalance_call extends AdminPage{

				
		function index(){	
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			$data['pt'] = $pt;
			$data['project'] = $this->db->query("SELECT subproject_id, nm_subproject as project_name FROM db_subproject where id_pt='$pt'")->result();
			
			$this->parameters=$data;
		
			$this->loadTemplate('gl/trialbalance_view',$data);
		}
		function cetak(){
			
			extract(PopulateForm());
			if(@$klik){
				$this->load->view('gl/print/print_tb');
			}else if(@$ekspor){
				$this->load->view('gl/print/print_excel_tb');
			}
		
		}
	}	
