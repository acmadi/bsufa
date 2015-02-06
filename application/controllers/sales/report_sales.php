<?php
defined('BASEPATH') or die('Access Denied');
Class report_sales extends AdminPage{
	function report_sales()
	{
		parent::AdminPage();
		//$this->pageCaption = 'Print Cuti Karyawan';
	}	

	function sales_report(){
		
		extract(PopulateForm());
		if(@$klik){
			$this->load->view('sales/print/sales_report');
		}else if(@$export){
			$this->load->view('sales/excel/salesreport_excel');
		}
		
	}	
	
	function statusunit_report(){
		
		extract(PopulateForm());
		if(@$klik){
			$this->load->view('sales/print/statusunit_report');
		}else if(@$export){
		
			if ($type==1){
			$this->load->view('sales/excel/statusunitav_excel');
			}else{
			$this->load->view('sales/excel/statusunitreport_excel');
			}
		}
		
	}	
	
	function projection_sales_report(){
		$this->load->view('sales/print/projection_sales_report_print');
	}	
	
	function aging_sales_report(){
		$this->load->view('sales/print/aging_sales_report_print');
	}	
	
	function history_pembayaran_report(){
		extract(PopulateForm());
		if(@$klik){
			$this->load->view('sales/print/all_history_payment_print');			
		}else if(@$export){
			$this->load->view('sales/excel/all_history_payment_excel');			
		}
		
	}
	
	function history_pembayaran_report_leasing(){
		extract(PopulateForm());
		if(@$klik){
			$this->load->view('leasing/print/all_history_payment_print_leasing');			
		}else if(@$export){
			$this->load->view('leasing/excel/all_history_payment_excel_leasing');			
		}
		
	}
	
	function history_pembayaran_report_summary(){
		extract(PopulateForm());
		if(@$klik){
			$this->load->view('sales/print/all_history_payment_print_summary');			
		}else if(@$export){
			$this->load->view('sales/excel/all_history_payment_excel_summary');			
		}
		
	}
	

	
	
}


