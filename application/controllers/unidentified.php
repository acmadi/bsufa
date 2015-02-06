<?php
class unidentified extends DBController{
	function __construct(){
		parent::__construct('unidentified_model');
		$this->set_page_title('Unidentified ');
		$this->template_dir = 'sales/unidentified';

	}

	protected function setup_form($data=false){
	
	    $session_id = $this->UserLogin->isLogin();
		$user = $session_id['username'];
		$pt = $session_id['id_pt'];
		$arr = array(1,2,3,5,6);
		$this->parameters['tipe'] = $this->db->where('id_unditified',3)
											  ->get('db_paysource')->result();
		$this->parameters['bank'] = $this->db->where_not_in('bank_id',$arr)
											->where('id_pt',$pt)
											 ->get('db_bank')->result();				 
	}

	function get_json(){
		$this->set_custom_function('received_date','indo_date');
		$this->set_custom_function('pay_date','indo_date');
		$this->set_custom_function('amount_unidenti','currency');
		parent::get_json();
	}
	
	
	function index(){
		$this->set_grid_column('unidentiacc_id','ID',array('hidden'=>true));
		$this->set_grid_column('received_date','Received Date',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('pay_date','Pay Date',array('width'=>50,'align'=>'center'));
		$this->set_grid_column('amount_unidenti','Amount',array('width'=>60,'align'=>'right'));
		$this->set_grid_column('pay_unidenti','Pay Unidentified',array('width'=>60,'align'=>'right'));		
		$this->set_grid_column('bank_nm','Bank Name',array('width'=>120,'align'=>'Left'));
		$this->set_grid_column('reference','Reference',array('width'=>80,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'List Unidentified','rownumbers'=>true,'sortname'=>'unidentiacc_id','sortorder'=>'desc'));
		parent::index();
	}


	function simpan(){
		extract(PopulateForm());
		
		$session_id = $this->UserLogin->isLogin();
		$user = $session_id['username'];
		$pt = $session_id['id_pt'];
		
		//die($pt);
		//Cek Account Bank
		$cekbank = $this->db->select('bank_coa,bank_nm')
							->where('bank_id',$bank)
							->get('db_bank')->row();
		$bankaccount = $cekbank->bank_coa;
		$banknm = $cekbank->bank_nm;
		//Simpan data
		$data = array
		(
			'received_date'=> inggris_date($tgl),
			'id_paysource'=> $paytipe,
			'id_bank'=> $bank,
			'reference'=>$ref,
			'amount_unidenti'=>replace_numeric($amount),
			'pay_unidenti'=>0,
			'id_pt'=>$pt,
			'id_subproject'=>$subproject
			
		);
		//Buat Jurnal unidentified
		$x1 = array 
		(
			'date_jurnal'=> inggris_date($tgl),
			'acc_coa' =>$cekbank->bank_coa,
			'debet'=>replace_numeric($amount),
			'credit'=>0,
			'remark'=>$cekbank->bank_nm
		);

		$x2 = array 
		(
			'date_jurnal'=> inggris_date($tgl),
			'acc_coa' =>'2.02.01.03',
			'debet'=>0,
			'credit'=>replace_numeric($amount),
			'remark'=>'Unidentified'
		);

		//Insert Ke Map Jurnal
		$this->db->insert('db_mapjurnal',$x1);
		$this->db->insert('db_mapjurnal',$x2);		
		
		if ($pt == 44){
		$this->db->insert('db_unidentified',$data);
		}else{
		$this->db->insert('db_unidentified',$data);
		$query = $this->db->query("sp_Insertunidentified '".inggris_date($tgl)."','".$bankaccount."',".replace_numeric($amount).",'".$banknm."',".$paytipe.",".$pt.",'".$ref."',".$subproject."");
		//Insert Ke Unidentified
		
		}
		
		
		
		redirect('unidentified');
	}		
	
	function loaddata(){
		#die($this->input->post('parent_id'));
		if($this->input->post('data_type')){
			$data_type = $this->input->post('data_type');
			$parent_id = $this->input->post('parent_id');
			$session_id = $this->UserLogin->isLogin();
			$session_cus = $this->input->post('subproject');
			$pt = $session_id['id_pt'];
			switch($data_type){
				
				case 'subproject': 
					$sql = $this->db->select('id_project id,nm_subproject nama')
									->where('id_pt',$pt)
    								 ->get('db_subproject')->result();
						break;
						
				case 'bank':
				
							if ($pt ==44) {
							$sql = $this->db->select('bank_id id,bank_nm nama')
										->where('id_pt',44)
										->get('db_bank')
										->result();
							}else{
							$sql = $this->db->select('bank_id id,(bank_nm +"  ||  "+ bank_acc) nama')
									    ->where('project',$parent_id)
										->get('db_bank')
										->result();
							
							}
						break;	
				
					
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));exit;
			}
		}
	
	
	function receipt_unidentified($id){
		#die("test");
		include_once( APPPATH."libraries/translate_currency.php");	
									 
		$data['cekdt'] = $this->db->select('a.bank_coa,a.bank_nm,amount_unidenti,received_date,reference')	
								  ->where('unidentiacc_id',$id)
								  ->join('db_bank a','bank_id = id_bank')
								  ->get('db_unidentified')->row();
								 
		$this->load->view('sales/print/receipt_unidentified',$data);
	}


	
}

