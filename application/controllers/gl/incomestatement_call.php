<?
	#defined('BASEPATH') or die('Access Denied');
	
	class incomestatement_call extends AdminPage{

				
		function index(){	
			$this->loadTemplate('gl/incomestatement_view');
		}
		function cetak(){
			extract(PopulateForm());
				if(@$klik){
				
			$this->load->view('gl/print/print_pnl');
				}else if(@$ekspor){
			$this->load->view('gl/print/print_pnl_excel');		
			}
				
			
		}
		
	}	
