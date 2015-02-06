<?php
Class printcombudget extends Controller{
	function __construct(){
		parent::controller();
		$this->load->Model('mstbudget_model','budget');
		
	}
	
	function index(){
		extract(PopulateForm());
		$data['proj'] = $this->budget->dataproj($project);
		$this->load->view('print/combudget-print',$data);
	} 
}
