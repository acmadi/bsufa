<?php
class pphout extends AdminPage{
	
	function index(){
		$this->loadTemplate('ftax/pphout_view');
	}
	
	function print_pph(){
		extract(PopulateForm());
		$this->load->view('ftax/print/print_pphout');
	}
}