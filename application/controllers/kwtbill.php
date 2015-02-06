<?php
class kwtbill extends DBController{
	function __construct(){
		parent::__construct('kwt_model');
		$this->set_page_title('List Kwitansi');
		$this->template_dir = 'sales/kwtbill';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
	
	}


	protected function setup_form($data=false){
		
		#$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
	}

	function get_json(){
		$this->set_custom_function('kwtbill_paydate','indo_date');
		$this->set_custom_function('kwtbill_pay','number_format');		
		parent::get_json();
	}



	function index(){
		$this->set_grid_column('kwtbill_id','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('kwtbill_paydate','Payment Date',array('width'=>30,'align'=>'left'));		
		$this->set_grid_column('kwtbill_no','No Kwitansi',array('width'=>30,'align'=>'Left'));
		$this->set_grid_column('kwtbill_pay','Payment Kwitansi',array('width'=>30,'align'=>'right'));		
		$this->set_grid_column('kwtbill_remark','Remark',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('id_print','id print',array('hidden'=>false, 'width'=>0.000001,'align'=>'Right'));
		$this->set_jqgrid_options(array('width'=>1000,'height'=>300,'caption'=>'Kwitansi','rownumbers'=>true,'sortname'=>'kwtbill_paydate','sortorder'=>'desc'));
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
	
	$id_bill = $this->db->where('kwtbill_id',$id)
							->get('db_kwtbill')->row();
							
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
	
		$q=$this->db->query("Update db_kwtbill  set id_print=1 WHERE kwtbill_id='$id'");
		include_once( APPPATH."libraries/translate_currency.php");	

			if ($pt=='44'){
			$data['cekdt'] = $this->db->query("sp_tampil_kwitansi ".$id.",".$pt."")->row();						  
			$this->load->view('sales/rkwprint_gmi',$data);
			}else if ($pt=='66'){
			$data['cekdt'] = $this->db->query("sp_tampil_kwitansi ".$id.",".$pt."")->row();						  
			$this->load->view('sales/rkwprint_gmi',$data);
			}else {
			$data['cekdt'] = $this->db->query("sp_tampil_kwitansi ".$id.",".$pt."")->row();						  
			$this->load->view('sales/rkwprint_project',$data);			
			}
	} 
	}
	
	function kwitansi_new($id){
	//die($id);
	include_once( APPPATH."libraries/translate_currency.php");
		
		$arsip=$id;
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id; 
        //die($pt);
    if ($pt=='66'){
         
        $data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id.",".$pt."")->row();									 
		$this->load->view('sales/print/kwitansi_new_alk',$data); 
	}
	
	else {
		$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id.",".$pt."")->row();									 
		$this->load->view('sales/print/kwitansi_new',$data);
	
	 }
	}
	
	function receipt($id){
	$did = $this->db->query("select kwtbill_no from db_kwtbill where kwtbill_id = '".$id."'")->row()->kwtbill_no;
		include_once( APPPATH."libraries/translate_currency.php");
		
		$arsip=$id;
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		//die($pt);
		if($pt==44 || $pt==66){
		$data['dtmap'] = $this->db->where('id_kwtbill',$id)
								 ->get('db_mapjurnal')->result();
								 
		//$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id)->row();						 
		 //$data['dtmap'] = $this->db->query("sp_tampil_jurnal ".$id.",".$pt."")->row();									 
		// $this->load->view('sales/print/receipt',$data);
		}elseif ($pt==11){
		
		$data['dtmap'] = $this->db->where('nomor_link',$arsip)
								->where('isnull(flag_hapus,0) !=',1)
								 ->get('jurnal')->result();
								 
		//$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id)->row();					
		}else{
		
		$data['dtmap'] = $this->db->where('nomor_link',$arsip)
								 ->where('isnull(flag_hapus,0) !=',1)
								 ->get('BDMALL2005.dbo.jurnal')->result();
								 
		//$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id)->row();					
		}
		if($pt=='66'){
		$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$did.",".$pt."")->row();		
	}else{
		$data['cekdt'] = $this->db->query("sp_tampil_kwt ".$id.",".$pt."")->row();
	}							 
		$this->load->view('sales/print/receipt',$data);
		//var_dump($data['dtmap']);
	}
	
	function paycancel(){
		extract(PopulateForm());
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		$pt = $this->pt_id;
		#var_dump($this->user);exit;
		$user = $this->user;
		
		if ($pt==11){
		
		$posting = $this->db->select('user_post as posting')
												->where('no_arsip',$idkwt)
												 ->get('BSUALL2005.dbo.jurnal')->row();
		if ($posting->posting == 0){
				$dt = $this->db->query("sp_cancelpayment ".$idkwt.",".$user.",".$pt.",'".$tglcancel."','".$remark."'");
				die("sukses");					
			}else{
			die("Transaksi Sudah Diposting");
			}
		}elseif ($pt==22){
		$posting = $this->db->select('user_post as posting')
												->where('no_arsip',$idkwt)
												 ->get('BDMALL2005.dbo.jurnal')->row();
		if ($posting->posting == 0){
				$dt = $this->db->query("sp_cancelpayment ".$idkwt.",".$user.",".$pt.",'".$tglcancel."','".$remark."'");
				die("sukses");					
			}else{
			die("Transaksi Sudah Diposting");
			}		
		}else{
		$dt = $this->db->query("sp_cancelpayment ".$idkwt.",".$user.",".$pt.",'".$tglcancel."','".$remark."'");
		die("sukses");
		
		}
		
		
	}
		
		
}

