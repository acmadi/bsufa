<?php
defined('BASEPATH') or die('Access Denied');
Class report_salespayment extends AdminPage{
	function report_sales()
	{
		parent::AdminPage();
		//$this->pageCaption = 'Print Cuti Karyawan';
	}	

	function salespayment_report(){
		#die("test");
		extract(PopulateForm());
		if(@$klik) $this->load->view('sales/print/salespayment_report');
		else $this->load->view('sales/excel/salespayment_excel');
	}	
	
	
	function salespayment_report_leasing(){
		#die("test");
		extract(PopulateForm());
		if(@$klik) $this->load->view('sales/print/salespayment_report_leasing');
		else $this->load->view('sales/excel/salespayment_excel_leasing');
	}	

	
	
}


