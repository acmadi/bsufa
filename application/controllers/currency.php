<?php
class currency extends DBController{
	function __construct(){
		parent::__construct('currency_model');
		$this->set_page_title('Master Currency ');
		$this->template_dir = 'gl/currency';

	}

	// protected function setup_form($data=false){
		// $arr = array(1,2,3,5,6);
		// $this->parameters['tipe'] = $this->db->where('id_unditified',3)
											  // ->get('db_paysource')->result();
		// $this->parameters['bank'] = $this->db->where_not_in('bank_id',$arr)
											 // ->get('db_bank')->result();				 
	// }

	// function get_json(){
		// // $this->set_custom_function('received_date','indo_date');
		// // $this->set_custom_function('pay_date','indo_date');
		// // $this->set_custom_function('amount_unidenti','currency');
		// // $this->set_custom_function('pay_unidenti','currency');
		// parent::get_json();
	// }
	
	function index(){
		$this->set_grid_column('currency_id','ID',array('hidden'=>true));
		$this->set_grid_column('currency_cd','Currency',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('currency_name','Name',array('width'=>50,'align'=>'center'));
		$this->set_grid_column('currency_date','Date',array('width'=>60,'align'=>'right'));
		$this->set_grid_column('currency_amount','Amount',array('width'=>60,'align'=>'right'));		
		$this->set_grid_column('status','Status',array('width'=>80,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'List Currency','rownumbers'=>true,'sortname'=>'currency_id','sortorder'=>'ASC'));
		parent::index();
	}


	// function simpan(){
		// extract(PopulateForm());
		// //Cek Account Bank
		// $cekbank = $this->db->select('bank_coa,bank_nm')
							// ->where('bank_id',$bank)
							// ->get('db_bank')->row();
		// //Simpan data
		// $data = array
		// (
			// 'received_date'=> inggris_date($tgl),
			// 'id_paysource'=> $paytipe,
			// 'id_bank'=> $bank,
			// 'reference'=>$ref,
			// 'amount_unidenti'=>replace_numeric($amount),
			// 'pay_unidenti'=>0
		// );
		// //Buat Jurnal unidentified
		// $x1 = array 
		// (
			// 'date_jurnal'=> inggris_date($tgl),
			// 'acc_coa' =>$cekbank->bank_coa,
			// 'debet'=>replace_numeric($amount),
			// 'credit'=>0,
			// 'remark'=>$cekbank->bank_nm
		// );

		// $x2 = array 
		// (
			// 'date_jurnal'=> inggris_date($tgl),
			// 'acc_coa' =>'2.02.01.03',
			// 'debet'=>0,
			// 'credit'=>replace_numeric($amount),
			// 'remark'=>'Unidentified'
		// );

		// //Insert Ke Map Jurnal
		// $this->db->insert('db_mapjurnal',$x1);
		// $this->db->insert('db_mapjurnal',$x2);		
		// //Insert Ke Unidentified
		// $this->db->insert('db_unidentified',$data);
		// redirect('unidentified');
	// }		
	
	
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

