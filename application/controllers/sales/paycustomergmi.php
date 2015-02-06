<?php
defined('BASEPATH') or die('Access Denied');
class paycustomergmi extends AdminPage{


	function paycustomergmi()
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
		$this->loadTemplate('sales/paycustomergmi_view');		
	}
	
	
	function updatebill(){
	   extract(PopulateForm());
	   
	   $sql = "select * from db_billing 
				JOIN db_sp on id_sp = sp_id where id_billing = $idbill";
	   $row = $this->db->query($sql)->row();
	   
	   
	   
	   if($un != 1){ $un = 0;}
	  
	   if($status == 'Booking Fee'){ $status = 1;}
	   elseif($status == 'Down Payment'){ $status = 2;}
	   else { $status = 3;};
	   
	  $amount = replace_numeric($amount);
	  $pay	= replace_numeric($pay);
	   
	   #$sisa = $amount - $pay;
	   
	   if($blc < 0 && $blc > (-10000)){ $sisa = 1;}
	   elseif ($blc > 0 && $blc < 10000 ){ $sisa = 2;}
	   elseif ($blc == 0){ $sisa = 3;}
	   
	   
	   
	   #echo $row->id_subproject;
	   $kode = $cara.$transfer.$un.$status.$sisa.$row->id_subproject;
	   echo $kode;
	   
   }
	
	function updatebill2(){
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
		#var_dump($acc);exit;
	   $jumpay = $xpay + $pay;
	  # var_dump($xpayun);exit;
	   if($cara==2){
		   $rows = $this->db->where('bankcek_id',$xtransfer)
							->get('db_bankcek')->row();
		   $nm  = $rows->bankcek_nm;
		   $coa = $rows->bankcek_coa;
		   
			
			$sql = $this->db->query("SP_Paymentnoncash ".$idbill.",'".$bill."','".inggris_date($paytgl)."',".$jumpay.",".$blc."
			,".$cara.",'".@$bank."','".@$an."','".inggris_date($paytgl)."','".$acc."',".$pay.",'".$remark."',".$komisi.",'".$nm."','".$coa."',".$charge."");	   
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
	
	
    function bayarbill($id,$idcust,$bayar){
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
		
		$session_id = $this->UserLogin->isLogin();
		$session_cus = $this->input->post('subproject');
		$pt = $session_id['id_pt'];
		
		if($pt == 44){
		
		$data['cekcust'] = $this->db->join('db_customer','id_customer = customer_id')
									->join('db_unit_yogya','unit_id = id_unit')
									->where('sp_id',$sp)
									->get('db_sp')->row();
		}
		
		else{
		
		$data['cekcust'] = $this->db->join('db_customer','id_customer = customer_id')
									->join('db_unit_bdm','unit_id = id_unit')
									->where('sp_id',$sp)
									->get('db_sp')->row();	
		
		}
		
		
		if($pt == 44){
		$data['account'] = $this->db->select("bank_nm,bank_acc,bank_coa,bank_id")
									->where("bank_id !=",1)
									->where("bank_id !=",2)
									->where("bank_id !=",3)
									->where("bank_id !=",5)
									->where("bank_id !=",6)
									->where("id_pt",44)
									->get("db_bank")->result();
								}
		else{
		
		$data['account'] = $this->db->select("bank_nm,bank_acc,bank_coa,bank_id")
									->where("bank_id !=",1)
									->where("bank_id !=",2)
									->where("bank_id !=",3)
									->where("bank_id !=",5)
									->where("bank_id !=",6)
									->where("id_pt",11)
									->get("db_bank")->result();
		
		}						
									
		$data['bay'] = $bayar;							

		//Cek Source Nama
		$data['source'] = $this->db->get('db_paysource')->result();
		$data['unsource'] =  $this->db->where('id_unditified',3)
								   ->get('db_paysource')->result();	
		$data['cekbank'] = $this->db->get('db_bankcek')->result();						   					   
		$no = @$rowcek->kwtbill_no + 1;
		#var_dump($no);exit;
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
								  
	   //~ $this->load->view('sales/paybill_view',$data);
	}
	
	function tespop($customername){
		
		$this->load->view('sales/paybill_view');
	}
	
	function tampilbill(){
		
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		
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

		#var_dump($data['account']);exit;						
		#$data['nama'] = $customername;
		
		#TAMPIL NAMA PROYEK
		$sql = "SELECT * FROM db_subproject where subproject_id = $subproject";
		$rowss = $this->db->query($sql)->row();
		$data['row'] = $rowss;
		
		//die($unit);
		
		#TAMPIL NO UNIT
		if($pt == 44){
		$sql = "SELECT * FROM db_unit_yogya WHERE unit_id = $unit";
		$roow = $this->db->query($sql)->row();
		$data['roow'] =$roow;
		}else{
		$sql = "SELECT * FROM db_unit_bdm WHERE unit_id = $unit";
		$roow = $this->db->query($sql)->row();
		$data['roow'] =$roow;
		
		}
		
		
		#TAMPIL CUSTOMER
		$data['customer'] = $customername;
		
		#TAMPIL TANGGAL
		$data['tgl'] = $tgl;
		
		#TAMPIL AMOUNT
		$data['amount'] = $amount;
		
		#TAMPIL TIPE
		$data['tipe'] = $tipe;
		
		#TAMPIL REFF
		$data['reff'] = $reff;
		
		#TAMPIL CHARGE
		$data['charge'] = $charge;
		
		#TAMPIL BANK
		$data['bank4'] = $bank;
		
		#TAMPIL UNID
		$data['unid1'] = @$unid;
		
		#TAMPIL BANK
		$sql = "SELECT * FROM db_bank WHERE bank_id = $bank";
		$roww = $this->db->query($sql)->row();
		$data['bank'] = $roww;
		
		
		
		
		
		
		
		$data['cek'] = $this->db->query("tampilbill_project ".$customerid.",".$unit.",".$pt."")->result();				
		$data['cekbill'] = 'cekbill'; 				 
		$this->parameters['data'] = $data;
		
		$this->loadTemplate('sales/paycustomergmi_view',$data);		
		
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
					if($pt == 44){
					$sql = $this->db->select('subproject_id id,nm_subproject nama')
									->where('id_pt','44')
									//->order_by('nm_subproject','ASC')
									 ->get('db_subproject')->result();
						break;}
					else{
					$sql = $this->db->select('subproject_id id,nm_subproject nama')
									->where('id_pt',$pt)
									//->order_by('nm_subproject','ASC')
									 ->get('db_subproject')->result();
						break;
					
					}	
						
					case 'unid':
						$sql = $this->db->select("unidentiacc_id id,convert(varchar, CAST((amount_unidenti-pay_unidenti) as money), 1) + ' ( ' + 
										convert(varchar,received_date,105) + ' ) ' + reference nama")
										//->where('id_paysource',$parent_id)
										->where('id_pt',$pt)
										->where('(amount_unidenti-pay_unidenti) >',0)
										->get('db_unidentified')->result();					
					break;	
					case 'unit' :
						if($pt == 44){
						$sql = $this->db->select('unit_id id,unit_no nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->where('status_unit','3')
										->order_by('unit_no','ASC')
										->get('db_unit_yogya')->result();
						break;}
						else{
						$sql = $this->db->select('unit_id id,unit_no nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->where('status_unit','3')
										->order_by('unit_no','ASC')
										->get('db_unit_bdm')->result();
						break;}	
							
					
						
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
					break;
					
					case 'bank':
					
						$sql = $this->db->select('bank_id id,bank_nm nama')
										->where('id_pt',$pt)
										->get('db_bank')->result();
					
						
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
		
		
		function cekbilling($id,$proj){
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			
			if($pt == 44){
			
			$rows = $this->db->join('db_sp b','a.unit_id = b.id_unit')
							 ->join('db_customer c','c.customer_id = b.id_customer')
							 ->where('status_unit','3')
							 ->where('a.unit_id',$id)
							 ->where('b.id_flag',1)
							 ->where('b.id_subproject',$proj)
							 ->get('db_unit_yogya a')->row();
						 }
						 
			else{
			
			$rows = $this->db->join('db_sp b','a.unit_id = b.id_unit')
							 ->join('db_customer c','c.customer_id = b.id_customer')
							 ->where('status_unit','3')
							 ->where('a.unit_id',$id)
							 ->where('b.id_flag',1)
							 ->where('b.id_subproject',$proj)
							 ->get('db_unit_bdm a')->row();
			
			
			}			 									
			echo(json_encode($rows));
		}
		
	function bayar(){
	   extract(PopulateForm());
	   
	   //die($unid);
	   //$bill = $nobill;
	   $idbill = $bill;
	   //$bill = 0;
	   $pay = replace_numeric($amount1);
	   $totpay = replace_numeric($totpay);
	   $adm = 0;
	   $komisi=2000000;
	   $blc = replace_numeric($balance);
	 //  $unamount = replace_numeric($unamount);
	   $charge = replace_numeric($charge1);
	   $komisi = replace_numeric($cekkomisi);
	   
	   $jumpay = replace_numeric($amount1);
	   
	     if ($unid1==""){
		  $unid1=0;
		  }else{
		  $unid1=$unid1;
		  }
	   
	    $rowcek = $this->db->join('db_billing','id_bill = id_billing','left')
						  ->join('db_sp','id_sp = sp_id','left')
						  ->where('id_subproject',$project1)
						  ->order_by('kwtbill_no','DESC')				  
						  ->get('db_kwtbill')->row();		
		$no = @$rowcek->kwtbill_no + 1;
	   
			$selectbank = $this->db->where('bank_id',$bank4)
							->get('db_bank')->row();
		   $bank_nm  = $selectbank->bank_nm;
		   $bank_coa = $selectbank->bank_coa;
		   
		  $cek=$this->input->post('bill');
		  $bill=$this->input->post('payment');
		   $remark=$this->input->post('remark');
		   
		   if ($cekkomisi==1){
		   $komisi=2000000;
		   }else{
		   $komisi=0;
		   }
		  

		  $ja=count($bill);
	   
	   
	  # var_dump($xpayun);exit;
	   if($tipe1==6){
		   $rows = $this->db->where('bank_id',24)
							->get('db_bank')->row();
		   $nm  = $rows->bank_nm;
		   $coa = $rows->bank_coa;
		   
			
			$sql = $this->db->query("SP_Paymentnoncash ".$cek[$i].",'".$no."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$blc."
			,".$tipe.",'".@$bank."','".@$remark."','".inggris_date($tgl)."','".$coa."',".replace_numeric($bill[$i]).",'".$remark."',".$komisi.",'".$nm."','".$coa."',".$charge.",".$unid1."");	   
			die("sukses");		   
	   
	   // }else if($bank4==32 && $tipe1==2){
			// //$jumunpay = $pay + $xpayun;
			// $sql = $this->db->query("SP_customer_payuntransfer ".$cek[$i].",'".$no."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$blc."
			// ,'".@$bank."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",'".$remark."',".replace_numeric($bill[$i]).",".$unit1.",".$komisi."");	   
			// die("sukses");
			// //die("untransfer");
	   }elseif($bank4==32 && $tipe1==3){
			$jumunpay = $amount1;
			$payamount = $pay + $charge;
			$jumpay = $payamount + $jumunpay;
			$sql = $this->db->query("SP_customer_payuncredit ".$cek[$i].",'".$no."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$blc."
			,'".@$bank."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",'".$remark."',".replace_numeric($bill[$i]).",".$charge.",".$unid1."");	   
			die("sukses");
		   //die("unCredit Card");
	   }elseif($tipe1==3){
	   
			for($i=0; $i<$ja;$i++){
			$sql = $this->db->query("SP_paycustomercredit ".$cek[$i].",'".$no."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$blc."
			,".$tipe1.",'".@$bank."','".@$remark."','".inggris_date($tgl1)."','".$bank_coa."',".replace_numeric($bill[$i]).",'".$remark."',".$komisi.",".$charge.",".$unid1."");	   
			}
			die("sukses");	   
		   //die("credit card");
	   }else{
	   
			for($i=0; $i<$ja;$i++){
			
			if  ($bill[$i]>0){
			$sql = $this->db->query("SP_PaymentCustomer ".$cek[$i].",".replace_numeric($charge1).",'".@$remark."','".$no."','".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$blc."
			,".$tipe1.",'".@$bank4."','".@$remark."','".inggris_date($tgl1)."','".$bank4."',".replace_numeric($bill[$i]).",'".$remark."',".$komisi.",".$unid1."");	  
			}else{
			die("sukses");
			}
			}
			die("sukses");
	   }
	   	   

	}
		
		
		function bayarbsu(){
			extract(PopulateForm());
			// $jml=strlen($id);
            // $a=explode(',',$id);
            // $ja=count($a);
          //  for($i=0;$i<$ja;$i++){
		  $session_id = $this->UserLogin->isLogin();
			$user = $session_id['username'];
			$pt = $session_id['id_pt'];
			
		  
		  $cek=$this->input->post('bill');
		  $bill=$this->input->post('payment');
		  
		  $charge = 0;
		  //$cekkomisi = 0;

		  $ja=count($bill);
		
		 if ($pt=='11'){
			for($i=0; $i<$ja;$i++){
         // var_dump($ja);
           //$q=$this->db->query("Update db_billing  set id_flag=6, pay_amount=10 WHERE id_billing='$cek[$i]'");
		   $query = $this->db->query("sp_Insertpaymentbdm '".$unit1."','".$bank1."','".$remark."','".$subproject1."',".replace_numeric($balance).",".replace_numeric($amount1).",'".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$cek[$i].",".$charge.",'".$tipe1."',".$cekkomisi."");   
            }
			}else {
			for($i=0; $i<$ja;$i++){
         // var_dump($ja);
           //$q=$this->db->query("Update db_billing  set id_flag=6, pay_amount=10 WHERE id_billing='$cek[$i]'");
		   $query = $this->db->query("sp_Insertpaymentproject '".$unit1."','".$bank1."','".$remark."','".$subproject1."',".replace_numeric($balance).",".replace_numeric($amount1).",'".inggris_date($tgl1)."',".replace_numeric($bill[$i]).",".$cek[$i].",".$charge.",'".$tipe1."',".$cekkomisi."");   
            }
			}
			
			
			echo"
                                                <script type='text/javascript'>
                                                            alert('Sukses');
                                                            window.close();
															 refreshTable();
                                                </script>
                                     ";      
									 
		#TAMPIL NAMA PROYEK
		$sql = "SELECT * FROM db_subproject where nm_subproject = '".$subproject1."'";
		$rowss = $this->db->query($sql)->row();
		$data['row'] = $rowss;
		
		//die($unit);
		
		#TAMPIL NO UNIT
		//if($pt == 22){
		$sql = "SELECT * FROM db_unit_bdm WHERE unit_no= '".$unit1."'";
		$roow = $this->db->query($sql)->row();
		$data['roow'] =$roow;
		
		#TAMPIL CUSTOMER
		$data['customer'] = $customername1;
		
		#TAMPIL TANGGAL
		$data['tgl'] = $tgl1;
		
		#TAMPIL AMOUNT
		$data['amount'] = $amount1;
		
		#TAMPIL TIPE
		$data['tipe'] = $tipe1;
		
		#TAMPIL REFF
		$data['reff'] = $reff1;
		
		#TAMPIL BANK
		$sql = "SELECT * FROM db_bank WHERE bank_nm = '".$bank1."'";
		$roww = $this->db->query($sql)->row();
		$data['bank'] = $roww;
		
		$id_unit= $roow->unit_id;
		$customer =1;
		
		
		
		
		
		$data['cek'] = $this->db->query("tampilbill_project ".$customer.",".$id_unit."")->result();				
		$data['cekbill'] = 'cekbill'; 				 
		$this->parameters['data'] = $data;
		
		$this->loadTemplate('sales/paycustomergmi_view',$data);		
			
			
			
	
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
							
			$response = 	array();
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

