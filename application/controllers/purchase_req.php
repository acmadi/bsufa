<?php
	class purchase_req extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('purchase_req_model');
			$this->set_page_title('Purchase Request');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/purchase_req';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
		}
		
		protected function setup_form($data=false){
			
			if($this->divisi != 106){
			$this->parameters['budgetnm'] = $this->db->select('id_trbgt,form_kode,amount,')
													 ->where('id_pt',$this->pt)
													 ->where('divisi_id',$this->divisi)
													 ->where('form_kode IS NOT NULL')
													 ->where('isnull(proses,0) !=',1)
													# ->where('proses !=',1)
													 ->where('flag_pr',1)
													 ->where('flag_id',1)
													 ->order_by('form_kode','ASC')
													 ->get('db_trbgtdiv')->result();
			} else {
			$this->parameters['budgetnm'] = $this->db->select('id_trbgt,form_kode,amount')
													 ->where('id_pt',$this->pt)
													 ->where('divisi_id',$this->divisi)
													 ->where('form_kode IS NOT NULL')
													 ->where('isnull(proses,0) !=',1)
													# ->where('proses !=',1)
													 ->where('flag_pr',1)
													 ->order_by('form_kode','ASC')
													 ->get('db_trbgtdiv')->result();
			}
			$pt = $this->pt;
			$div = $this->divisi;
		//	$div = 	83;									 
			$cekpr = $this->db->query("sp_cek_pr_no ".$pt.",".$div."")->row();										 
													 
			$cekdivisi = $this->db->where('divisi_id',83)
							      ->get('db_divisi')->row();	
							      
			//Cek PR Order
			$cekorder = $this->db->where('no_pr',@$data->no_pr)
								 ->get('db_prorder')->result();
			
			
			//Parameters				      
			$this->parameters['pt'] = $pt; 				      								
			$this->parameters['div'] = $div; 				      								
			$this->parameters['no_pr'] = $cekpr->no_pr; 				      								
			$this->parameters['divisi_nm'] = $cekdivisi->divisi_nm;										 
			$this->parameters['nama'] =	$this->user;	
			$this->parameters['cekord'] = $cekorder;
									   
		}

		function get_json(){
		$this->set_custom_function('tgl_pr','indo_date');
		$this->set_custom_function('tgl_aproval','indo_date');
		//$this->set_custom_function('kwitansi_jml','currency');
		parent::get_json();
		}		
		
		function index(){
			$this->set_grid_column('id_pr','id_pr',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_pr','No.PR',array('width'=>70,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_pr','Tgl.PR',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_aproval','Tgl.Approval',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('req_pr','Requestor',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('ket_pr','Keterangan',array('width'=>110,'formatter' => 'cellColumn'));
			$this->set_grid_column('alasan_pr','Alasan',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('status_pr','Status PR',array('hidden'=>true,'width'=>30,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>400,'caption'=>'Purchase Request','rownumbers'=>true,'sortname'=>'id_pr','sortorder'=>'desc'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		
		function crud($oper,$id){
			$xid = str_replace('XD','',$id);
			
			die($id);
			switch($oper){
				case 'load':
					$data = $this->db->select('nm_brg,unit_brg,qty_brg,recvendor')
									 ->where('no_pr','XXXX')
									 ->get('prorder')->row();
				break;
				case 'add':
					die(json_encode("simpan disini"));
				break;
				case 'edit':
					die("edit");
				break;
				case 'del':
					die("del");
				break;

			}
				//var_dump($data);exit;
				die(json_encode($data));exit;	
		}
		
		
		function tambah($nm_brg,$satuan,$qty,$vendor){
			$data = array
			(
				'nm_brg' => $nm_brg,
				'unit_brg' => $satuan,
				'qty_brg' => $qty,
				'recvendor' => $vendor,
				'no_pr' =>'XXXX'
			);
			$this->db->insert('db_prorder',$data);
			die(json_encode($data));	
			
		}
		
		function datax($id){
		//die($id);
		$datax = $this->db->select('id_trbgt,divisi_nm,amount,description')
						->join('db_divisi b','b.divisi_id = a.divisi_id','left')
						->where('id_trbgt',$id)
						->order_by('id_trbgt','ASC')
						->get('db_trbgtdiv a')
						->row();						

		die(json_encode($datax));
		
		}
		
		
		function insertpr(){
		
			extract(PopulateForm());
			//die($nopr);
			$tglpr = inggris_date($tglpr);
			$data = array
			(
				'no_pr' => $nopr,
				'tgl_pr' => inggris_date($tglpr),
				'req_pr' => $reqpr,
				'div_pr' => $id_divisi,
				'ket_pr' => $ketpr,
				'status_pr' => '0',
				'id_pt' => $id_pt,
				'trbgt_id' => $bgtnm,
				'budgeted' => ''
				
				
			);
			//Update Budget
			//die("test");
			$x = array 
			(
				'proses' => 1
			);
			
			$dataupdate = array
			(
				'no_pr' => $nopr,
				'tgl_pr' => inggris_date($tglpr),
				'req_pr' => $reqpr,
				'div_pr' => $id_divisi,
				'ket_pr' => $ketpr,
				'id_pt' => $id_pt,
				'trbgt_id' => $bgtnm,
				'budgeted' => ''
				
				
			);
			
			//Pengecekan Table Order
			$cekpr = $this->db->select('no_pr')
							  ->where('no_pr',$nopr)
							  ->get('db_prorder')->num_rows();
							  
			$cekdata = $this->db->select('no_pr')
							  ->where('no_pr',$nopr)
							  ->get('db_pr')->num_rows();	

									
			$idpr = $this->db->select('id_pr')
							  ->where('no_pr',$nopr)
							  ->get('db_pr')->row();	
			//$idpr2=$idpr->id_pr;
			
			
			if(empty($cekpr)){
				die("Pada Tab Request PR, Barang Belum di Input");
			}elseif($bgtnm == ""){
				die("Budget Belum Di pilih");
			}elseif(empty($cekdata)){
				$this->db->where('id_trbgt',$bgtnm);
				$this->db->update('db_trbgtdiv',$x);
				//die(json_encode($data));
				$this->db->insert('db_pr',$data);
				die("sukses");				

			}else{
				$this->db->where('id_trbgt',$bgtnm);
				$this->db->update('db_trbgtdiv',$x);
				//die(json_encode($data));

				$this->db->where('id_pr',$idpr->id_pr);
				$this->db->update('db_pr',$dataupdate);
				die("sukses");				

			}
			
			

			//redirect("purchase_req");
		}
		
		function printpr($id){
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
			if($qdata->status_pr == 9){
			echo"
					<script type='text/javascript'>
						alert('PR ini tidak disetujui');
						document.location.href = 'purchase_req'
						window.close();
					</script>
				
				";
			}else{				
				$data['id'] = $id;
				$this->load->view('procurement/print/print_pr',$data);
			}
			
		}
		function printver($id){
			//die($id);
			
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
			if($qdata->status_pr == 9){
			echo"
					<script type='text/javascript'>
						alert('PR ini tidak disetujui');
						document.location.href = 'purchase_req'
						window.close();
					</script>
				
				";
			}else{				
				$data['id'] = $id;
				$this->load->view('procurement/print/print_pr',$data);
			}
			
		}


		function ceksatuan(){
			$data = $this->db->select("satuan")
							 ->get("satuan")->result();
			die(json_encode($data));				 
		}
		
		//Cek data di Grid
		function cekdata_dg($no,$pt,$div,$bln,$thn){
			$nopr = $no."/".$pt."/".$div."/".$bln."/".$thn;
			//die($nopr);
			
			$sql = $this->db->query("select nm_brg, unit_brg, qty_brg, recvendor
													 from db_prorder where no_pr='$nopr'")->result(); 
				
				// $getsql   = $this->db->where('ref_no',$cekid)
							 // ->get('db_gldetail')->result();		  				 
		 
			$xtampil = array();	

			foreach($sql as $row){
				
			 $xtampil[] = array 
			 (
					'nmbrg' => $row->nm_brg,  
					'satuan' => $row->unit_brg,  
					'qty' => $row->qty_brg,  
					'vendor' => $row->recvendor,  
				 );
			 }
				
		 die(json_encode($xtampil));
		}
		
		function save_dg($no,$pt,$div,$bln,$thn){
			$nopr = $no."/".$pt."/".$div."/".$bln."/".$thn;
			$nmbrg = $_REQUEST['nmbrg'];
			$satuan = $_REQUEST['satuan'];
			$qty = $_REQUEST['qty'];
			$vendor = $_REQUEST['vendor'];
			
			$data = array 
			(
				'no_pr' => $nopr,
				'nm_brg' => $nmbrg,
				'unit_brg' => $satuan,
				'qty_brg' => $qty,
				'recvendor' => $vendor
			);
			
			$this->db->insert('db_prorder',$data);	
				  
			$tampildata = array 
			(
					'nmbrg' => $nmbrg,  
					'satuan' => $satuan,  
					'qty' => $qty,  
					'vendor' => $vendor  
			);	  
			die(json_encode($tampildata));
					/*echo json_encode(array(  
					'id' => mysql_insert_id(),  
				));*/  
					
		}
		function update_dg($no,$pt,$div,$bln,$thn){
			$nopr = $no."/".$pt."/".$div."/".$bln."/".$thn;
			$nmbrg = $_REQUEST['nmbrg'];
			$satuan = $_REQUEST['satuan'];
			$qty = $_REQUEST['qty'];
			$vendor = $_REQUEST['vendor'];
			
			$idno = $this->db->select('id_no id_no')
							  ->where('no_pr',$nopr)
							  ->get('db_prorder')->row();	
			$idno2=$idno->id_no;
			
			
			
			$data = array 
			(
				'no_pr' => $nopr,
				'nm_brg' => $nmbrg,
				'unit_brg' => $satuan,
				'qty_brg' => $qty,
				'recvendor' => $vendor
			);
			$this->db->where('id_no',$idno2);
			$this->db->update('db_prorder',$data);	
				  
			$tampildata = array 
			(
					'nmbrg' => $nmbrg,  
					'satuan' => $satuan,  
					'qty' => $qty,  
					'vendor' => $vendor  
			);	  
			die(json_encode($tampildata));		


			
			
				/*echo json_encode(array(  
					'id' => mysql_insert_id(),  
				));*/  
					
		}
		
		
		function delete_dg(){
			$id = intval($_REQUEST['id']);  
			$this->db->where('id_no',$id);
			$this->db->delete('db_prorder');
		}
		
		function approvalbgt(){
			extract(PopulateForm());
			if($save=="Approval"){
				$data = array 
				(
					'status_pr'=> 1,
					'alasan_pr' => $alasan,
					'tgl_aproval' => inggris_date($tglapp)
				);
				$this->db->where('id_pr',$idpr);
				$this->db->update('db_pr',$data);
			}else{
				$data = array 
				(
					'status_pr' => 9,
					'alasan_pr' => $alasan,
					'tgl_batal_pr' => inggris_date($tglapp)
				);
				
				//Update Budget
				$x = array 
				(
					'proses' => 1
				);
				$this->db->where('id_trbgt',$bgtnm);
				$this->db->update('db_trbgtdiv',$x);
				
				$this->db->where('id_trbgt',$bgtnm);
				$this->db->update('db_trbgtdiv',$x);				
				$this->db->where('id_pr',$idpr);
				$this->db->update('db_pr',$data);				
			}
			//die("sukses");
			redirect("purchase_req");
		}
		
		
		function app($id){
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
							  
			if($qdata->status_pr != 0){
				echo"
					<script type='text/javascript'>
						alert('PR ini sudah tidak bisa di approve');
						document.location.href = 'purchase_req'
						refreshTable();
					</script>
				
				";
			}else{
				parent::app($id);
			}			
		}
		
		// function view(){
			// // die($id);																																									
			// // $no = 1;
			// // $proj = 44;														   
			// // $sql = $this->db->query("sp_cekapno ".$no.",".$proj."")->row();
			// //var_dump($sql);
					
		// $this->load->view('procurement/purchase_req-view');
		
		// }
		
	
	}




