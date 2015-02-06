<?
	#defined('BASEPATH') or die('Access Denied');
	
	class incomestatementcon extends AdminPage{

				
		function index(){	
			$this->loadTemplate('gl/incomestatementcon_view');
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
