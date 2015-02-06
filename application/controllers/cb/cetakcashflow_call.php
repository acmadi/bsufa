<?
	#defined('BASEPATH') or die('Access Denied');
	
	class cetakcashflow_call extends AdminPage{

				
		function index(){	
			$this->loadTemplate('cb/cashflow_view');
		}
		function cetak(){
			
			extract(PopulateForm());
			if(@$klik){
				$this->load->view('cb/print/print_CASHFOW');
			}else if(@$ekspor){
				$this->load->view('cb/print/print_CASHFOW');
			}
		
		}
	}	
