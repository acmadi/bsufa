<?php
defined('BASEPATH') or die('Access Denied');
Class projection_sales_report extends AdminPage{
	function projection_sales_report()
	{
		parent::AdminPage();
		//$this->pageCaption = 'Print Cuti Karyawan';
	}	

	function sales_report(){
		extract(PopulateForm());
		#if($cek == ''){$cek = 0;}
		$project['subproject'] = $subproject;	
		// die($project);
		
		$this->load->view('sales/print/projection_sales_report_print_excel',$project);
		// if($cek == 1){
			// #dump('tes');
			// $this->load->view('sales/print/projection_sales_report_print_excel');
		
		// }
		
			// else{
		
		// echo "Sorry please click DETAIL <a href ='https://mis.bsu.co.id/view_report/report_view/projection_sales_report'>BACK TO HOME</a>";
		// //~ $this->load->view('sales/print/projection_sales_report_print');
		// }
	}	
	

	
	
}


