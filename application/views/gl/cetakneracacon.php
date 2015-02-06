<?
	#defined('BASEPATH') or die('Access Denied');
	
	class cetakneraca_call extends AdminPage{

				
		function index(){	
			$this->loadTemplate('gl/cetakneraca_view');
		}
		function cetak(){
			$this->load->view('gl/print/print_neraca');
			}
		
	}	
