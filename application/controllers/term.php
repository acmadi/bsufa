<?php
class term extends DBController{
	function __construct(){
		parent::__construct('term_model');
		$this->set_page_title('Credit Term');
		$this->default_limit = 30;
		$this->template_dir = 'ap/term';

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
		$this->set_grid_column('id_term','ID',array('hidden'=>true));
		$this->set_grid_column('term_cd','Due Date',array('width'=>55,'align'=>'Left'));
		$this->set_grid_column('descs','Description',array('width'=>95,'align'=>'Left'));
		$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'Due Date','rownumbers'=>true,'sortname'=>'term_cd','sortorder'=>'ASC'));
		parent::index();
	}


	function simpan(){
		extract(PopulateForm());
		$data = array
		(
			'term_cd'=> $term_cd

		);		
		$query = $this->db->query("sp_creditterm ".$term_cd."");
		//$this->db->insert('db_term',$data);
		redirect('term');
	}		
		
}

