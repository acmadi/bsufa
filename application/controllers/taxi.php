<?php
class tax extends DBController{
	function __construct(){
		parent::__construct('tax_model');
		$this->set_page_title('Tax');
		$this->template_dir = 'gl/tax';

	}

	protected function setup_form($data=false){
		$arr = array(1,2,3,4,5,6);
		$this->parameters['currency'] = $this->db->where('status',1)
											  ->get('db_currency')->result();
		$this->parameters['spec'] = $this->db->where_in('spec_id',$arr)
											 ->get('db_spec')->result();	
		$this->parameters['type'] = $this->db->where_in('type_id',$arr)
											 ->get('db_typeacc')->result();											 
	}

	// function get_json(){
		// // $this->set_custom_function('received_date','indo_date');
		// // $this->set_custom_function('pay_date','indo_date');
		// // $this->set_custom_function('amount_unidenti','currency');
		// // $this->set_custom_function('pay_unidenti','currency');
		// parent::get_json();
	// }
	
	function index(){
		$this->set_grid_column('id_tax','ID',array('hidden'=>true));
		$this->set_grid_column('tax_cd','Tax Code',array('width'=>55,'align'=>'Left'));
		$this->set_grid_column('ppn','Ppn',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('pph','Pph',array('width'=>50,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'Tax Scheme','rownumbers'=>true,'sortname'=>'tax_cd','sortorder'=>'ASC'));
		parent::index();
	}


	function simpan(){
		extract(PopulateForm());
		$data = array
		(
			'tax_cd'=> $tax_cd,
			'ppn'=> $ppn,
			'pph'=> $pph
		);		
		$this->db->insert('db_tax',$data);
		redirect('tax');
	}		
		
}

