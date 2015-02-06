<?php
class kwtbillleasing extends DBController{
	function __construct(){
		parent::__construct('kwtbillleasing_model');
		$this->set_page_title('List Kwitansi');
		$this->template_dir = 'leasing/kwtbillleasing';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
	
	}


	protected function setup_form($data=false){
		
		#$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
	}

	function get_json(){
		$this->set_custom_function('kwitansi_paydate','indo_date');
		$this->set_custom_function('kwitansi_pay','number_format');		
		parent::get_json();
	}



	function index(){
		$this->set_grid_column('kwitansi_id','ID',array('width'=>30,'hidden'=>false));
		$this->set_grid_column('kwitansi_paydate','Payment Date',array('width'=>30,'align'=>'left'));		
		$this->set_grid_column('kwitansi_no','No Kwitansi',array('width'=>30,'align'=>'Left'));
		$this->set_grid_column('kwitansi_pay','Payment Kwitansi',array('width'=>30,'align'=>'right'));		
		$this->set_grid_column('kwitansi_remark','Remark',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('id_print','id print',array('hidden'=>false, 'width'=>0.000001,'align'=>'Right'));
		$this->set_jqgrid_options(array('width'=>1000,'height'=>300,'caption'=>'Kwitansi','rownumbers'=>true,'sortname'=>'kwitansi_id','sortorder'=>'desc'));
		parent::index();
	}
	

	function reprintkwt($id){
	
	$session_id = $this->UserLogin->isLogin();
	$this->user = $session_id['username'];
	$this->pt	= $session_id['id_pt'];
	$this->level = $session_id['level_id']; 
	$pt = $this->pt;
	// $session_id = $this->UserLogin->isLogin();
	// $this->pt_id = $session_id['id_pt'];
	// $pt = $this->pt_id;
		
	
	
	//$level = $this->level;
	
	//die($id);
	
	$id_bill = $this->db->where('kwitansi_id',$id)
							->get('db_kuitansi')->row();
							
	//var_dump($id_bill);
							
							
	//$id_bill2 = $id_bill->id_bill;
	
	// $id_sp = $this->db->where('id_sp',$id_bill2)
							// ->get('db_billing')->row();
							
	// $id_bill3 = $id_sp->id_sp;
							
	// $sp_id = $this->db->where('sp_id',$id_bill3)
							// ->get('db_sp')->row();
							
	// $id_bill4 = $sp_id->sp_id;
	
	$id_print = $id_bill->id_print;
	
	if($id_print == 1 and  $this->level != 5){
			echo"
				<script type='text/javascript'>
					alert('Kwitansi Sudah Pernah di Print');
					refreshTable();
				</script>
			";

			
		}else{
	
		$q=$this->db->query("Update db_kuitansi  set id_print=1 WHERE kwitansi_id='$id'");
		include_once( APPPATH."libraries/translate_currency.php");	

			// if ($pt=='44'){
			// $data['cekdt'] = $this->db->query("sp_tampil_kwitansi ".$id.",".$pt."")->row();						  
			// $this->load->view('sales/rkwprint_gmi',$data);
			// }else {
			$data['cekdt'] = $this->db->query("sp_tampil_kwitansi_leasing ".$id.",".$pt."")->row();						  
			$this->load->view('leasing/rkwprint_leasing',$data);			
			//}
	} 
	}
	
	function receipt($id){
	
		include_once( APPPATH."libraries/translate_currency.php");
		
		$arsip=$id;
		
	
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = 12;
		//die($pt);
		if($pt==44){
		$data['dtmap'] = $this->db->where('id_kwtbill',$id)
								 ->get('db_mapjurnal')->result();
								 
		//$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id)->row();						 
		 //$data['dtmap'] = $this->db->query("sp_tampil_jurnal ".$id.",".$pt."")->row();									 
		// $this->load->view('sales/print/receipt',$data);
		}elseif ($pt==12){
		
		$data['dtmap'] = $this->db->where('no_arsip',$arsip)
								->where('isnull(flag_hapus,0) !=',1)
								 ->get('jurnal')->result();
								 
		//$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id)->row();					
		}else{
		
		$data['dtmap'] = $this->db->where('nomor_link',$arsip)
								 ->where('isnull(flag_hapus,0) !=',1)
								 ->get('BDMALL2005.dbo.jurnal')->result();
								 
		//$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id)->row();					
		}
		$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id.",".$pt."")->row();									 
		$this->load->view('leasing/print/receipt_leasing',$data);
		//var_dump($data['dtmap']);
	}
	
	function paycancel(){
		extract(PopulateForm());
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		#var_dump($this->user);exit;
		$user = $this->user;
		$dt = $this->db->query("sp_cancelpaymentleasing ".$idkwt.",".$user.",".$pt.",'".$tglcancel."','".$remark."'");
		die("sukses");	
	}
		
		
}

