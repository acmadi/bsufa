<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetak_invoice_call extends AdminPage{

		function cetak_invoice__call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->load->view('leasing/cetak_invoice');
		}
	}	
