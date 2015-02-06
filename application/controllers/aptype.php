<?php
class aptype extends DBController{
	function __construct(){
		parent::__construct('aptype_model');
		$this->set_page_title('AP Type');
		$this->template_dir = 'ap/aptype';

	}

	protected function setup_form($data=false){
	                        $this->parameters['aptype'] = $this->db->select('id_aptype,aptype_cd,descs')
                                                                                                            ->order_by('id_aptype','ASC')
                                                                                                            ->get('db_aptype')
                                                                                                            ->result();
									 
	}

	// function get_json(){
		// // $this->set_custom_function('received_date','indo_date');
		// // $this->set_custom_function('pay_date','indo_date');
		// // $this->set_custom_function('amount_unidenti','currency');
		// // $this->set_custom_function('pay_unidenti','currency');
		// parent::get_json();
	// }
	
	function index(){
		$this->set_grid_column('id_aptype','ID',array('hidden'=>true));
		$this->set_grid_column('aptype_cd','Type',array('width'=>55,'align'=>'Left'));
		$this->set_grid_column('descs','Description',array('width'=>95,'align'=>'Left'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'AP Type','rownumbers'=>true,'sortname'=>'aptype_cd','sortorder'=>'ASC'));
		parent::index();
	}


	function simpan(){
		extract(PopulateForm());
		$data = array
		(
			'aptype_cd'=> $aptype_cd,
			'descs'=> $descs
		);		
		$this->db->insert('db_aptype',$data);
		redirect('aptype');
	}		
		
}

