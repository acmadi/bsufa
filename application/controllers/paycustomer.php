<?php
defined('BASEPATH') or die('Access Denied');
class paycustomer extends AdminPage{


	function paycustomer()
	{
		parent::AdminPage();
		$this->pageCaption = 'Payment Customer';
	}	

	function index(){		
		extract(PopulateForm());
		#die("test");
		/*$data['cek'] = $this->db->join('db_unit','unit_id = id_unit','left')
						 ->join('db_customer','customer_id = id_customer','left')
						 ->join('db_billing','sp_id = id_sp','left')
						 ->join('db_paygroup','paygroup_id = id_paygroup')
						 ->join('db_paytipe','paytipe_id = id_paytipe')
						 ->where('id_customer',@$customerid)
						 ->where('id_unit',@$unit)
						 ->get('db_sp')->result();
		$data['cekbill'] = 'cekbill'; 		
		$this->parameters['data'] = $data;*/
		$this->loadTemplate('sales/paycustomer_view');		
	}
	
	
	function updatebill(){
	   extract(PopulateForm());
	   $bill = $nobill;
	   $pay = replace_numeric($pay);
	   $blc = replace_numeric($blc);
	   $unamount = replace_numeric($unamount);
	   $charge = replace_numeric($charge);
	   #$komisi = replace_numeric($komisi);
	   if(@$un!="") {
		   $komisi = replace_numeric($komisi);
		   #$totx = $komisi + $pay;
		   #if($totx > $pay) die("Data lebih besar");
		}else{
			 $komisi = 0;
		 }
		#var_dump($komisi);exit;
	   $jumpay = $xpay + $pay;
	  # var_dump($xpayun);exit;
	   if($cara==2){
		   $rows = $this->db->where('bankcek_id',$xtransfer)
							->get('db_bankcek')->row();
		   $nm  = $rows->bankcek_nm;
		   $coa = $rows->bankcek_coa;
			
			$sql = $this->db->query("SP_Paymentnoncash ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
			,".$cara.",'".@$bank."','".@$an."','".inggris_date($paytgl)."','".$acc."',".$pay.",'".$remark."',".$komisi.",'".$nm."','".$coa."'");	   
			die("sukses");		   
	   
	   }elseif($transfer==3 && $sid==1){
			$jumunpay = $pay + $xpayun;
			$sql = $this->db->query("SP_customer_payuntransfer ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
			,'".@$bank."','".inggris_date($paytgl)."',".$pay.",'".$remark."',".$jumunpay.",".$unid.",".$komisi."");	   
			die("sukses");
			//die("untransfer");
	   }elseif($transfer==3 && $sid==2){
			$jumunpay = $unamount + $xpayun;
			$payamount = $pay + $charge;
			$jumpay = $payamount + $xpay;
			$sql = $this->db->query("SP_customer_payuncredit ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
			,'".@$bank."','".inggris_date($paytgl)."',".$pay.",'".$remark."',".$jumunpay.",".$charge."");	   
			die("sukses");
		   //die("unCredit Card");
	   }elseif($transfer==2){
			$sql = $this->db->query("SP_paycustomercredit ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
			,".$cara.",'".@$bank."','".@$an."','".inggris_date($paytgl)."','".$acc."',".$pay.",'".$remark."',".$komisi.",".$charge."");	   
			die("sukses");	   
		   //die("credit card");
	   }else{
			$sql = $this->db->query("SP_PaymentCustomer ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
			,".$cara.",'".@$bank."','".@$an."','".inggris_date($paytgl)."','".$acc."',".$pay.",'".$remark."',".$komisi."");	   
			die("sukses");
	   }
	   	   

	   /*$sql = $this->db->query("SP_PaymentCustomer ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
	   ,".$cara.",'".$bank."','".@$an."','".inggris_date($paytgl)."','".$acc."',".$pay.",'".$remark."'");	   
	   die("sukses");*/
	}
	
	function kwtcust($id){
		include_once( APPPATH."libraries/translate_currency.php");
		$query = $this->db->query("SP_kwtbilling ".$id."");
		$data['kwt'] = $query->row();
		//var_dump($data['kwt']);exit;
		$this->load->view('sales/kwprint',$data);
	}
	
	
    function bayarbill($id,$idcust){
	   extract(PopulateForm());
	   $data['bill'] = $this->db->join('db_sp','id_sp = sp_id')
								->where('id_billing',$id)
								->get('db_billing')->row();
								
		$sp = $data['bill']->id_sp;
		$project = $data['bill']->id_subproject;						
		//Penomoran Billing						
	   $rowcek = $this->db->join('db_billing','id_bill = id_billing','left')
						  ->join('db_sp','id_sp = sp_id','left')
						  ->where('id_subproject',$project)
						  ->order_by('kwtbill_no','DESC')				  
						  ->get('db_kwtbill')->row();		
		
		//Space FData
		$data['cara'] = $this->db->get('db_payjns')->result();
		$data['coa'] = 	$this->db->get('kper')->result();		
		#$data['cek'] = $this->db->get('db_paytipecek')->result();
		$data['unid'] = $this->db->get('db_unidentified')->result();
		//Cek unit dan customer
		$data['cekcust'] = $this->db->join('db_customer','id_customer = customer_id')
									->join('db_unit_yogya','unit_id = id_unit')
									->where('sp_id',$sp)
									->get('db_sp')->row();
		//Cek Source Nama
		$data['source'] = $this->db->get('db_paysource')->result();
		$data['unsource'] =  $this->db->where('id_unditified',3)
								   ->get('db_paysource')->result();	
		$data['cekbank'] = $this->db->get('db_bankcek')->result();						   					   
		$no = $rowcek->kwtbill_no + 1;
		//var_dump($no);exit;
		if($no > 99999) $data['no'] = $no;
		elseif($no > 9999) $data['no'] = "0".$no;
		elseif($no > 999) $data['no'] = "00".$no;
		elseif($no > 99) $data['no'] = "000".$no;
		elseif($no > 9) $data['no'] = "0000".$no;
		else $data['no'] = "00000".$no;				
					
		#Cek Undidentified
		/*$data['und'] = $this->db->where('id_customer',$idcust)
								->where('flag',0)
								->get('db_unidentified')->result();*/	
								  
	   $this->load->view('sales/paybill_view',$data);
	}
	
	function tampilbill(){
		extract(PopulateForm());
		//die($customerid);
		/*$data['cek'] = $this->db->join('db_unit','unit_id = id_unit','left')
						 ->join('db_customer','customer_id = id_customer','left')
						 ->join('db_billing','sp_id = id_sp','left')
						 ->join('db_paygroup','paygroup_id = id_paygroup')
						 ->join('db_paytipe','paytipe_id = id_paytipe')
						 ->where('id_customer',$customerid)
						 ->where('id_unit',$unit)
						 ->get('db_sp')->result();*/
		$data['cek'] = $this->db->query("tampilbill ".$customerid.",".$unit."")->result();				
		$data['cekbill'] = 'cekbill'; 				 
		$this->parameters['data'] = $data;
		$this->loadTemplate('sales/paycustomer_view');		
		
	}
	
	function loaddata(){
		#die($this->input->post('parent_id'));
		if($this->input->post('data_type')){
			$data_type = $this->input->post('data_type');
			$parent_id = $this->input->post('parent_id');
			$session_id = $this->UserLogin->isLogin();
			$session_cus = $this->input->post('subproject');
				
			$pt = $session_id['id_pt'];
			$a=44;
			//die($a);
			switch($data_type){
				case 'subproject':
					$sql = $this->db->select('subproject_id id,nm_subproject nama')
									->where('id_pt','44')
									//->order_by('nm_subproject','ASC')
									 ->get('db_subproject')->result();
						break;
						
					case 'unid':
						$sql = $this->db->select("unidentiacc_id id,convert(varchar, CAST((amount_unidenti-pay_unidenti) as money), 1) + ' ( ' + 
										convert(varchar,received_date,105) + ' ) ' + reference nama")
										->where('id_paysource',$parent_id)
										->where('(amount_unidenti-pay_unidenti) >',0)
										->get('db_unidentified')->result();					
					break;	
					case 'unit' :
						$sql = $this->db->select('unit_id id,unit_no nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->where('status_unit','3')
										->order_by('unit_no','ASC')
										->get('db_unit_yogya')->result();
						break;
					/*	
					case 'customername' :
						$sql = $this->db->select('distinct(customer_id) id,customer_nama nama')
										->join('db_custprofil','customer_id = id_customer')
										->where('id_project',$parent_id)
										->get('db_denda')->result();
					break; */
		/*				
select customer_nama,customer_hp,customer_alamat1 from db_unit_yogya
left join db_sp on (unit_id = id_unit)
left join db_customer on(customer_id = id_customer)
where status_unit = '3' and unit_id='47'
			*/			
						
					case 'customername' :
						$sql = $this->db->select('customer_nama,customer_hp,customer_alamat1')
										->join('db_sp','unit_id = id_unit')
										->join('db_customer','customer_id = id_customer')
										->where('status_unit','3')
										->where('unit_id',$parent_id)
										->get('db_unit_yogya')->result();
					break;
					case 'periode':
						$sql = $this->db->select('denda_periode id,denda_periode nama')
										->where('denda_unit',$parent_id)
										->get('db_denda')->result();
						//var_dump($sql);exit;
					break;
					case 'denda_unit' :
						$sql = $this->db->select('distinct(denda_unit) id,denda_unit nama')
										->where('id_customer',$parent_id)
										->get('db_denda')->result();
					break;	
					case 'project_denda':
						$sql = $this->db->select('distinct(db_denda.id_project) id_project,nm_subproject nama')
										->where('db_subproject.id_pt',$pt)
										->join('db_subproject','subproject_id = db_denda.id_project')
										->get('db_denda')->result();
					break;				
					case 'project':
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$pt)
										->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
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
		
		
		function cekbilling($id,$proj){
			$rows = $this->db->join('db_sp b','a.unit_id = b.id_unit')
							 ->join('db_customer c','c.customer_id = b.id_customer')
							 ->where('status_unit','3')
							 ->where('a.unit_id',$id)
							 ->where('a.id_subproject',$proj)
							 ->get('db_unit_yogya a')->row();									
			echo(json_encode($rows));
		}
		
		function cekunitbill(){
			$unitid = $this->input->post('unitid');
			$custid = $this->input->post('custid');
			
			$sql = $this->db->select('due_date,id_sp,id_billing,paygroup_nm,tgl_paydate,amount')
							->join('db_billing','id_sp = sp_id')
							->join('db_paygroup','id_paygroup = paygroup_id')
							->where('id_customer',$custid)
							->where('id_unit',$unitid)
							->get('db_sp')->result();
							
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
		
		
		function cek_data($id){
			$data = $this->db->select('db_bank.bank_nm,pay_unidenti,(amount_unidenti - pay_unidenti) as amount')
							 ->where('unidentiacc_id',$id)
							 ->join('db_bank','id_bank = bank_id')
							 ->get('db_unidentified')->row();
			die(json_encode($data));				 
			
		}
		
	
		
}

