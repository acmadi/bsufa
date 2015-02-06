<?
	#defined('BASEPATH') or die('Access Denied');
	
	class cetakneracacon extends AdminPage{

				
		function index(){	
			$this->loadTemplate('gl/cetakneracacon_view');
		}
		function cetak(){
			$this->load->view('gl/print/print_neraca');
			}
		
	}	
