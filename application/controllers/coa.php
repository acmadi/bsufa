<?php
class coa extends DBController{
	function __construct(){
		parent::__construct('coa_model');
		$this->set_page_title('Chart Of Account ');
		$this->default_limit = 30;
		$this->template_dir = 'gl/coa';
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['username'];

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
		$this->set_grid_column('acc_no','Acc No',array('width'=>55,'align'=>'Left'));
		$this->set_grid_column('acc_name','Acc Name',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('level','Level',array('width'=>50,'align'=>'right'));
		$this->set_grid_column('type','Type',array('width'=>60,'align'=>'right'));
		$this->set_grid_column('group_acc','Group',array('width'=>60,'align'=>'right'));
		$this->set_grid_column('currency_cd','Currency',array('width'=>60,'align'=>'right'));		
		$this->set_grid_column('status','Status',array('width'=>80,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'List Chart of Account','rownumbers'=>true,'sortname'=>'acc_no','sortorder'=>'ASC'));
		parent::index();
	}


	function simpan(){
		extract(PopulateForm());
		//die($acc_no);
		$input_user = $this->user;

		//$coa = $this->input->post('acc_no');
		$cek_coa = $this->db->select('acc_no as id')
							   ->where('acc_no',$acc_no)
							   ->get('db_coa')->row();
		//$z = ;				   
		//var_dump($cek_coa);
							   
		if ($cek_coa->id == $acc_no){

					die('Kode Account Sudah Ada');

			
		}else{
		//die($cek_coa.' '.$acc_no->acc_no);
		$data = array
		(
			'acc_no'=> $acc_no,
			'acc_name'=> $acc_name,
			'level'=> $level,
			'type'=>$type,
			'group_acc'=>$group,
			'currency_cd'=>$currency,
			'status'=>$status
		);
		//var_dump($data);
		$this->db->insert('db_coa',$data);
		$query = $this->db->query("sp_InsertTB '".$acc_no."','".$acc_name."','".$type."','".$currency."','".$input_user."'");
		//redirect('coa');
		die('Sukses');
		}
	}		
	
	function modif(){
		extract(PopulateForm());
		//die($acc_no);

		//$coa = $this->input->post('acc_no');
		$cek_coa = $this->db->select('acc_no as id')
							   ->where('acc_no',$acc_no)
							   ->get('db_coa')->row();

							   
		// if ($cek_coa->id == $acc_no){

					// die('Kode Account Sudah Ada');

			
		// }else{
		// //die($cek_coa.' '.$acc_no->acc_no);
		$data = array
		(
			'acc_no'=> $acc_no,
			'acc_name'=> $acc_name,
			'level'=> $level,
			'type'=>$type,
			'group_acc'=>$group,
			'currency_cd'=>$currency,
			'status'=>$status
		);
		//var_dump($data);
		
		$this->db->where('acc_no',$acc_no);
		$this->db->update('db_coa',$data);
		die('Sukses');
	//	}
	}	
	
	
	// function receipt_unidentified($id){
		// #die("test");
		// include_once( APPPATH."libraries/translate_currency.php");	
									 
		// $data['cekdt'] = $this->db->select('a.bank_coa,a.bank_nm,amount_unidenti,received_date,reference')	
								  // ->where('unidentiacc_id',$id)
								  // ->join('db_bank a','bank_id = id_bank')
								  // ->get('db_unidentified')->row();
								 
		// $this->load->view('sales/print/receipt_unidentified',$data);
	// }


	
}

