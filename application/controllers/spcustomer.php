<?php
class spcustomer extends DBController{

	function __construct(){
		parent::__construct('spcustomer_model');
		$this->set_page_title('List Customer');
		$this->template_dir = 'sales/spcustomer';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
		$this->user_id = $session_id['id'];
		$this->pt_id = $session_id['id_pt'];
		
	}

	protected function setup_form($data=false){
			$this->load->model('spcustomer_model','customer');
			$id = @$data->customer_id;
			$this->parameters['cust'] = $this->customer->joinall($id);
			#var_dump($this->parameters['cust']);
			
			$this->parameters['kota'] = $this->db->order_by('kota_nm','asc')->get('db_kota')->result();
			$this->parameters['agama'] = $this->db->get('db_agama')->result();
			$this->parameters['profesi'] = $this->db->order_by('profesi_nm','asc')->get('db_profesi')->result();
			$this->parameters['tipemedia'] = $this->db->order_by('tipemedia_nm','asc')->get('db_tipemedia')->result();
			$this->parameters['media'] = $this->db->order_by('media_nm','asc')->get('db_media')->result();
			$this->parameters['motivie'] = $this->db->order_by('motivie_nm','asc')->get('db_motivie')->result();
			$this->parameters['etnis'] = $this->db->order_by('etnis_nm','asc')->get('db_etnis')->result();
			$this->parameters['negara'] = $this->db->order_by('negara_nm','asc')->get('db_negara')->result();
			$this->parameters['propinsi'] = $this->db->order_by('propinsi_nm','asc')->get('db_propinsi')->result();
			#var_dump($this->parameters['negara']);
			$this->parameters['add'] = $this->customer->additional($id);
			#var_dump($this->parameters['add']);
			$this->parameters['bisnis'] = $this->db->order_by('bisnis_nm','asc')->get('db_bisnis')->result();
			$this->parameters['hubungan'] = $this->db->order_by('hubungan_nm','asc')->get('db_hubungan')->result();
			$this->parameters['individu'] = $this->db->where('id_filter','2')->order_by('nm_group','asc')->get('db_group')->result();
			$this->parameters['corporate'] = $this->db->where('id_filter','1')->order_by('nm_group','asc')->get('db_group')->result();
			$this->parameters['tipecustomer'] = $this->db->select('tipecustomer_id id,tipecustomer_nm nama')
													->get('db_tipecustomer')
													->result();


			
			$tgl = date("Y-m-d");
			$sql = "select * from db_salesplan where '$tgl' between strartdate  and enddate";
			
			$rows = $this->db->query($sql)->row();
			$this->parameters['phase'] = $rows->phase;
				
	
	}
	

	function get_json(){
		$this->set_custom_function('tgl_sales','indo_date');
		parent::get_json();
	}


	function index(){
		$this->set_grid_column('sp_id','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('no_sp','No SP',array('width'=>15,'align'=>'Right'));
		$this->set_grid_column('unit_no','No Unit',array('width'=>15,'align'=>'Center'));
		$this->set_grid_column('tgl_sales','SP Date',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('customer_nama','Customer Name',array('width'=>50,'align'=>'left'));
		$this->set_grid_column('nm_subproject','Project',array('width'=>50,'align'=>'left'));
		$this->set_grid_column('paytipe_nm','Payment Type',array('width'=>50,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>1200,'height'=>300,'caption'=>'List Surat Pesanan','rownumbers'=>true,'sortname'=>'sp_id','sortorder'=>'desc'));
		parent::index();
	}
	
	function surat_pesanan($nama){
		
		$data['idnama'] = $nama;
		//die($nama);
		if ($this->pt_id == 44){
		
		$this->load->view("sales/print/print_surat_pesanan",$data);		
		}elseif($this->pt_id == 22) {
		$this->load->view("sales/print/print_surat_pesananbdm",$data);		
		}elseif($this->pt_id == 11) {
		$this->load->view("sales/print/print_surat_pesananbsu",$data);		
		}elseif($this->pt_id == 66) {
		$this->load->view("sales/print/print_surat_pesanan_bintaro",$data);		
		}
		
		
	}
	
	function InsertSP(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$idflag ='1';
			$idproject='1111';
			
			#$idpt =2;
			#$iduser = 1;
			$tgl=inggris_date($customertgllhr);
			
			
			$query = $this->db->query("UpdateCustomerBuyer '".$idfilter."','".$idgroup."','".$customernama."','".$tgl."',
			'".$customertmptlhr."','".$idagama."','".$idkarysek."','".$customerstatus."','".$profesi."','".$hp."',
			'".$customertlp."','".$customerfax."','".$idtipe."','".$id_number."','".$email."','".$npwp."','".$tipemedia."','".$media."',
			'".$motivie."','".$customeralamat1."','".$negara."','".$propinsi."','".$kota."','".$kdpos."','".$customeralamat2."','".$negara1."','".$propinsi1."'
			,'".$kota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
			'".$etnis."','".$fb."','".$twiter."','".$custcompnm."','".@$idbisnis."','".$custcompalamat."','".$custcomphp."',
			'".$custcompfax."','".$custcompnpwp."','".$id."'");
			
			
			
			$query = $this->db->query("InputSP ".$spdate.",".$spno.",'".$nama."','".$subproject."',
			".$unit.",".$soldprice.",".$taxamount.",'".$taxppn."',".$paytipe.",'".$disc1."',
			'".$adddisc."','".$salesname."','".$disc2."','".$discamount."','".$iduser."'");
		
				
			$query = $this->db->query("InputBilling '".$salesname."','".$tgl."','".$id_paygroup."','".$amount."',
			'".$duedate."'");
			
			$query = $this->db->query("InputBilling '".$salesname."','".$tgl."','".$id_paygroup."','".$amount."',
			'".$duedate."'");
		
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	function UpdateCustomer(){
	
	}
	
			function loaddata(){
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			
			
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'tipecustomer':
						$sql = $this->db->select('tipecustomer_id id,tipecustomer_nm nama')
										->get('db_tipecustomer')
										->result();
						break;
						
					case 'nama':
						$sql = $this->db->select('customer_id id,customer_nama nama')
										->where('fu_stat',$parent_id)
										->order_by('customer_nama','asc')
										->get('db_customer')
										->result();
						break;
						
					case 'group':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','1')
										->get('db_group')
										->result();
						break;
					case 'agama':
						$sql = $this->db->select('agama_id id,agama_nm nama')
										->get('db_agama')
										->result();
						break;
					
					case 'motivie':
						$sql = $this->db->select('motivie_id id,motivie_nm nama')
										->order_by('motivie_nm','asc')
										->get('db_motivie')
										->result();
						break;
					case 'negara':
						$sql = $this->db->select('negara_id id,negara_nm nama')
										->get('db_negara')
										->result();
						break;
					case 'propinsi':
						$sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										->order_by('propinsi_nm','asc')
										->get('db_propinsi')
										->result();
						break;
					case 'kota':
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->where('id_propinsi',$parent_id)
										->order_by('kota_nm','asc')
										->get('db_kota')
										->result();
						break;
						
					case 'profesi':
						$sql = $this->db->select('profesi_id id,profesi_nm nama')
										->order_by('profesi_nm','asc')
										->get('db_profesi')
										->result();
						break;
					case 'tmplhr':
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->order_by('kota_nm','asc')
										->get('db_kota')
										->result();
						break;
					case 'tipeindividu':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','2')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					case 'tipemedia':
						$sql = $this->db->select('tipemedia_id id,tipemedia_nm nama')
										->order_by('tipemedia_nm','asc')
										->get('db_tipemedia')
										->result();
						break;
					case 'media':
						$sql = $this->db->select('media_id id,media_nm nama')
										->order_by('media_nm','asc')
										->get('db_media')
										->result();
						break;
					case 'bisnis':
						$sql = $this->db->select('bisnis_id id,bisnis_nm nama')
										->order_by('bisnis_nm','asc')
										->get('db_bisnis')
										->result();
						break;
					case 'hubungan':
						$sql = $this->db->select('hubungan_id id,hubungan_nm nama')
										->order_by('hubungan_nm','asc')
										->get('db_hubungan')
										->result();
						break;
					case 'etnis':
						$sql = $this->db->select('etnis_id id,etnis_nm nama')
										->order_by('etnis_nm','asc')
										->get('db_etnis')
										->result();
						break;
					case 'negara1':
						$sql = $this->db->select('negara_id id,negara_nm nama')
										->get('db_negara')
										->result();
						break;
					case 'propinsi1':
						$sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										->order_by('propinsi_nm','asc')
										->get('db_propinsi')
										->result();
						break;
					case 'kota1':
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->where('id_propinsi',$parent_id)
										->order_by('kota_nm','asc')
										->get('db_kota')
										->result();
						break;
					case 'individu':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','2')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					case 'corporate':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','1')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					case 'customerstatus':
						$sql = $this->db->select('marital_id id,marital_nm nama')
										->get('db_marital')
										->result();
						break;
					
					case 'idtipe':
						$sql = $this->db->select('identitas_id id,identitas_nm nama')
										->get('db_identitas')
										->result();
						break;
						
					case 'subproject':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$idpt)
										->get('db_subproject')
										->result();
						break;
					
					case 'unit':
						
						IF($idpt == 44){
						
						$sql = $this->db->select('unit_id id,unit_no nama')
										->where('id_subproject',$parent_id)
										#->where('status_unit',1)
										->where('status_unit',2)
										->order_by('unit_no','ASC')
										->get('db_unit_yogya')
										->result();
										}
						ELSE{
						$sql = $this->db->select('unit_id id,unit_no nama')
										->where('id_subproject',$parent_id)
										#->where('status_unit',1)
										->where('status_unit',2)
										->order_by('unit_no','ASC')
										->get('db_unit_bdm')
										->result();
										}
										
						break;
						
					// case 'salesplan':
						
						// IF($idpt == 22){
						// $tglsp  = date("d-m-Y");
						// $sql = $this->db->select('discount id,adddisc nama')
										// ->where('strart_date <=',$tglsp)
										// ->where('end_date >=',$tglsp)
										// ->get('db_salesplan_bdm')
										// ->result();
										// }
												
						// break;
					
					case 'paytipe':
					
						if ($idpt == 66){
						$sql = $this->db->select('paytipe_id id,paytipe_nm nama')
										->where('paytipe_id >=',4)
										->get('db_paytipe')
										->result();
										
						}else{
						$sql = $this->db->select('paytipe_id id,paytipe_nm nama')
						->where('paytipe_id <=',3)
										->get('db_paytipe')
										->result();
						
						}
						break;
						
					#case 'paytipepl':
					#	$sql = $this->db->select('paytipepl_id id,paytipe_pl nama')
					#					->where('id_paytipe',$parent_id)
					#					->get('db_paytipepl')
					#					->result();
					#	break;
					
					case 'paytipedp':
						$sql = $this->db->select('paytipedp_id id,paytipe_dp nama')
										->where('id_paytipe',$parent_id)
										->get('db_paytipedp')
										->result();
						break;
						
					case 'salessources':
						$sql = $this->db->select('salessource_id id,salessource_nm nama')
										->get('db_sales_sources')
										->result();
						break;
					
					case 'salesname':
						$sql = $this->db->select('id_kary id,nama nama')
										->where('id_sales',$parent_id)
										->get('db_kary')
										->result();
						break;
					case 'discount':
						$sql = $this->db->select('unitdisc_id id,unitdisc_nm nama')
										->get('db_unitdisc')
										->result();
						break;
					
					
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}
	
		function data($id){
		
		$data = $this->db->join('db_kota','id_kota = kota_id','left')
						->where('customer_id',$id)
						->get('db_customer')
						->row();

						
		$xdata = array 
		(
			'customer_nama' => $data->customer_nama,
			'customer_tgl_lhr' => indo_date($data->customer_tgl_lhr),
			'customer_fax' => $data->customer_fax,
			'email' => $data->email,
			'npwp' => $data->npwp,
			'id_no' => $data->id_no,
			'customer_alamat1' => $data->customer_alamat1,
			'customer_alamat2' => $data->customer_alamat2,
			'kdpos' => $data->kdpos,
			'kdpos1' => $data->kdpos1,
			'customer_tmpt_lhr' => $data->customer_tmpt_lhr,
			'id_karysek' => $data->id_karysek,
			'customer_status' => $data->customer_status,
			'id_profesi' => $data->id_profesi,
			'id_tipe' => $data->id_tipe,
			'id_tipemedia' => $data->id_tipemedia,
			'id_media' => $data->id_media,
			'id_negara' => $data->id_negara,
			'id_propinsi' => $data->id_propinsi,
			'id_kota' => $data->id_kota,
			'id_negara1' => $data->id_negara1,
			'id_propinsi1' => $data->id_propinsi1,
			'id_kota1' => $data->id_kota1,
			'id_motivie' => $data->id_motivie,
			'id_etnis' => $data->id_etnis,
			'fb' => $data->fb,
			'twiter' => $data->twiter,
			'id_filter' => $data->id_filter,
			'customer_hp' => $data->customer_hp,
			'customer_tlp' => $data->customer_tlp
		);			

		die(json_encode($xdata));
		
		}
			
		function dataadd($id){	
			$data = $this->db->where('id_customer',$id)
							 ->get('db_custcomp')
							  ->row();	
		die(json_encode($data));
		}
		
		function unit($id,$proj){
		//	inner join db_reserved on id_unit = unit_id
//inner join db_customer on customer_id=id_customer
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			
			IF($pt == 44){
			$data = $this->db->where('unit_id',$id)
					//	->where('unit_id <>',0)
						 ->join('db_unitstatus','unitstatus_id = status_unit')
					//	->join('db_reserved','id_unit = unit_id')
					//	 ->join('db_customer','customer_id = customer_id')
						 ->get('db_unit_yogya')
						 ->row();
			}
			ELSE{
			$data = $this->db->where('unit_id',$id)
						 ->join('db_unitstatus','unitstatus_id = status_unit')
						 ->get('db_unit_bdm')
						 ->row();
			}
			
			
			
			
			
			
			
			
			$sqcek = $this->db->where('id_subproject',$proj)
							  ->order_by('no_sp','desc')
							  ->get('db_sp')->row();
			#var_dump(@$sqcek->no_sp);
			if(@$sqcek->no_sp == NULL) $nosp = 0;
			else $nosp = $sqcek->no_sp;
			if ($pt == 44){
			$noakhir = $nosp + 1;
			}else{
			$noakhir = substr($nosp,6,4) + 1;
			}
							   
			//$noakhir = $nosp + 1;
			#var_dump($noakhir);exit;
			if($noakhir > 99){
				$noakhir = $noakhir;
			}elseif($noakhir > 9 && $noakhir < 100){
				$noakhir = "0".$noakhir;
			}else{
				$noakhir = "00".$noakhir;
			}				  
			
			$lnti = substr($data->unit_no,4,2);
			
			$xdata = array 
			(
				'view_unit'=> $data->view_unit,
				'tanah'=> $data->tanah,
				'bangunan' => $data->bangunan,
				'unitstatus_nm' => $data->unitstatus_nm,
				'unit_no'=> $lnti,
				'noakhir'=>$noakhir,
				'pricelist' => number_format($data->pricelist_ppn)
			//	'customer_nama' => $data->customer_nama
			);			
			die(json_encode($xdata));
		}
		
		function bf($id){
					$session_id = $this->UserLogin->isLogin();
					$this->user_account = $session_id['username'];
					$this->user_id = $session_id['id'];
					$this->pt_id = $session_id['id_pt'];
		
				if  ($this->pt_id == 66){
				$data = $this->db->where('paytipe_id',$id)
						->where('paytipe_id >=', 4)
						->get('db_paytipe')
						->row();
				}else{
				$data = $this->db->where('paytipe_id',$id)
						->get('db_paytipe')
						->row();				
				}
						
		 die(json_encode($data));
		}
		
		function pricelistbdm($id,$pricelistbdm,$discount,$adddisc,$luasbdm){
		
				$sql = $this->db->query("sp_pricelistbdm ".$id.",".replace_numeric($pricelistbdm).",".$discount.",".$adddisc.",".replace_numeric($luasbdm)."")->row(); 
				die(json_encode($sql));
		}
		
		function dp($id,$proj){
				$data = $this->db->select('paytipedp_id id, paytipe_dp nama')
									->where('id_subproject',$proj)
									->where('id_paytipe',$id)
									->get('db_paytipedp')
									->result();
		 die(json_encode($data));
		}
		
		
		function pl($id,$proj){
				$data = $this->db->select('paytipe_pl id, paytipe_pl nama')
									->where('id_subproject',$proj)
									->where('id_paytipe',$id)
									->order_by('paytipe_pl','asc')
									->get('db_paytipepl')
									->result();
						
						
						
		 die(json_encode($data));
		}
		
		function salesplan($proj){
					// $data = $this->db->select('*')
						// ->get('db_saleplan')
						// ->row();
						$session_id = $this->UserLogin->isLogin();
						$idpt = $session_id['id_pt'];
						$iduser =  $session_id['id'];
						
	
						//IF($idpt == 11){
						$tglsp  = date("Y-m-d");
						
						//die ($tglsp);
						$data = $this->db->select('discount, adddisc')
										->where('strart_date <=',$tglsp)
										->where('end_date >=',$tglsp)
										->get('db_salesplan_bdm')
										->row();
										 die(json_encode($data));
							//			}
				
						// die(json_encode($sql));
		
			
		}
		
		function cekprice(){
			$phase = $this->input->post('phase');
			$tipepl = $this->input->post('tipepl');
			$unit = $this->input->post('tipepl');
			$paytipe = $this->input->post('paytipe');
			#die($unit."-".$phase."-".$tipepl."-".$paytipe);
			$rows = $this->db->where('id_unit',$unit)
							 ->where('id_paytipe',$paytipe)	
						     ->where('id_paytipepl',$tipepl)
						     ->where('phase',$phase)
						     ->get('db_unitprice')->row();
			die(number_format($rows->pricelist_ppn));
		} 
		
		
		function addbdm(){
		
		$this->load->view("sales/spcustomer-bdm");		
		
		}
		
		
		
		
		function insertcustomer(){
			extract(PopulateForm());
			
			$disc2 = 0;
			list($d,$m,$y) = split("-",$spdate);
			list($d1,$m1,$y1) = split("-",$bfdate);
			list($d2,$m2,$y2) = split("-",$pldate);
			list($d3,$m3,$y3) = split("-",$dpdate);
			#sales date			
			$spdate = $y."-".$m."-".$d;
			$bfdate = $y1."-".$m1."-".$d1;
			$pldate = $y2."-".$m2."-".$d2;
			$dpdate = $y3."-".$m3."-".$d3;			

			
			
			#Validation Generate SP
			
			#Cek Validation Phase
			$sql = "select * from db_salesplan where '$spdate' between strartdate and enddate";
			$rows = $this->db->query($sql)->row();
			
			
			if($subproject=='41013'){ 
			$pcek=2;
			$phase=2;
			}else if($subproject=='41014'){
			$pcek=1;
			$phase=1;
			}else{
			$pcek = @$rows->phase;
			
			}
			
			
			
		
			
			$cek_view = "select * from db_unit_yogya where unit_id='$unit' ";
			$cek_view2 = $this->db->query($cek_view)->row();
			$view_result = @$cek_view2->id_view;
			
			
		
			
			//var_dump($luas_result);
			//die($luas_result);
			
			#Update cara pelunasan
			$paypl = $paytipepl;
			/*if($paytipepl == 2) $paypl = 12;
			elseif($paytipepl == 3) $paypl = 24;
			elseif($paytipepl == 5) $paypl = 18;			
			else $paypl = $paytipepl;*/

			#Cek Data Sales Plan Perphase
			// $cekrow = $this->db->where('phase',$phase)
							   // ->where('id_paytipe',$paytipe)
							   // ->where('id_paytipepl',$paypl)
							   // ->where('id_subproject',$subproject)
							   // ->get('db_salesplan')->num_rows();
			// #die($phase.' '.$paytipe.' '.$paypl);
			// #var_dump($cekrow);exit();
			// if($cekrow <= 0){
				// die("Tidak Ada Sales Plan Master");
			// }
			
			if($subproject=='41013'){ 
			
			$cekrow = $this->db->where('phase',$phase)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							  ->where('id_view',$view_result)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			}else{
			$cekrow = $this->db->where('phase',$phase)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			
			
			}

			
			#Cek Data Unit Perphase
			// $dtphase = $this->db->where('id_paytipepl',$paypl)
								// ->where('id_paytipe',$paytipe)
								// ->where('id_subproject',$subproject)
								// ->where('flag !=',2)
								// ->order_by('phase','ASC')
								// ->get('db_salesplan')->row();
								
			if($subproject=='41013'){
			$dtphase = $this->db->where('id_paytipepl',$paypl)
								->where('id_paytipe',$paytipe)
								->where('id_subproject',$subproject)
								->where('id_view',$view_result)
								->where('flag !=',2)
								->order_by('phase','ASC')
								->get('db_salesplan')->row();
								
			}else{
			$dtphase = $this->db->where('id_paytipepl',$paypl)
								->where('id_paytipe',$paytipe)
								->where('id_subproject',$subproject)
								//->where('id_view',$view_result)
								->where('flag !=',2)
								->order_by('phase','ASC')
								->get('db_salesplan')->row();
			}

			#Mendapatkan Nilai Phase Terakhir
			$lastphase = $dtphase->phase;
			$qtyphase = $dtphase->qty; #Jumlah Unit

			
			#Mendapatkan Jumlah jual di SP
			$dtjual = $this->db->select('count(id_paytipe) as unitjual')
							   ->where('id_paytipepl',$paypl)
							   ->where('id_paytipe',$paytipe)
							   ->where('phase',$lastphase)
							   ->where('id_subproject',$subproject)
							   ->get('db_sp')->row();
			$qtyjual = $dtjual->unitjual;
			
			#var_dump($qtyjual);exit;
			
			#Cek unit phase terakhir
			if($qtyjual > $qtyphase){
				$data = array 
				(
					'flag' => 2
				);

				$this->db->where('id_paytipepl',$paypl);
				$this->db->where('id_paytipe',$paytipe);
				$this->db->where('phase ',$lastphase);
				$this->db->where('id_subproject',$subproject);
				$this->db->update('db_salesplan',$data);
			}
					  
			#Diskon Master
			$xdisc1 = @$dtphase->maxdisc;
			$xdisc2 = @$dtphase->adddisc;
			$xtotdisc = $xdisc1 + $xdisc2;
			$totdisc = $disc1 + $disc2;
			

			
			#abs(ceil((strtotime($date)-strtotime("now"))/86400));
			$sp = abs(ceil(strtotime($spdate)/86400));
			$bf = abs(ceil(strtotime($bfdate)/86400));
			$pl = abs(ceil(strtotime($pldate)/86400));
			$dp = abs(ceil(strtotime($dpdate)/86400));
			
			$xdp = $dp - $bf;
			$xpl = $pl - $dp;
			#die(number_format($ajuan1)."-".number_format($ajuan2)."-".number_format($ajuan3));

			#validasi psqm
			$psqm = @$dtphase->amount_m2;
			$paysqm = replace_numeric($payment);
			#var_dump($psqm."-".$paysqm);
			#Cek Validasi#
			
			if(@$pcek != $phase){
				die("Tolong Cek lagi tanggal SP Date");
			#}elseif($totdisc > $xtotdisc){
				#die("Tolong Cek diskon anda");
			}elseif($bf < $sp){
				die("Tolong Cek booking fee anda");
			}elseif($dp < $bf){
				die("Tolong Cek down payment anda");
			}elseif($pl < $dp){
				die("Tolong Cek pelunasan anda");
			}elseif($xdp > 14){
				die("DP tidak boleh 14 hari dari BF");
			//}elseif($xpl > 30){
				//die("PL tidak boleh lebih 1 bulan dari DP");								
			}elseif($paysqm < $psqm){
				die("Cek harga psqm lebih kecil");																
			}else{
				#Cek Harga Sales
				$row1 = $this->db->where('setting_id',1)
								->get('db_setting')->row();
				$row2 = $this->db->where('setting_id',2)
								->get('db_setting')->row();
				$row3 = $this->db->where('setting_id',3)
								->get('db_setting')->row();

				#Ambil phase Terakhir
				$xrows = $this->db->where('id_paytipepl',$paypl)
								 ->where('id_paytipe',$paytipe)
								 ->where('id_subproject',$subproject)
								 ->get('db_salesplan')->row();				
				$xphase = $xrows->phase;
				#var_dump($xphase);exit;								
				#Banyak DP
				$cekpaydp = $this->db->where('paytipedp_id',$paytipedp)
									 ->get('db_paytipedp')->row();

				$jdp = $cekpaydp->paytipe_dp;
				
				//Tunai Pelunasan 3 x
				if(@$paytipe==1){
					$jdp = $jdp;
					$jpl = $paypl;
				}else{
					if($paypl > 1)
						$jpl = $paypl - $jdp;
					else
						$jpl = $paypl;

				}

				
						
				
				#var_dump($jpl);exit;

				#Setting Master#
				$xbf  = $row1->setting_am;
				$xdp  = $row2->setting_am;
				$xpln = $row3->setting_am;
				#End Setting Master#
				
				#Cek Harga 
				$soldprice = replace_numeric($soldprice);
				$taxamount = replace_numeric($taxamount);
				$mprice = replace_numeric($mprice);
				$pricehid = replace_numeric($pricehid);

				#$sisaprice = $soldprice -  $xbf;
				$dp    =   ($soldprice * ($xdp/100)) - $xbf;
				$lunas =   $soldprice * ($xpln/100);
				$mdp = $dp / $jdp;
				$mlunas = $lunas / $jpl;
				$discamount = replace_numeric($discamount);
				#var_dump($mdp);exit;
				#Belum ada
				$discount2 = 0;
				$ho_date = "2014-01-01";
				#var_dump($paypl);exit;
				#update Customer
				$iduser = $this->user_id;
				$idpt = $this->pt_id;
				$id = $nama;
				$idflag = 1;
				//$disc1=0;
				#var_dump($idbisnis);exit;
				$query = $this->db->query("UpdateCustomerBuyer '".$idfilter."','".$idgroup."','".$customernama."','".$customertgllhr."',
				'".$customertmptlhr."','".$idagama."','".@$idkarysek."','".$customerstatus."','".$profesi."','".$hp."',
				'".$customertlp."','".$customerfax."','".$idtipe."','".$id_number."','".$email."','".$npwp."','".$tipemedia."','".$media."',
				'".$motivie."','".$customeralamat1."','".$negara."','".$propinsi."','".$kota."','".$kdpos."','".$customeralamat2."','".$negara1."',
				'".$propinsi1."','".$kota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
				'".$etnis."','".$fb."','".$twiter."','".$custcompnm."','".@$idbisnis."','".$custcompalamat."','".$custcomphp."',
				'".$custcompfax."','".$custcompnpwp."','".$id."'");	
				
				#Insert SP
				$query = $this->db->query("sp_cetak_surat_pesanan '".$spno."','".$spdate."','".$bfdate."',
				'".$dpdate."','".$pldate."',".$xbf.",".$dp.",".$lunas.",".$mlunas.",".$mdp.",
				".$jdp.",".$jpl.",".$nama.",'".$subproject."','".$unit."',
				".$soldprice.",".$taxamount.",".$pricehid.",".$paytipe.",".$disc1.",
				".$disc2.",".$salesname.",".$discount2.",".$discamount.",".$xphase.",
				'".$ho_date."',".$iduser.",".$mprice.",".$paypl.",'".$idpt."','".$salesagen."'");
								
				#$this->load->view('spcustomer/surat_pesanan');																
				die("sukses");
				
			}

		
		}
		
		function insertcustomerbdm(){
			extract(PopulateForm());
			
			//$disc2 = 0;
			list($d,$m,$y) = split("-",$spdate);
			list($d1,$m1,$y1) = split("-",$bfdate);
			list($d2,$m2,$y2) = split("-",$pldate);
			list($d3,$m3,$y3) = split("-",$dpdate);
			#sales date			
			$spdate = $y."-".$m."-".$d;
			$bfdate = $y1."-".$m1."-".$d1;
			$pldate = $y2."-".$m2."-".$d2;
			$dpdate = $y3."-".$m3."-".$d3;			

			
			
			#Validation Generate SP
			
			#Cek Validation Phase
			$sql = "select * from db_salesplan where id_subproject='$subproject' and '$spdate' between strartdate and enddate";
			$rows = $this->db->query($sql)->row();
			$pcek = @$rows->phase;
			
			
			// $cek_luas = "select  * from db_unit_bdm where unit_id='$unit' ";
			// $cek_luas2 = $this->db->query($cek_luas)->row();
			// $luas_result = $cek_luas2->id_luas;
			
			$cek_luas = $this->db->select('id_luas as id')
												->where('unit_id',$unit)
												->get('db_unit_bdm')->row();				
			
			
			//var_dump($cek_luas);
			// #Update cara pelunasan
			 $paypl = $paytipepl;
			// /*if($paytipepl == 2) $paypl = 12;
			// elseif($paytipepl == 3) $paypl = 24;
			// elseif($paytipepl == 5) $paypl = 18;			
			// else $paypl = $paytipepl;*/

			// #Cek Data Sales Plan Perphase
			if($subproject=='3102'){ 
			$phase=3;
			$cekrow = $this->db->where('phase',$phase)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							  ->where('id_luas',$cek_luas->id)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			}else if($subproject=='11214'){ 
			$phase=4;
			$cekrow = $this->db->where('phase',$phase)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							  ->where('id_luas',$cek_luas->id)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			}else if($subproject=='61011'){ 
			$phase=1;
			$cekrow = $this->db->where('phase',$phase)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							  ->where('id_luas',$cek_luas->id)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			}else if($subproject=='11204'){ 
			$phase=4;
			$cekrow = $this->db->where('phase',$phase)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							  ->where('id_luas',$cek_luas->id)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			}else{
			$pcek=3;
			$cekrow = $this->db->where('phase',$pcek)
							   ->where('id_paytipe',$paytipe)
							   ->where('id_paytipepl',$paypl)
							   ->where('id_subproject',$subproject)
							   ->get('db_salesplan')->num_rows();
			#die($phase.' '.$paytipe.' '.$paypl);
			#var_dump($cekrow);exit();
			if($cekrow <= 0){
				die("Tidak Ada Sales Plan Master");
			}
			}
			
			#Cek Data Unit Perphase
			$dtphase = $this->db->where('id_paytipepl',$paypl)
								->where('id_paytipe',$paytipe)
								->where('id_subproject',$subproject)
								->where('flag !=',2)
								->where('id_luas',$cek_luas->id)
								->order_by('phase','ASC')
								->get('db_salesplan')->row();

			#Mendapatkan Nilai Phase Terakhir
			$lastphase = $dtphase->phase;
			$qtyphase = $dtphase->qty; #Jumlah Unit
			
			//var_dump($lastphase);

			
			// #Mendapatkan Jumlah jual di SP
			$dtjual = $this->db->select('count(id_paytipe) as unitjual')
							   ->where('id_paytipepl',$paypl)
							   ->where('id_paytipe',$paytipe)
							   ->where('phase',$lastphase)
							   ->where('id_subproject',$subproject)
							   ->get('db_sp')->row();
			$qtyjual = $dtjual->unitjual;
			
			#var_dump($qtyjual);exit;
			
			#Cek unit phase terakhir
			if($qtyjual > $qtyphase){
				$data = array 
				(
					'flag' => 2
				);

				$this->db->where('id_paytipepl',$paypl);
				$this->db->where('id_paytipe',$paytipe);
				$this->db->where('phase ',$lastphase);
				$this->db->where('id_subproject',$subproject);
				$this->db->update('db_salesplan',$data);
			}
					  
			#Diskon Master
			$xdisc1 = @$dtphase->maxdisc;
			$xdisc2 = @$dtphase->adddisc;
			$xtotdisc = $xdisc1 + $xdisc2;
			$totdisc = $disc1 + $disc2;
			

			
			#abs(ceil((strtotime($date)-strtotime("now"))/86400));
			$sp = abs(ceil(strtotime($spdate)/86400));
			$bf = abs(ceil(strtotime($bfdate)/86400));
			$pl = abs(ceil(strtotime($pldate)/86400));
			$dp = abs(ceil(strtotime($dpdate)/86400));
			
			$xdp = $dp - $bf;
			$xpl = $pl - $dp;
			#die(number_format($ajuan1)."-".number_format($ajuan2)."-".number_format($ajuan3));

			#validasi psqm
			$psqm = @$dtphase->amount_m2;
			$paysqm = replace_numeric($payment);
			//var_dump($psqm."-".$paysqm);
			#Cek Validasi#
			
			// if(@$pcek != $phase){
				// die("Tolong Cek lagi tanggal SP Date");

			// }else
			if($bf < $sp){
				die("Tolong Cek booking fee anda");
			}elseif($dp < $bf){
				die("Tolong Cek down payment anda");
			}elseif($pl < $dp){
				die("Tolong Cek pelunasan anda");
			}elseif($xdp > 14){
				die("DP tidak boleh 14 hari dari BF");
			//}elseif($xpl > 30){
				//die("PL tidak boleh lebih 1 bulan dari DP");								
			}elseif($paysqm < $psqm){
				die("Cek harga psqm lebih kecil");																
			}else{
				#Cek Harga Sales
				$row1 = $this->db->where('setting_id',1)
								->get('db_setting')->row();
				$row2 = $this->db->where('setting_id',2)
								->get('db_setting')->row();
				$row3 = $this->db->where('setting_id',3)
								->get('db_setting')->row();

				#Ambil phase Terakhir
				$tglsp  = date("Y-m-d");
						
									 
				$xrows = $this->db->select('phase')
										->where('strartdate <=',$tglsp)
										->where('enddate >=',$tglsp)
										->get('db_salesplan')
										->row();	
				$xphase = $xrows->phase;
				#var_dump($xphase);exit;								
				#Banyak DP
				$cekpaydp = $this->db->where('paytipedp_id',$paytipedp)
									 ->get('db_paytipedp')->row();

				//tambah bintaro					 
									 
				if($subproject=='61011'){ 				
				$jdp = $paytipedp;
				}else{
				$jdp = $cekpaydp->paytipe_dp;			
				}
									 
				
				
				//Tunai Pelunasan 3 x
				if(@$paytipe==1){
					$jdp = $jdp;
					$jpl = $paypl;
				}else{
					if($paypl > 1)
						$jpl = $paypl - $jdp;
					else
						$jpl = $paypl;

				}
				
	
				

				
						
				
				#var_dump($jpl);exit;

				#Setting Master#
				//tambah bintaro
				
				if($subproject=='61011'){ 				
				$xbf  = 10000000;
				}else{
				$xbf  = $row1->setting_am;				
				}
				// $xdp  = $row2->setting_am;
				// $xpln = $row3->setting_am;
				$xdp  = $persendp;
				$xpln = 100-$persendp;
				#End Setting Master#
				
				#Cek Harga 
				$soldprice = replace_numeric($soldprice);
				$taxamount = replace_numeric($taxamount);
				$mprice = replace_numeric($mprice);
				$pricehid = replace_numeric($pricehid);

				#$sisaprice = $soldprice -  $xbf;
				if  ($xdp == 0){
				$dp    =  0;				
				$lunas =   $soldprice -10000000; 
				}else{				
				$dp    =   ($soldprice * ($xdp/100)) - $xbf;
				$lunas =   $soldprice * ($xpln/100);
				}
				
				
				//tambah bintaro
				if ($jdp == 0){
				$mdp = 0;
				//$mlunas = $lunas / ($jpl-1);
				$mlunas = $lunas / ($jpl);
				}else{
				$mdp = $dp / $jdp;
				$mlunas = $lunas / $jpl;
				}
				
				$discamount = replace_numeric($discamount);
				//var_dump($jpl);exit;
				#Belum ada
				$discount2 = 0;
				$ho_date = "2014-01-01";
				#var_dump($paypl);exit;
				#update Customer
				$iduser = $this->user_id;
				$idpt = $this->pt_id;
				$id = $nama;
				$idflag = 1;
				$xphase = 1;
				#var_dump($idbisnis);exit;
				$query = $this->db->query("UpdateCustomerBuyer '".$idfilter."','".$idgroup."','".$customernama."','".$customertgllhr."',
				'".$customertmptlhr."','".$idagama."','".@$idkarysek."','".$customerstatus."','".$profesi."','".$hp."',
				'".$customertlp."','".$customerfax."','".$idtipe."','".$id_number."','".$email."','".$npwp."','".$tipemedia."','".$media."',
				'".$motivie."','".$customeralamat1."','".$negara."','".$propinsi."','".$kota."','".$kdpos."','".$customeralamat2."','".$negara1."',
				'".$propinsi1."','".$kota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
				'".$etnis."','".$fb."','".$twiter."','".$custcompnm."','".@$idbisnis."','".$custcompalamat."','".$custcomphp."',
				'".$custcompfax."','".$custcompnpwp."','".$id."'");	
				
				#Insert SP
				$query = $this->db->query("sp_cetak_surat_pesanan '".$spno."','".$spdate."','".$bfdate."',
				'".$dpdate."','".$pldate."',".$xbf.",".$dp.",".$lunas.",".$mlunas.",".$mdp.",
				".$jdp.",".$jpl.",".$nama.",'".$subproject."','".$unit."',
				".$soldprice.",".$taxamount.",".$pricehid.",".$paytipe.",".$disc1.",
				".$adddisc.",".$salesname.",".$discount2.",".$discamount.",".$xphase.",
				'".$ho_date."',".$iduser.",".$mprice.",".$paypl.",'".$idpt."','".$salesagen."'");
								
				#$this->load->view('spcustomer/surat_pesanan');																
				die("sukses");
				
			}

		
		}
		
		function insertcustomerbdm2(){
			extract(PopulateForm());
			
			//$disc2 = 0;
			list($d,$m,$y) = split("-",$spdate);
			list($d1,$m1,$y1) = split("-",$bfdate);
			list($d2,$m2,$y2) = split("-",$pldate);
			list($d3,$m3,$y3) = split("-",$dpdate);
			#sales date			
			$spdate = $y."-".$m."-".$d;
			$bfdate = $y1."-".$m1."-".$d1;
			$pldate = $y2."-".$m2."-".$d2;
			$dpdate = $y3."-".$m3."-".$d3;			

			
			
			#Validation Generate SP
			
			#Cek Validation Phase
			// $sql = "select * from db_salesplan where '$spdate' between strartdate and enddate";
			// $rows = $this->db->query($sql)->row();
			// $pcek = @$rows->phase;
			
			// #Update cara pelunasan
			 $paypl = $paytipepl;
			// /*if($paytipepl == 2) $paypl = 12;
			// elseif($paytipepl == 3) $paypl = 24;
			// elseif($paytipepl == 5) $paypl = 18;			
			// else $paypl = $paytipepl;*/

			// #Cek Data Sales Plan Perphase
			// $cekrow = $this->db->where('phase',$phase)
							   // ->where('id_paytipe',$paytipe)
							   // ->where('id_paytipepl',$paypl)
							   // ->where('id_subproject',$subproject)
							   // ->get('db_salesplan')->num_rows();
			// #die($phase.' '.$paytipe.' '.$paypl);
			// #var_dump($cekrow);exit();
			// if($cekrow <= 0){
				// die("Tidak Ada Sales Plan Master");
			// }

			
			#Cek Data Unit Perphase
			// $dtphase = $this->db->where('id_paytipepl',$paypl)
								// ->where('id_paytipe',$paytipe)
								// ->where('id_subproject',$subproject)
								// ->where('flag !=',2)
								// ->order_by('phase','ASC')
								// ->get('db_salesplan')->row();

			// #Mendapatkan Nilai Phase Terakhir
			// $lastphase = $dtphase->phase;
			// $qtyphase = $dtphase->qty; #Jumlah Unit

			
			// #Mendapatkan Jumlah jual di SP
			// $dtjual = $this->db->select('count(id_paytipe) as unitjual')
							   // ->where('id_paytipepl',$paypl)
							   // ->where('id_paytipe',$paytipe)
							   // ->where('phase',$lastphase)
							   // ->where('id_subproject',$subproject)
							   // ->get('db_sp')->row();
			// $qtyjual = $dtjual->unitjual;
			
			#var_dump($qtyjual);exit;
			
			#Cek unit phase terakhir
			// if($qtyjual > $qtyphase){
				// $data = array 
				// (
					// 'flag' => 2
				// );

				// $this->db->where('id_paytipepl',$paypl);
				// $this->db->where('id_paytipe',$paytipe);
				// $this->db->where('phase ',$lastphase);
				// $this->db->where('id_subproject',$subproject);
				// $this->db->update('db_salesplan',$data);
			// }
					  
			#Diskon Master
			$xdisc1 = @$dtphase->maxdisc;
			$xdisc2 = @$dtphase->adddisc;
			$xtotdisc = $xdisc1 + $xdisc2;
			$totdisc = $disc1 + $disc2;
			

			
			#abs(ceil((strtotime($date)-strtotime("now"))/86400));
			$sp = abs(ceil(strtotime($spdate)/86400));
			$bf = abs(ceil(strtotime($bfdate)/86400));
			$pl = abs(ceil(strtotime($pldate)/86400));
			$dp = abs(ceil(strtotime($dpdate)/86400));
			
			$xdp = $dp - $bf;
			$xpl = $pl - $dp;
			#die(number_format($ajuan1)."-".number_format($ajuan2)."-".number_format($ajuan3));

			#validasi psqm
			$psqm = @$dtphase->amount_m2;
			$paysqm = replace_numeric($payment);
			#var_dump($psqm."-".$paysqm);
			#Cek Validasi#
			
			if(@$pcek != $phase){
				die("Tolong Cek lagi tanggal SP Date");
			#}elseif($totdisc > $xtotdisc){
				#die("Tolong Cek diskon anda");
			}elseif($bf < $sp){
				die("Tolong Cek booking fee anda");
			}elseif($dp < $bf){
				die("Tolong Cek down payment anda");
			}elseif($pl < $dp){
				die("Tolong Cek pelunasan anda");
			}elseif($xdp > 14){
				die("DP tidak boleh 14 hari dari BF");
			//}elseif($xpl > 30){
				//die("PL tidak boleh lebih 1 bulan dari DP");								
			}elseif($paysqm < $psqm){
				die("Cek harga psqm lebih kecil");																
			}else{
				#Cek Harga Sales
				$row1 = $this->db->where('setting_id',1)
								->get('db_setting')->row();
				$row2 = $this->db->where('setting_id',2)
								->get('db_setting')->row();
				$row3 = $this->db->where('setting_id',3)
								->get('db_setting')->row();

				#Ambil phase Terakhir
				$tglsp  = date("Y-m-d");
						
									 
				$xrows = $this->db->select('phase')
										->where('strart_date <=',$tglsp)
										->where('end_date >=',$tglsp)
										->get('db_salesplan_bdm')
										->row();	
				$xphase = $xrows->phase;
				#var_dump($xphase);exit;								
				#Banyak DP
				$cekpaydp = $this->db->where('paytipedp_id',$paytipedp)
									 ->get('db_paytipedp')->row();

				$jdp = $cekpaydp->paytipe_dp;
				
				//Tunai Pelunasan 3 x
				if(@$paytipe==1){
					$jdp = $jdp;
					$jpl = $paypl;
				}else{
					if($paypl > 1)
						$jpl = $paypl - $jdp;
					else
						$jpl = $paypl;

				}

				
						
				
				#var_dump($jpl);exit;

				#Setting Master#
				$xbf  = $row1->setting_am;
				// $xdp  = $row2->setting_am;
				// $xpln = $row3->setting_am;
				$xdp  = $persendp;
				$xpln = 100-$persendp;
				#End Setting Master#
				
				#Cek Harga 
				$soldprice = replace_numeric($soldprice);
				$taxamount = replace_numeric($taxamount);
				$mprice = 0;
				$pricehid = replace_numeric($pricehid);

				#$sisaprice = $soldprice -  $xbf;
				$dp    =   ($soldprice * ($xdp/100)) - $xbf;
				$lunas =   $soldprice * ($xpln/100);
				$mdp = $dp / $jdp;
				$mlunas = $lunas / $jpl;
				$discamount = replace_numeric($discamount);
				#var_dump($mdp);exit;
				#Belum ada
				$discount2 = 0;
				$ho_date = "2014-01-01";
				#var_dump($paypl);exit;
				#update Customer
				$iduser = $this->user_id;
				$idpt = $this->pt_id;
				$id = $nama;
				$idflag = 1;
				$xphase = 1;
				#var_dump($idbisnis);exit;
				$query = $this->db->query("UpdateCustomerBuyer '".$idfilter."','".$idgroup."','".$customernama."','".$customertgllhr."',
				'".$customertmptlhr."','".$idagama."','".@$idkarysek."','".$customerstatus."','".$profesi."','".$hp."',
				'".$customertlp."','".$customerfax."','".$idtipe."','".$id_number."','".$email."','".$npwp."','".$tipemedia."','".$media."',
				'".$motivie."','".$customeralamat1."','".$negara."','".$propinsi."','".$kota."','".$kdpos."','".$customeralamat2."','".$negara1."',
				'".$propinsi1."','".$kota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
				'".$etnis."','".$fb."','".$twiter."','".$custcompnm."','".@$idbisnis."','".$custcompalamat."','".$custcomphp."',
				'".$custcompfax."','".$custcompnpwp."','".$id."'");	
				
				#Insert SP
				$query = $this->db->query("sp_cetak_surat_pesanan '".$spno."','".$spdate."','".$bfdate."',
				'".$dpdate."','".$pldate."',".$xbf.",".$dp.",".$lunas.",".$mlunas.",".$mdp.",
				".$jdp.",".$jpl.",".$nama.",'".$subproject."','".$unit."',
				".$soldprice.",".$taxamount.",".$pricehid.",".$paytipe.",".$disc1.",
				".$adddisc.",".$salesname.",".$discount2.",".$discamount.",".$xphase.",
				'".$ho_date."',".$iduser.",".$mprice.",".$paypl.",'".$idpt."'");
								
				#$this->load->view('spcustomer/surat_pesanan');																
				die("sukses");
				
			}

		
		}



	// function __construct(){
		// parent::__construct('spcustomer_model');
		// $this->set_page_title('List Customer');
		// $this->template_dir = 'sales/spcustomer';
		// $this->default_limit = 30;
		// $session_id = $this->UserLogin->isLogin();
		// $this->user_account = $session_id['username'];
		// $this->user_id = $session_id['id'];
		// $this->pt_id = $session_id['id_pt'];
		
	// }

	// protected function setup_form($data=false){
			// $this->load->model('spcustomer_model','customer');
			// $id = @$data->customer_id;
			// $this->parameters['cust'] = $this->customer->joinall($id);
			// #var_dump($this->parameters['cust']);
			
			// $this->parameters['kota'] = $this->db->order_by('kota_nm','asc')->get('db_kota')->result();
			// $this->parameters['agama'] = $this->db->get('db_agama')->result();
			// $this->parameters['profesi'] = $this->db->order_by('profesi_nm','asc')->get('db_profesi')->result();
			// $this->parameters['tipemedia'] = $this->db->order_by('tipemedia_nm','asc')->get('db_tipemedia')->result();
			// $this->parameters['media'] = $this->db->order_by('media_nm','asc')->get('db_media')->result();
			// $this->parameters['motivie'] = $this->db->order_by('motivie_nm','asc')->get('db_motivie')->result();
			// $this->parameters['etnis'] = $this->db->order_by('etnis_nm','asc')->get('db_etnis')->result();
			// $this->parameters['negara'] = $this->db->order_by('negara_nm','asc')->get('db_negara')->result();
			// $this->parameters['propinsi'] = $this->db->order_by('propinsi_nm','asc')->get('db_propinsi')->result();
			// #var_dump($this->parameters['negara']);
			// $this->parameters['add'] = $this->customer->additional($id);
			// #var_dump($this->parameters['add']);
			// $this->parameters['bisnis'] = $this->db->order_by('bisnis_nm','asc')->get('db_bisnis')->result();
			// $this->parameters['hubungan'] = $this->db->order_by('hubungan_nm','asc')->get('db_hubungan')->result();
			// $this->parameters['individu'] = $this->db->where('id_filter','2')->order_by('nm_group','asc')->get('db_group')->result();
			// $this->parameters['corporate'] = $this->db->where('id_filter','1')->order_by('nm_group','asc')->get('db_group')->result();
			// $this->parameters['tipecustomer'] = $this->db->select('tipecustomer_id id,tipecustomer_nm nama')
													// ->get('db_tipecustomer')
													// ->result();


			
			// $tgl = date("Y-m-d");
			// $sql = "select * from db_salesplan where '$tgl' between strartdate  and enddate";
			
			// $rows = $this->db->query($sql)->row();
			// $this->parameters['phase'] = $rows->phase;
				
	
	// }
	

	// function get_json(){
		// $this->set_custom_function('tgl_sales','indo_date');
		// parent::get_json();
	// }


	// function index(){
		// $this->set_grid_column('sp_id','ID',array('width'=>30,'hidden'=>true));
		// $this->set_grid_column('no_sp','No SP',array('width'=>15,'align'=>'Left'));
		// $this->set_grid_column('tgl_sales','SP Date',array('width'=>30,'align'=>'center'));
		// $this->set_grid_column('customer_nama','Customer Name',array('width'=>50,'align'=>'left'));
		// $this->set_grid_column('nm_subproject','Project',array('width'=>50,'align'=>'left'));
		// $this->set_grid_column('paytipe_nm','Payment Type',array('width'=>50,'align'=>'center'));
		// $this->set_jqgrid_options(array('width'=>1200,'height'=>300,'caption'=>'List Surat Pesanan','rownumbers'=>true,'sortname'=>'tgl_sales','sortorder'=>'desc'));
		// parent::index();
	// }
	
	// function surat_pesanan($nama){
		
		// $data['idnama'] = $nama;
		// //die($nama);
		// $this->load->view("sales/print/print_surat_pesanan",$data);		
	// }
	
	// function InsertSP(){
			// extract(PopulateForm());
			// $session_id = $this->UserLogin->isLogin();
			// $idpt = $session_id['id_pt'];
			// $iduser =  $session_id['id'];
			// $idflag ='1';
			// $idproject='1111';
			
			// #$idpt =2;
			// #$iduser = 1;
			// $tgl=inggris_date($customertgllhr);
			
			
			// $query = $this->db->query("UpdateCustomerBuyer '".$idfilter."','".$idgroup."','".$customernama."','".$tgl."',
			// '".$customertmptlhr."','".$idagama."','".$idkarysek."','".$customerstatus."','".$profesi."','".$hp."',
			// '".$customertlp."','".$customerfax."','".$idtipe."','".$id_number."','".$email."','".$npwp."','".$tipemedia."','".$media."',
			// '".$motivie."','".$customeralamat1."','".$negara."','".$propinsi."','".$kota."','".$kdpos."','".$customeralamat2."','".$negara1."','".$propinsi1."'
			// ,'".$kota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
			// '".$etnis."','".$fb."','".$twiter."','".$custcompnm."','".@$idbisnis."','".$custcompalamat."','".$custcomphp."',
			// '".$custcompfax."','".$custcompnpwp."','".$id."'");
			
			
			
			// $query = $this->db->query("InputSP ".$spdate.",".$spno.",'".$nama."','".$subproject."',
			// ".$unit.",".$soldprice.",".$taxamount.",'".$taxppn."',".$paytipe.",'".$disc1."',
			// '".$adddisc."','".$salesname."','".$disc2."','".$discamount."','".$iduser."'");
		
				
			// $query = $this->db->query("InputBilling '".$salesname."','".$tgl."','".$id_paygroup."','".$amount."',
			// '".$duedate."'");
			
			// $query = $this->db->query("InputBilling '".$salesname."','".$tgl."','".$id_paygroup."','".$amount."',
			// '".$duedate."'");
		
		
			// $sukses = 4;
			// die(json_encode($sukses));
	// }
	
	// function UpdateCustomer(){
	
	// }
	
			// function loaddata(){
			// $session_id = $this->UserLogin->isLogin();
			// $idpt = $session_id['id_pt'];
			// $iduser =  $session_id['id'];
			
			
			// if($this->input->post('data_type')){
				// $data_type = $this->input->post('data_type');
				// $parent_id = $this->input->post('parent_id');
				// switch($data_type){
					// case 'tipecustomer':
						// $sql = $this->db->select('tipecustomer_id id,tipecustomer_nm nama')
										// ->get('db_tipecustomer')
										// ->result();
						// break;
						
					// case 'nama':
						// $sql = $this->db->select('customer_id id,customer_nama nama')
										// ->where('fu_stat',$parent_id)
										// ->order_by('customer_nama','asc')
										// ->get('db_customer')
										// ->result();
						// break;
						
					// case 'group':
						// $sql = $this->db->select('group_id id,nm_group nama')
										// ->where('id_filter','1')
										// ->get('db_group')
										// ->result();
						// break;
					// case 'agama':
						// $sql = $this->db->select('agama_id id,agama_nm nama')
										// ->get('db_agama')
										// ->result();
						// break;
					
					// case 'motivie':
						// $sql = $this->db->select('motivie_id id,motivie_nm nama')
										// ->order_by('motivie_nm','asc')
										// ->get('db_motivie')
										// ->result();
						// break;
					// case 'negara':
						// $sql = $this->db->select('negara_id id,negara_nm nama')
										// ->get('db_negara')
										// ->result();
						// break;
					// case 'propinsi':
						// $sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										// ->order_by('propinsi_nm','asc')
										// ->get('db_propinsi')
										// ->result();
						// break;
					// case 'kota':
						// $sql = $this->db->select('kota_id id,kota_nm nama')
										// ->where('id_propinsi',$parent_id)
										// ->order_by('kota_nm','asc')
										// ->get('db_kota')
										// ->result();
						// break;
						
					// case 'profesi':
						// $sql = $this->db->select('profesi_id id,profesi_nm nama')
										// ->order_by('profesi_nm','asc')
										// ->get('db_profesi')
										// ->result();
						// break;
					// case 'tmplhr':
						// $sql = $this->db->select('kota_id id,kota_nm nama')
										// ->order_by('kota_nm','asc')
										// ->get('db_kota')
										// ->result();
						// break;
					// case 'tipeindividu':
						// $sql = $this->db->select('group_id id,nm_group nama')
										// ->where('id_filter','2')
										// ->order_by('nm_group','asc')
										// ->get('db_group')
										// ->result();
						// break;
					// case 'tipemedia':
						// $sql = $this->db->select('tipemedia_id id,tipemedia_nm nama')
										// ->order_by('tipemedia_nm','asc')
										// ->get('db_tipemedia')
										// ->result();
						// break;
					// case 'media':
						// $sql = $this->db->select('media_id id,media_nm nama')
										// ->order_by('media_nm','asc')
										// ->get('db_media')
										// ->result();
						// break;
					// case 'bisnis':
						// $sql = $this->db->select('bisnis_id id,bisnis_nm nama')
										// ->order_by('bisnis_nm','asc')
										// ->get('db_bisnis')
										// ->result();
						// break;
					// case 'hubungan':
						// $sql = $this->db->select('hubungan_id id,hubungan_nm nama')
										// ->order_by('hubungan_nm','asc')
										// ->get('db_hubungan')
										// ->result();
						// break;
					// case 'etnis':
						// $sql = $this->db->select('etnis_id id,etnis_nm nama')
										// ->order_by('etnis_nm','asc')
										// ->get('db_etnis')
										// ->result();
						// break;
					// case 'negara1':
						// $sql = $this->db->select('negara_id id,negara_nm nama')
										// ->get('db_negara')
										// ->result();
						// break;
					// case 'propinsi1':
						// $sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										// ->order_by('propinsi_nm','asc')
										// ->get('db_propinsi')
										// ->result();
						// break;
					// case 'kota1':
						// $sql = $this->db->select('kota_id id,kota_nm nama')
										// ->where('id_propinsi',$parent_id)
										// ->order_by('kota_nm','asc')
										// ->get('db_kota')
										// ->result();
						// break;
					// case 'individu':
						// $sql = $this->db->select('group_id id,nm_group nama')
										// ->where('id_filter','2')
										// ->order_by('nm_group','asc')
										// ->get('db_group')
										// ->result();
						// break;
					// case 'corporate':
						// $sql = $this->db->select('group_id id,nm_group nama')
										// ->where('id_filter','1')
										// ->order_by('nm_group','asc')
										// ->get('db_group')
										// ->result();
						// break;
					// case 'customerstatus':
						// $sql = $this->db->select('marital_id id,marital_nm nama')
										// ->get('db_marital')
										// ->result();
						// break;
					
					// case 'idtipe':
						// $sql = $this->db->select('identitas_id id,identitas_nm nama')
										// ->get('db_identitas')
										// ->result();
						// break;
						
					// case 'subproject':
						// $sql = $this->db->select('subproject_id id,nm_subproject nama')
										// ->where('id_pt',$idpt)
										// ->get('db_subproject')
										// ->result();
						// break;
					
					// case 'unit':
						// $sql = $this->db->select('unit_id id,unit_no nama')
										// ->where('id_subproject',$parent_id)
										// #->where('status_unit',1)
										// ->where('status_unit',2)
										// ->order_by('unit_no','ASC')
										// ->get('db_unit_yogya')
										// ->result();
						// break;
					
					// case 'paytipe':
						// $sql = $this->db->select('paytipe_id id,paytipe_nm nama')
										// ->get('db_paytipe')
										// ->result();
						// break;
						
					// #case 'paytipepl':
					// #	$sql = $this->db->select('paytipepl_id id,paytipe_pl nama')
					// #					->where('id_paytipe',$parent_id)
					// #					->get('db_paytipepl')
					// #					->result();
					// #	break;
					
					// case 'paytipedp':
						// $sql = $this->db->select('paytipedp_id id,paytipe_dp nama')
										// ->where('id_paytipe',$parent_id)
										// ->get('db_paytipedp')
										// ->result();
						// break;
						
					// case 'salessources':
						// $sql = $this->db->select('salessource_id id,salessource_nm nama')
										// ->get('db_sales_sources')
										// ->result();
						// break;
					
					// case 'salesname':
						// $sql = $this->db->select('id_kary id,nama nama')
										// ->where('id_sales',$parent_id)
										// ->get('db_kary')
										// ->result();
						// break;
					// case 'discount':
						// $sql = $this->db->select('unitdisc_id id,unitdisc_nm nama')
										// ->get('db_unitdisc')
										// ->result();
						// break;
					
					
				// }
				// $response = array();
				// if($sql){
					// foreach($sql as $row){
						// $response[] = $row;
					// }
				// }
				// die(json_encode($response));
			// }
		// }
	
		// function data($id){
		
		// $data = $this->db->join('db_kota','id_kota = kota_id','left')
						// ->where('customer_id',$id)
						// ->get('db_customer')
						// ->row();

						
		// $xdata = array 
		// (
			// 'customer_nama' => $data->customer_nama,
			// 'customer_tgl_lhr' => indo_date($data->customer_tgl_lhr),
			// 'customer_fax' => $data->customer_fax,
			// 'email' => $data->email,
			// 'npwp' => $data->npwp,
			// 'id_no' => $data->id_no,
			// 'customer_alamat1' => $data->customer_alamat1,
			// 'customer_alamat2' => $data->customer_alamat2,
			// 'kdpos' => $data->kdpos,
			// 'kdpos1' => $data->kdpos1,
			// 'customer_tmpt_lhr' => $data->customer_tmpt_lhr,
			// 'id_karysek' => $data->id_karysek,
			// 'customer_status' => $data->customer_status,
			// 'id_profesi' => $data->id_profesi,
			// 'id_tipe' => $data->id_tipe,
			// 'id_tipemedia' => $data->id_tipemedia,
			// 'id_media' => $data->id_media,
			// 'id_negara' => $data->id_negara,
			// 'id_propinsi' => $data->id_propinsi,
			// 'id_kota' => $data->id_kota,
			// 'id_negara1' => $data->id_negara1,
			// 'id_propinsi1' => $data->id_propinsi1,
			// 'id_kota1' => $data->id_kota1,
			// 'id_motivie' => $data->id_motivie,
			// 'id_etnis' => $data->id_etnis,
			// 'fb' => $data->fb,
			// 'twiter' => $data->twiter,
			// 'id_filter' => $data->id_filter,
			// 'customer_hp' => $data->customer_hp,
			// 'customer_tlp' => $data->customer_tlp
		// );			

		// die(json_encode($xdata));
		
		// }
			
		// function dataadd($id){	
			// $data = $this->db->where('id_customer',$id)
							 // ->get('db_custcomp')
							  // ->row();	
		// die(json_encode($data));
		// }
		
		// function unit($id,$proj){
			// $data = $this->db->where('unit_id',$id)
						 // ->join('db_unitstatus','unitstatus_id = status_unit')
						 // ->get('db_unit_yogya')
						 // ->row();
						 
			// $sqcek = $this->db->where('id_subproject',$proj)
							  // ->order_by('no_sp','desc')
							  // ->get('db_sp')->row();
			// #var_dump(@$sqcek->no_sp);
			// if(@$sqcek->no_sp == NULL) $nosp = 0;
			// else $nosp = $sqcek->no_sp;
							   
			// $noakhir = $nosp + 1;
			// #var_dump($noakhir);exit;
			// if($noakhir > 99){
				// $noakhir = $noakhir;
			// }elseif($noakhir > 9 && $noakhir < 100){
				// $noakhir = "0".$noakhir;
			// }else{
				// $noakhir = "00".$noakhir;
			// }				  
			
			// $lnti = substr($data->unit_no,4,2);
			
			// $xdata = array 
			// (
				// 'view_unit'=> $data->view_unit,
				// 'tanah'=> $data->tanah,
				// 'bangunan' => $data->bangunan,
				// 'unitstatus_nm' => $data->unitstatus_nm,
				// 'unit_no'=> $lnti,
				// 'noakhir'=>$noakhir,
				// 'pricelist' => number_format($data->pricelist_ppn)
			// );			
			// die(json_encode($xdata));
		// }
		
		// function bf($id){
				// $data = $this->db->where('paytipe_id',$id)
						// ->get('db_paytipe')
						// ->row();
						
		 // die(json_encode($data));
		// }
		// function dp($id,$proj){
				// $data = $this->db->select('paytipedp_id id, paytipe_dp nama')
									// ->where('id_subproject',$proj)
									// ->where('id_paytipe',$id)
									// ->get('db_paytipedp')
									// ->result();
		 // die(json_encode($data));
		// }
		
		
		// function pl($id,$proj){
				// $data = $this->db->select('paytipe_pl id, paytipe_pl nama')
									// ->where('id_subproject',$proj)
									// ->where('id_paytipe',$id)
									// ->order_by('paytipe_pl','asc')
									// ->get('db_paytipepl')
									// ->result();
						
						
						
		 // die(json_encode($data));
		// }
		
		// function salesplan(){
					// $data = $this->db->select('*')
						// ->get('db_saleplan')
						// ->row();
				
						
		 // die(json_encode($data));
			
		// }
		
		// function cekprice(){
			// $phase = $this->input->post('phase');
			// $tipepl = $this->input->post('tipepl');
			// $unit = $this->input->post('tipepl');
			// $paytipe = $this->input->post('paytipe');
			// #die($unit."-".$phase."-".$tipepl."-".$paytipe);
			// $rows = $this->db->where('id_unit',$unit)
							 // ->where('id_paytipe',$paytipe)	
						     // ->where('id_paytipepl',$tipepl)
						     // ->where('phase',$phase)
						     // ->get('db_unitprice')->row();
			// die(number_format($rows->pricelist_ppn));
		// } 
		
		// function insertcustomer(){
			// extract(PopulateForm());
			
			// $disc2 = 0;
			// list($d,$m,$y) = split("-",$spdate);
			// list($d1,$m1,$y1) = split("-",$bfdate);
			// list($d2,$m2,$y2) = split("-",$pldate);
			// list($d3,$m3,$y3) = split("-",$dpdate);
			// #sales date			
			// $spdate = $y."-".$m."-".$d;
			// $bfdate = $y1."-".$m1."-".$d1;
			// $pldate = $y2."-".$m2."-".$d2;
			// $dpdate = $y3."-".$m3."-".$d3;			

			
			
			// #Validation Generate SP
			
			// #Cek Validation Phase
			// $sql = "select * from db_salesplan where '$spdate' between strartdate and enddate";
			// $rows = $this->db->query($sql)->row();
			// $pcek = @$rows->phase;
			
			// #Update cara pelunasan
			// $paypl = $paytipepl;
			// /*if($paytipepl == 2) $paypl = 12;
			// elseif($paytipepl == 3) $paypl = 24;
			// elseif($paytipepl == 5) $paypl = 18;			
			// else $paypl = $paytipepl;*/

			// #Cek Data Sales Plan Perphase
			// $cekrow = $this->db->where('phase',$phase)
							   // ->where('id_paytipe',$paytipe)
							   // ->where('id_paytipepl',$paypl)
							   // ->where('id_subproject',$subproject)
							   // ->get('db_salesplan')->num_rows();
			// #die($phase.' '.$paytipe.' '.$paypl);
			// #var_dump($cekrow);exit();
			// if($cekrow <= 0){
				// die("Tidak Ada Sales Plan Master");
			// }
			
			
			// $cek_phase = $this->db->select_max('phase')
								// ->where('id_paytipepl',$paypl)
								// ->where('id_paytipe',$paytipe)
								// ->where('id_subproject',$subproject)
								// ->where('flag !=',2)
								// ->order_by('phase','ASC')
								// ->get('db_salesplan')->row();
								
			// $cek_dtphase=$cek_phase->phase;

			
			// #Cek Data Unit Perphase
			// $dtphase = $this->db->where('id_paytipepl',$paypl)
								// ->where('id_paytipe',$paytipe)
								// ->where('id_subproject',$subproject)
								// ->where('phase',$cek_dtphase)
								// ->where('flag !=',2)
								// ->order_by('phase','ASC')
								// ->get('db_salesplan')->row();

			// #Mendapatkan Nilai Phase Terakhir
			// $lastphase = $dtphase->phase;
			// $qtyphase = $dtphase->qty; #Jumlah Unit

			
			// #Mendapatkan Jumlah jual di SP
			// $dtjual = $this->db->select('count(id_paytipe) as unitjual')
							   // ->where('id_paytipepl',$paypl)
							   // ->where('id_paytipe',$paytipe)
							   // ->where('phase',$lastphase)
							   // ->where('id_subproject',$subproject)
							   // ->get('db_sp')->row();
			// $qtyjual = $dtjual->unitjual;
			
			// #var_dump($qtyjual);exit;
			
			// #Cek unit phase terakhir
			// if($qtyjual > $qtyphase){
				// $data = array 
				// (
					// 'flag' => 2
				// );

				// $this->db->where('id_paytipepl',$paypl);
				// $this->db->where('id_paytipe',$paytipe);
				// $this->db->where('phase ',$lastphase);
				// $this->db->where('id_subproject',$subproject);
				// $this->db->update('db_salesplan',$data);
			// }
					  
			// #Diskon Master
			// $xdisc1 = @$dtphase->maxdisc;
			// $xdisc2 = @$dtphase->adddisc;
			// $xtotdisc = $xdisc1 + $xdisc2;
			// $totdisc = $disc1 + $disc2;
			

			
			// #abs(ceil((strtotime($date)-strtotime("now"))/86400));
			// $sp = abs(ceil(strtotime($spdate)/86400));
			// $bf = abs(ceil(strtotime($bfdate)/86400));
			// $pl = abs(ceil(strtotime($pldate)/86400));
			// $dp = abs(ceil(strtotime($dpdate)/86400));
			
			// $xdp = $dp - $bf;
			// $xpl = $pl - $dp;
			// #die(number_format($ajuan1)."-".number_format($ajuan2)."-".number_format($ajuan3));

			// #validasi psqm
			// $psqm = @$dtphase->amount_m2;
			// $paysqm = replace_numeric($payment);
			// #var_dump($psqm."-".$paysqm);
			// #Cek Validasi#
			
			// if(@$pcek != $phase){
				// die("Tolong Cek lagi tanggal SP Date");
			// #}elseif($totdisc > $xtotdisc){
				// #die("Tolong Cek diskon anda");
			// }elseif($bf < $sp){
				// die("Tolong Cek booking fee anda");
			// }elseif($dp < $bf){
				// die("Tolong Cek down payment anda");
			// }elseif($pl < $dp){
				// die("Tolong Cek pelunasan anda");
			// }elseif($xdp > 14){
				// die("DP tidak boleh 14 hari dari BF");
			// //}elseif($xpl > 30){
				// //die("PL tidak boleh lebih 1 bulan dari DP");								
			// }elseif($paysqm < $psqm){
				// die("Cek harga psqm lebih kecil");																
			// }else{
				// #Cek Harga Sales
				// $row1 = $this->db->where('setting_id',1)
								// ->get('db_setting')->row();
				// $row2 = $this->db->where('setting_id',2)
								// ->get('db_setting')->row();
				// $row3 = $this->db->where('setting_id',3)
								// ->get('db_setting')->row();

				// #Ambil phase Terakhir
				// $xrows = $this->db->where('id_paytipepl',$paypl)
								 // ->where('id_paytipe',$paytipe)
								 // ->where('id_subproject',$subproject)
								 // ->get('db_salesplan')->row();				
				// $xphase = $xrows->phase;
				// #var_dump($xphase);exit;								
				// #Banyak DP
				// $cekpaydp = $this->db->where('paytipedp_id',$paytipedp)
									 // ->get('db_paytipedp')->row();

				// $jdp = $cekpaydp->paytipe_dp;
				
				// //Tunai Pelunasan 3 x
				// if(@$paytipe==1){
					// $jdp = $jdp;
					// $jpl = $paypl;
				// }else{
					// if($paypl > 1)
						// $jpl = $paypl - $jdp;
					// else
						// $jpl = $paypl;

				// }

				
						
				
				// #var_dump($jpl);exit;

				// #Setting Master#
				// $xbf  = $row1->setting_am;
				// $xdp  = $row2->setting_am;
				// $xpln = $row3->setting_am;
				// #End Setting Master#
				
				// #Cek Harga 
				// $soldprice = replace_numeric($soldprice);
				// $taxamount = replace_numeric($taxamount);
				// $mprice = replace_numeric($mprice);
				// $pricehid = replace_numeric($pricehid);

				// #$sisaprice = $soldprice -  $xbf;
				// $dp    =   ($soldprice * ($xdp/100)) - $xbf;
				// $lunas =   $soldprice * ($xpln/100);
				// $mdp = $dp / $jdp;
				// $mlunas = $lunas / $jpl;
				// $discamount = replace_numeric($discamount);
				// #var_dump($mdp);exit;
				// #Belum ada
				// $discount2 = 0;
				// $ho_date = "2014-01-01";
				// #var_dump($paypl);exit;
				// #update Customer
				// $iduser = $this->user_id;
				// $idpt = $this->pt_id;
				// $id = $nama;
				// $idflag = 1;
				// #var_dump($idbisnis);exit;
				// $query = $this->db->query("UpdateCustomerBuyer '".$idfilter."','".$idgroup."','".$customernama."','".$customertgllhr."',
				// '".$customertmptlhr."','".$idagama."','".@$idkarysek."','".$customerstatus."','".$profesi."','".$hp."',
				// '".$customertlp."','".$customerfax."','".$idtipe."','".$id_number."','".$email."','".$npwp."','".$tipemedia."','".$media."',
				// '".$motivie."','".$customeralamat1."','".$negara."','".$propinsi."','".$kota."','".$kdpos."','".$customeralamat2."','".$negara1."',
				// '".$propinsi1."','".$kota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
				// '".$etnis."','".$fb."','".$twiter."','".$custcompnm."','".@$idbisnis."','".$custcompalamat."','".$custcomphp."',
				// '".$custcompfax."','".$custcompnpwp."','".$id."'");	
				
				// #Insert SP
				// $query = $this->db->query("sp_cetak_surat_pesanan '".$spno."','".$spdate."','".$bfdate."',
				// '".$dpdate."','".$pldate."',".$xbf.",".$dp.",".$lunas.",".$mlunas.",".$mdp.",
				// ".$jdp.",".$jpl.",".$nama.",'".$subproject."','".$unit."',
				// ".$soldprice.",".$taxamount.",".$pricehid.",".$paytipe.",".$disc1.",
				// ".$disc2.",".$salesname.",".$discount2.",".$discamount.",".$xphase.",
				// '".$ho_date."',".$iduser.",".$mprice.",".$paypl."");
								
				// #$this->load->view('spcustomer/surat_pesanan');																
				// die("sukses");
				
			// }

		
		// }
		
		
}

