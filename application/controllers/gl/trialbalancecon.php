<?
	#defined('BASEPATH') or die('Access Denied');
	
	class trialbalancecon extends AdminPage{

				
		function index(){	
			$this->loadTemplate('gl/trialbalancecon_view');
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
