<?php
defined('BASEPATH') or die('Access Denied');
Class appervendor_call extends AdminPage{
	//~ function agings_coll_report()
	//~ {
		//~ parent::AdminPage();
		//~ //$this->pageCaption = 'Print Cuti Karyawan';
	//~ }	

	function appervendor_print(){
		#die("test");
		extract(PopulateForm());
		
		
		
		
		if(@$klik){
		$this->load->view('ap/print/print_appervendor');
		}else{
		$this->load->view('accounting/print/appervendor_excel');
		}
	}	
	

	
	
}


