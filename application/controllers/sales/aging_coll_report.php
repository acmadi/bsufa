<?php
defined('BASEPATH') or die('Access Denied');
Class aging_coll_report extends AdminPage{
	function agings_coll_report()
	{
		parent::AdminPage();
		//$this->pageCaption = 'Print Cuti Karyawan';
	}	

	function aging_coll(){
		#die("test");
		extract(PopulateForm());
		if(@$klik) $this->load->view('sales/print/aging_coll_report_print');
		else $this->load->view('sales/excel/aging_coll_report_excel');	
	}	
	
	function aging_coll_leasing(){
		#die("test");
		extract(PopulateForm());
		if(@$klik) $this->load->view('leasing/print/aging_coll_report_print_leasing');
		else $this->load->view('leasing/excel/aging_coll_report_excel_leasing');	
	}	
	
	
}


