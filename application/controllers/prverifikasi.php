<?php
	class prverifikasi extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('prverifikasi_model');
			$this->set_page_title('Purchase Verification');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/prverifikasi';
			/*$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$divisi = $session_id['divisi_id'];	*/
		}
		
		protected function setup_form($data=false){
			$this->parameters['pr'] = $this->db->where('no_pr','PR-1103/0006')
											   ->get('pr_pnwrvend')->result();

			/*Cek Login */
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$divisi = $session_id['divisi_id'];	
			$pt = $session_id['id_pt'];

			$cekdivisi = $this->db->where('divisi_id',$divisi)
							      ->get('db_divisi')->row();


			//Cek PR Order
			$cekorder = $this->db->where('no_pr',@$data->no_pr)
								 ->get('db_prorder')->result();
										      											   
											   
			
			$this->parameters['pt'] = $pt; 	
			$this->parameters['divisi_nm'] = @$cekdivisi->divisi_nm;				      								
			$this->parameters['div'] = $divisi; 
			$this->parameters['nama'] =	$this->user;
			$this->parameters['cekord'] = $cekorder;														   
		}
		
		function get_json(){
			$this->set_custom_function('tgl_pr','indo_date');
			parent::get_json();
		}
		
		function index(){
			/*Cek Login */
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$divisi = $session_id['divisi_id'];	
			
			$this->set_grid_column('id_pr','ID',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_pr','No.PR',array('width'=>120,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_pr','Tgl.PR',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('req_pr','Requestor',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('ket_pr','Keterangan',array('width'=>80,'formatter' => 'cellColumn'));
			$this->set_grid_column('alasan_pr','Alasan',array('width'=>80,'formatter' => 'cellColumn'));
			//~ $this->set_grid_column('approved 1','Appr 1',array('width'=>50,'formatter' => 'cellColumn'));
			//~ $this->set_grid_column('approved 2','Appr 2',array('width'=>50,'formatter' => 'cellColumn'));
			//~ $this->set_grid_column('status_pr','Status PR',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1300,'height'=>400,'caption'=>'Purchase Verification','rownumbers'=>true,'sortname'=>'id_pr','sortorder'=>'desc'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
			function crud($oper,$id){
			$xid = str_replace('XD','',$id);
			
			
			switch($oper){
				case 'load':
					$data = $this->db->select('nm_supp,harga_sat,kd_supp,disc')
									 ->where('id_pnwrven',$xid)
									 ->get('pr_pnwrvend')->row();
				break;
				case 'add':
					die("add");
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
		
		
		function mapingbarang($id){
			//die($id);
			$this->load->view('procurement/mapingbarang');
		}
		
		function generatepr($id){
			//die("tes");
			$this->load->view('procurement/generatepr');
		}
		function tambah($nm_supp,$satuan,$qty,$vendor){
			$data = array
			(
				'nm_supp' => $nm_supp,
				'harga_sat' => $satuan,
				'disc' => $qty,
				'alasan' => $vendor,
				'no_pr' => 'PR-1103/0006'
			);
			$this->db->insert('pr_pnwrvend',$data);
			die(json_encode($data));	
			
		}
		// function updatepr(){
		// //die('tes');
		// $this->load->view('procurement/prverifikasi-form');
		
		// }
		
		
		function verifikasi_pr(){
		
		
		
			extract(PopulateForm());
			$jml = count($nm_brg);			
			
			//Cek Data 
			for($i = 0; $i < $jml; $i++){
				$data = array 
				(
					'no_pr' => $nopr,
					'id_pr' => $idpr,
					'nm_brgrev' => $nm_brg[$i],
					'recvendor' => $rec_brg[$i],
					'unit_brg' => $unit_brg[$i],
					'qty_req' => $qty_brg[$i]
					
				);
				$this->db->insert('db_pr_dver',$data);
			}
			
			$data = array 
			(
				'status_pr' => 2,
				'alasan_pr' => $alasan
			);
			
			$this->db->where('id_pr',$idpr);
			$this->db->update('db_pr',$data);
			
			
			redirect('prverifikasi');
		}
		
		
		function cekdata_dg($id){
			$data = $this->db->where('id_pr',$id)
							 ->get()->result();
		}
		
		
		function show_vend($idpr){
			$data['idpr'] = $idpr;
			
			$tes = array('41011','41012','1','41013');
			
			$data['pvendor'] = $this->db->select('kd_supp_gb,nm_supplier')
										->where_in('kd_project',$tes)
										->where('kdkel_usaha','supplier')
										->order_by('nm_supplier','asc')
										->get('pemasok')->result();
			/*							
			$data['nm_brg'] = $this->db->select('a.kd_brg_ver,b.nm_brg')
									   ->join('barang b','b.kd_brg = a.kd_brg_ver')
									   ->where('id_pr',$idpr)
									   ->order_by('b.nm_brg','ASC')
									   ->get('db_pr_dver a')->result();
			*/						   
			$data['nm_brg'] = $this->db->select('nm_brg,kd_brg_ver')
									   
									   ->where('no_pr',$idpr)
									   ->get('db_pr_dver')->result();
									   
			//$data['barang'] = $this->db->select('nm_brg')->where('id_pr',$idpr)->get('db_prorder')->result();
										
			$this->load->view('procurement/show_vend',$data);
		}
		

		function show_brg($idpr){
			$data['idpr'] = $idpr;
			$data['pmaster'] = $this->db->select('kd_brg,nm_brg')
							   ->order_by('nm_brg','ASC')
						       ->get('barang')->result();
										
										
			$this->load->view('procurement/show_brg',$data);
		}
		
		function save_mapvendor(){
			
				extract(PopulateForm());
				
				$data = array(
				'status_pr' => 4
				);
				$this->db->where('id_pr',$idpr)
						->update('db_pr',$data);
				redirect('prverifikasi');
		
		}
		
		//Master Barang 
		function master_brg(){
			$data = array();
			$sql = $this->db->select('kd_brg,nm_brg')
						     ->get('barang')->result();
			foreach($sql as $row){
				$data[] = $row;
			}
			
			die(json_encode($data));
						     
		}


		//CRUD GRID
		function save_dg($id){
		
			$kd_brg_ver = $_REQUEST['kd_brg_ver'];
			$nm_brg = $_REQUEST['brg'];
			$vendor1 = $_REQUEST['vendor1'];
			$satuan1 = $_REQUEST['satuan1'];
			$diskon1 = $_REQUEST['diskon1'];
			$total1 = $_REQUEST['total1'];
			$vendor2 = $_REQUEST['vendor2'];
			$satuan2 = $_REQUEST['satuan2'];
			$diskon2 = $_REQUEST['diskon2'];
			$total2 = $_REQUEST['total2'];
			$vendor3 = $_REQUEST['vendor3'];
			$satuan3 = $_REQUEST['satuan3'];
			$diskon3 = $_REQUEST['diskon3'];
			$total3 = $_REQUEST['total3'];
			$idpr = $_REQUEST['idpr'];
			//$id = $_REQUEST['id'];
			//var_dump($vendor1);exit();
			
			//Cek Vendor
			// $cekvend = $this->db->select('nm_supplier')
								// ->where('kd_supp_gb',$vendor1)
								// ->get('pemasokmaster')->row();
								
			// //Cek Barang 
			// $cekbrg = $this->db->select('nm_brg')
							   // ->where('kd_brg',$nm_brg)
							   // ->get('barang')->row();
			
			// $nm_supplier = $cekvend->nm_supplier;
			
			
			// $data = array
					// (
						// 'kd_brg_ver' => $kd_brg_ver,
						// 'kd_supp' => $vendor1,
						// 'harga_sat' => $satuan1,		
						// 'disc' => $diskon1,						
						// 'subtotal' => $total1,
						// 'kd_supp' => $vendor2,
						// 'harga_sat' => $satuan2,		
						// 'disc' => $diskon2,						
						// 'subtotal' => $total2,
						// 'kd_supp' => $vendor3,
						// 'harga_sat' => $satuan3,		
						// 'disc' => $diskon3,						
						// 'subtotal' => $total3,
						// 'id_pr' => $idpr		
					// );	
					
			$query = $this->db->query("sp_saveven '".$kd_brg_ver."','".$vendor1."',".replace_numeric($satuan1).",".replace_numeric($diskon1).",".replace_numeric($total1).",'".$vendor2."',".replace_numeric($satuan2).",".replace_numeric($diskon2).",".replace_numeric($total2).",'".$vendor3."',".replace_numeric($satuan3).",".replace_numeric($diskon3).",".replace_numeric($total3).",".$idpr."");			
			//$query = $this->db->query("sp_Insertgldetail '".$acc_no."','".$dept."','".$descs."','".$voucher."',".replace_numeric($debit).",".replace_numeric($credit)."");
				
			#if(@$id==NULL){
			// $query = $this->db->query("sp_saveven '".$kd_brg_ver."','".$vendor1."',".$satuan1.",".$diskon1.",".$total1.",'".$vendor2."',".$satuan2.",
													// ".$diskon2.",".$total2.",'".$vendor3."',".$satuan3.",".$diskon3.",".$total3.",".$idpr."");
			
			// $xxtampil = $this->db->query("sp_tampilvend '".$brg."','".$vendor1."',".$satuan1.",".$diskon1.",".$total1.",'".$vendor2."',".$satuan2.",
													// ".$diskon2.",".$total2.",'".$vendor3."',".	$satuan3.",".$diskon3.",".$total3.",".$idpr."");	
			
			#}else{
			#	$this->db->where('id_pnwrven',$id);
			#	$this->db->update('db_pr_pnwrvend',$data);				
			#}
			//Menampilkan di JSON
			
			$vendoro1 = $this->db->select('nm_supplier')
										->where('kd_supp_gb',$vendor1)
										->get('pemasok')->row();
			$vendoro2 = $this->db->select('nm_supplier')
											->where('kd_supp_gb',$vendor2)
											->get('pemasok')->row();
			$vendoro3 = $this->db->select('nm_supplier')
											->where('kd_supp_gb',$vendor3)
											->get('pemasok')->row();
			$xtampila = array 
				(
					 
					//'brg' => $nm_brg,
					 'vendor1' => $vendoro1->nm_supplier,
					 'satuan1' => $satuan1,
					 'diskon1' => $diskon1,
					 'total1' => $total1,				
					 'vendor2' => $vendoro2->nm_supplier,
					 'satuan2' => $satuan2,
					 'diskon2' => $diskon2,
					 'total2' => $total2,				
					 'vendor3' => $vendoro3->nm_supplier,
					 'satuan3' => $satuan3,
					 'diskon3' => $diskon3,
					 'total3' => $total3	
				);
			
			die(json_encode($xtampila));
		}		
		
		
		
		function get_brg($idpr){
			
			#$disc = $_REQUEST['disc']
			$ckdata = $this->db->select('idpr_dver,subtotal,id_pnwrven,nm_brgrev,recvendor,
									discnilai,qty_req,unit_brg,nm_brg_ver,harga_sat,kd_brg_ver')
							   ->where('id_pr',$idpr)
							   ->get('db_pr_dver')->result();
			
			$data = array();
			foreach($ckdata as $row){
				/*$chkven = $this->db->where('id_pnwrven',$row->id_pnwrven)
								   ->get('db_pr_pnwrvend')->row();
				*/
				$kdbarang = $row->kd_brg_ver;
				
				#$data[]= $this->db->query("SP_VenPr '".$kdbarang."','".$idpr."'")->result_array();
				
				
				$total = $row->harga_sat * $row->qty_req;
				$data[] = array 
				(
					'id' => $row->idpr_dver,
					'request' => $row->nm_brgrev,
					'ven_req' => $row->recvendor,
					
					'kd' => $kdbarang,
					'kode' => $row->nm_brg_ver,
					'satuan' => $row->unit_brg,
					'ven' => $row->id_pnwrven,
					'hrg'=>$row->harga_sat,
					'qty' => $row->qty_req,
					'subtotal'=>$total,
					'disc'=>$row->discnilai,
					'total' => $row->subtotal
				);
			}
			
			
			
			die(json_encode($data));exit;
			
			
			
			//~ $xtampil = array 
				//~ (
					 //~ 'kode' => $cekdata->nm_brg,
					 //~ 'satuan' => $satuan,
					 //~ 'qty' => $qty,
					 //~ 'request' => $request,
					 //~ 'ven_req' => $ven_req				
				//~ );
			//~ die(json_encode($xtampil));
			
			
			
			
			
		}
		
		function tes($gelo){
			
		}
		function getkodebrg($kode){
			$data = $this->db->select('kd_brg,nm_brg')
							->where('kd_brg',$kode)
							->get('barang')->row();
			die(json_encode($data));exit;
		}
		


		//CRUD GRID Barang
		function update_brg($id){
			$kode = $_REQUEST['kode'];
			$idpr = $_REQUEST['idpr'];
			$request = $_REQUEST['request'];
			$ven_req = $_REQUEST['ven_req'];
			$qty = $_REQUEST['qty'];
			$satuan = $_REQUEST['satuan'];
			
			//Cek Kode Barang
			$cekdata = $this->db->select('nm_brg')
							    ->where('kd_brg',$kode)
							    ->get('barang')->row();			

									
			$data = array 
			(
				'kd_brg_ver' => $kode,
				'nm_brg_ver' => $cekdata->nm_brg
			);
			
			$this->db->where('idpr_dver',$id);
			$this->db->update('db_pr_dver',$data);


			//Menampilkan di JSON
			$xtampil = array 
				(
					 'kode' => $cekdata->nm_brg,
					 'satuan' => $satuan,
					 'qty' => $qty,
					 'request' => $request,
					 'ven_req' => $ven_req				
				);
			die(json_encode($xtampil));
		}			
		
		
		//Tampilkan Untuk Verifikasi Barang
		function show_ver($idpr,$row){
			$data['idpr'] = $idpr;
			$data['brg'] = $this->db->select('kd_brg_ver')
									->where('id_pr',$idpr)
									->get('db_pr_dver')->result();
			$data['pven'] = $this->db->select('id_pnwrven,nm_supp,kd_brg_ver')
									 ->where('id_pr',$idpr)
									 ->where('kd_brg_ver',$row)
									 ->group_by('id_pnwrven,nm_supp,kd_brg_ver')
									 ->get('db_pr_pnwrvend')->result();
										
										
			$this->load->view('procurement/show_ver',$data);
		}	
		
		
		
		function getver_ven($id){
			$data = $this->db->where('id_pnwrven',$id)
							 ->get("db_pr_pnwrvend")->row();
			
			die(json_encode($data));exit;
		}	
		
		
		function get_ven($kdbrg,$idpr){
			
			$sql = $this->db->select('kd_supp id, nm_supp nama')
						    ->where('kd_brg_ver',$kdbrg)
						    ->where('id_pr',$idpr)
							->group_by('kd_supp,nm_supp')
							->get('db_pr_pnwrvend')->result();
							
			$data = array();
			foreach($sql as $row){
				$data[] = $row;
			}		
			die(json_encode($data));		
							
		}		
		
		
		
		function update_ver($id){
			$kd   = $_REQUEST['kd'];
			$kode = $_REQUEST['kode'];
			$qty  = $_REQUEST['qty'];
			$satuan = $_REQUEST['satuan'];
			$ven = $_REQUEST['ven'];
			$hrg = $_REQUEST['hrg'];
			$disc = $_REQUEST['disc'];
			$subtotal = $_REQUEST['subtotal'];
			$total = $_REQUEST['total'];
			
			
			//Cek Kode Supplier
			$cek = $this->db->select('kd_supp')
							->where('id_pnwrven',$ven)
							->get('db_pr_pnwrvend')->row();
							
			 //Update Penawaran
			 $data = array 
			 (
				'id_pnwrven' => $ven,
				'harga_sat' => replace_numeric($hrg),
				'discnilai' => replace_numeric($disc),
				'subtotal' => replace_numeric($total), 
				'kd_supp' => $cek->kd_supp
			 );
			
			$this->db->where('idpr_dver',$id);
			$this->db->update('db_pr_dver',$data);
			
			//Cek Kd supplier
			$ck = $this->db->where('id_pnwrven',$ven)
						   ->get('db_pr_pnwrvend')->row();
			//Menampilkan di JSON
			
			$venm = $this->db->select('nm_supplier')->where('kd_supp_gb',$ven)->get('pemasokmaster')->row();
			
			$xtampil = array 
			(
				'kd' => $kd,
				'kode' => $kode,
				'qty' => $qty,
				'satuan' => $satuan,
				'ven' => $ck->nm_supp,
				'hrg' => $hrg,				
				'disc' => $disc,
				'subtotal' => $subtotal,
				'total' =>  $total				
			);
			die(json_encode($xtampil));
			
		}
		
		//Approval
		function view($id){
			 $qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
							  
			if($qdata->status_pr <= 4){
				echo"
					<script type='text/javascript'>
						alert('Proses PR belum selesai');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr >= 6){
				echo"
					<script type='text/javascript'>
						alert('PR telah mendapat PERSETUJUAN');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}else{
				parent::view($id);
			
			//}else{
			//$this->load->view('procurement/prverifikasi-view',$qdata);
			
			// $tgl = date("Y-m-d");
			// /*Cek Login */
			// $session_id = $this->UserLogin->isLogin();
			// $this->user = $session_id['username'];			
			// $data = array
			// (
				// 'status_pr' => 6,
				// 'approval1' => $this->user,
				// 'tgl_aprv1' => $tgl
			
			// );
			
			// $this->db->where("id_pr",$id);
			// $this->db->update("db_pr",$data);
			
			// echo"
				// <script type='text/javascript'>
					// alert('Approve 1 Sukses');
					// refreshTable();
				// </script>
			// ";
			}//redirect("prverifikasi");
		}
		
		function approve1(){
			
				
				
			extract(PopulateForm());
			
			$tgl = date("Y-m-d");
			/*Cek Login */
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];			
			$data = array
			(
				'status_pr' => 6,
				'approval1' => $this->user,
				'tgl_aprv1' => $tgl
			
			);
			
			$this->db->where("id_pr",$idpr);
			$this->db->update("db_pr",$data);
			
			// echo"
				// <script type='text/javascript'>
					// alert('Approve 1 Sukses');
					// refreshTable();
				// </script>
			// ";
			
			// $data = array(
						
				// 'status_pr'=> 5 
			// );
			
			// $this->db->where('id_pr',$idpr)
						// ->update('db_pr',$data);
			
			
			die('sukses');
							
		}
		
		function appr($id){
			 $qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
							  
			if($qdata->status_pr <= 5){
				echo"
					<script type='text/javascript'>
						alert('Proses PR belum selesai');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr >= 7){
				echo"
					<script type='text/javascript'>
						alert('PR telah mendapat PERSETUJUAN');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}else{
			
				parent::appr($id);
			
			//}else{
			//$this->load->view('procurement/prverifikasi-view',$qdata);
			
			// $tgl = date("Y-m-d");
			// /*Cek Login */
			// $session_id = $this->UserLogin->isLogin();
			// $this->user = $session_id['username'];			
			// $data = array
			// (
				// 'status_pr' => 6,
				// 'approval1' => $this->user,
				// 'tgl_aprv1' => $tgl
			
			// );
			
			// $this->db->where("id_pr",$id);
			// $this->db->update("db_pr",$data);
			
			// echo"
				// <script type='text/javascript'>
					// alert('Approve 1 Sukses');
					// refreshTable();
				// </script>
			// ";
			}//redirect("prverifikasi");
		}
		
		function approve2(){
			
				
				
			extract(PopulateForm());
			
			$tgl = date("Y-m-d");
			/*Cek Login */
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];			
			$data = array
			(
				'status_pr' => 7,
				'approval2' => $this->user,
				'tgl_aprv2' => $tgl
			);
			
			$this->db->where("id_pr",$idpr);
			$this->db->update("db_pr",$data);			
			die('sukses');
							
		}
		
		// }

		function app2($id){
		$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
							  
			if($qdata->status_pr <= 5){
				echo"
					<script type='text/javascript'>
						alert('Proses PR belum selesai');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr >= 7){
				echo"
					<script type='text/javascript'>
						alert('PR telah mendapat PERSETUJUAN');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}else{
		
			$tgl = date("Y-m-d");
			/*Cek Login */
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];			
			$data = array
			(
				'status_pr' => 7,
				'approval2' => $this->user,
				'tgl_aprv2' => $tgl
			);
			
			$this->db->where("id_pr",$id);
			$this->db->update("db_pr",$data);			
			echo"
				<script type='text/javascript'>
					alert('Approve 2 Sukses');
					refreshTable();
				</script>
			";
			}
		}
//}

		function update($id){
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
							  
			if($qdata->status_pr >= 2){
				echo"
					<script type='text/javascript'>
						alert('PR ini sudah diverifikasi');
						document.location.href = 'prverifikasi'
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr == 9){
				echo"PR ini tidak disetujui";
			}else{
				parent::update($id);
			}					
		}
		
		
		function cekven(){
			$idpr = $this->input->post('idpr');
			$kode = $this->input->post('kode');
			
			$sql = $this->db->select('id_pnwrven id,nm_supp nama')
							 ->where('id_pr',$idpr)
							 ->where('kd_brg_ver',$kode)
							 ->get('db_pr_pnwrven')->result();
			$data = array();
			foreach($sql as $row){
				$data[] = $row;
			}
			
			die(json_encode($data));exit;
			
		}
		
		//posting pr
		function postingpr(){
			
				
				
			extract(PopulateForm());
			
			$data = array(
						
				'status_pr'=> 5 
			);
			
			$this->db->where('id_pr',$idpr)
						->update('db_pr',$data);
			
			
			redirect('prverifikasi');
							
		}
		
		
		//~ function get_dg($idpr){		
		//~ 
		//~ $cek = $this->db->select('kd_supp')->get('db_pr_dver')->row();	
     //~ // $cekvend = $cek->kd_supp; 
			//~ 
			//~ //if ($cek->kd_supp == NULL){
			//~ 
			//~ $ckdata = $this->db->select('a.nm_brg_ver,b.kd_brg_ver,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
							    				   //~ ->join('db_lem_db_pr_pnwrvend b','a.id_pr = b.id_pr and a.kd_brg_ver=b.kd_brg_ver','left')
												   //~ ->where('a.id_pr',$idpr)
												   //~ 
												   //~ ->group_by('a.nm_brg_ver,b.kd_brg_ver,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
												//~ ->get('db_pr_dver a')->result();
							   //~ 
						//~ 
							   //~ 
			//~ 
			//~ $data = array();
			//~ foreach($ckdata as $row){
		//~ 
							   	   //~ 
			//~ $vendoro1 = $this->db->select('nm_supplier')
											//~ ->where('kd_supp_gb',$row->ven1)
											//~ ->get('pemasok')->row();
			//~ $vendoro2 = $this->db->select('nm_supplier')
											//~ ->where('kd_supp_gb',$row->ven2)
											//~ ->get('pemasok')->row();
			//~ $vendoro3 = $this->db->select('nm_supplier')
											//~ ->where('kd_supp_gb',$row->ven3)
											//~ ->get('pemasok')->row();
							   //~ 
				//~ $data[] = array 
				//~ (
					//~ 'kd_brg_ver' => $row->kd_brg_ver,
					//~ 'brg' => $row->nm_brg_ver,
					//~ 'vendor1' => @$row->ven1,
					 //~ 'satuan1' => @$row->sat1,
					 //~ 'diskon1' => @$row->dis1,
					 //~ 'total1' => @$row->tot1,		
					 //~ 'vendor2' => @$row->ven2,
					 //~ 'satuan2' => @$row->sat2,
					 //~ 'diskon2' => @$row->dis2,
					 //~ 'total2' => @$row->tot2,		
					 //~ 'vendor3' => @$row->ven3,
					 //~ 'satuan3' => @$row->sat3,
					 //~ 'diskon3' => @$row->dis3,
					 //~ 'total3' => @$row->tot3
 //~ 
					//~ 
				//~ );
			//~ }
			//~ die(json_encode($data));exit;
		//~ //}else{
//~ 
			//~ // $ckdata = $this->db->select('kd_brg_ver,nm_brg,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
								//~ // ->where('id_pr',$idpr)
								//~ // ->get('db_lem_db_pr_pnwrvend')
								//~ // ->result();
						//~ 
							   //~ 
			//~ 
			//~ // $data = array();
			//~ // foreach($ckdata as $row){
		//~ 
							   	   //~ 
//~ 
							   //~ 
				//~ // $data[] = array 
				//~ // (
					//~ // 'kd_brg_ver' => @$row->kd_brg_ver,
					//~ // 'brg' => @$row->nm_brg,
					//~ // 'vendor1' => @$row->ven1,
					 //~ // 'satuan1' => @$row->sat1,
					 //~ // 'diskon1' => @$row->dis1,
					 //~ // 'total1' => @$row->tot1,		
					 //~ // 'vendor2' => @$row->ven2,
					 //~ // 'satuan2' => @$row->sat2,
					 //~ // 'diskon2' => @$row->dis2,
					 //~ // 'total2' => @$row->tot2,		
					 //~ // 'vendor3' => @$row->ven3,
					 //~ // 'satuan3' => @$row->sat3,
					 //~ // 'diskon3' => @$row->dis3,
					 //~ // 'total3' => @$row->tot3
 //~ 
					//~ 
				//~ // );
			//~ // }
			//~ // die(json_encode($data));exit;
		//~ // }
			//~ 
		//~ }
		//~ 
		
				function get_dg($idpr){		
		
					#$cek = $this->db->select('kd_supp')
					#			->get('db_pr_dver')->row();	
     // $cekvend = $cek->kd_supp; 
			
			#if ($cek->kd_supp == NULL){
			
				$ckdata = $this->db->select('a.nm_brg_ver,a.kd_brg_ver,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
				   				   ->join('db_lem_db_pr_pnwrvend b','a.id_pr = b.id_pr','left')
								   ->where('a.id_pr',$idpr)
												   
								   ->group_by('a.nm_brg_ver,a.kd_brg_ver,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
								 ->get('db_pr_dver a')->result();
							   
						
							   
			
			//~ $data = array();
			foreach($ckdata as $row){
		
							   	   
						$vendoro1 = $this->db->select('nm_supplier')
														->where('kd_supp_gb',$row->ven1)
														->get('pemasok')->row();
						$vendoro2 = $this->db->select('nm_supplier')
														->where('kd_supp_gb',$row->ven2)
														->get('pemasok')->row();
						$vendoro3 = $this->db->select('nm_supplier')
														->where('kd_supp_gb',$row->ven3)
														->get('pemasok')->row();
							   
				$data[] = array 
				(
					'kd_brg_ver' => $row->kd_brg_ver,
					'brg' => $row->nm_brg_ver,
					'vendor1' => @$row->ven1,
					 'satuan1' => @$row->sat1,
					 'diskon1' => @$row->dis1,
					 'total1' => @$row->tot1,		
					 'vendor2' => @$row->ven2,
					 'satuan2' => @$row->sat2,
					 'diskon2' => @$row->dis2,
					 'total2' => @$row->tot2,		
					 'vendor3' => @$row->ven3,
					 'satuan3' => @$row->sat3,
					 'diskon3' => @$row->dis3,
					 'total3' => @$row->tot3
 
					
				);
			}
			die(json_encode($data));exit;
		}
		
		#else{
			//~ $ckdata = $this->db->select('a.nm_brg_ver,b.kd_brg_ver,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
							    				   //~ ->join('db_lem_db_psr_pnwrvend b','a.id_pr = b.id_pr and a.kd_brg_ver=b.kd_brg_ver','left')
												   //~ ->where('a.id_pr',$idpr)
												   //~ 
												   //~ ->group_by('a.nm_brg_ver,b.kd_brg_ver,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
												//~ ->get('db_pr_dver a')->result();
			//~ $ckdata = $this->db->select('kd_brg_ver,nm_brg,ven1,sat1,dis1,tot1,ven2,sat2,dis2,tot2,ven3,sat3,dis3,tot3')
								//~ ->where('id_pr',$idpr)
								//~ ->get('db_lem_db_pr_pnwrvend')
								//~ ->result();
						//~ 
							   
			
			//~ $data = array();
			//~ foreach($ckdata as $row){
		//~ 
							   	   
			//~ $vendoro1 = $this->db->select('nm_supplier')
											//~ ->where('kd_supp_gb',$row->ven1)
											//~ ->get('pemasok')->row();
			//~ $vendoro2 = $this->db->select('nm_supplier')
											//~ ->where('kd_supp_gb',$row->ven2)
											//~ ->get('pemasok')->row();
			//~ $vendoro3 = $this->db->select('nm_supplier')
											//~ ->where('kd_supp_gb',$row->ven3)
											//~ ->get('pemasok')->row();
							   
				//~ $data[] = array 
				//~ (
					//~ 'kd_brg_ver' => @$row->kd_brg_ver,
					//~ 'brg' => @$row->nm_brg,
					//~ 'vendor1' => @$row->ven1,
					 //~ 'satuan1' => @$row->sat1,
					 //~ 'diskon1' => @$row->dis1,
					 //~ 'total1' => @$row->tot1,		
					 //~ 'vendor2' => @$row->ven2,
					 //~ 'satuan2' => @$row->sat2,
					 //~ 'diskon2' => @$row->dis2,
					 //~ 'total2' => @$row->tot2,		
					 //~ 'vendor3' => @$row->ven3,
					 //~ 'satuan3' => @$row->sat3,
					 //~ 'diskon3' => @$row->dis3,
					 //~ 'total3' => @$row->tot3
 //~ 
					//~ 
				//~ );
			//~ }
			//~ die(json_encode($data));exit;
		//~ }
			//~ 
		//~ }
		//~ 
		//~ 
		
		
		
		//Pengecekan PR
		function mapping($id){
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
			if($qdata->status_pr == 9){
				echo"
					<script type='text/javascript'>
						alert('PR Tidak di Setujui');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr > 3){
				echo"
					<script type='text/javascript'>
						alert('Barang Telah di Mapping');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr <= 1){
				echo"
					<script type='text/javascript'>
						alert('PR Belum di Verifikasi');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
				
			}else{				
				parent::mapping($id);
			}			
		}
		
		function app($id){
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
		if($qdata->status_pr == 1 ){
				echo"
					<script type='text/javascript'>
						alert('PR belum diverifikasi');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}
			//~ elseif($qdata->status_pr == 3){
				//~ echo"
					//~ <script type='text/javascript'>
						//~ alert('PR Sudah di posting');
						//~ document.location.href = 'prverifikasi';
						//~ refreshTable();
					//~ </script>
				//~ ";
			//~ 
			//~ }
			
			elseif($qdata->status_pr == 2){
				echo"
					<script type='text/javascript'>
						alert('Maaf Barang belum di Mapping');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			
			}
			elseif($qdata->status_pr >= 4){
				echo"
					<script type='text/javascript'>
						alert('Mapping vendor telah dilakukan');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
				
			}
			else{				
				parent::app($id);
				//$this->load->view('procurement/prverifikasi-view',$id);
			}		

		}
		
		
		
		
		function posting($id){
			$qdata = $this->db->select('status_pr')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
		if($qdata->status_pr == 1){
				echo"
					<script type='text/javascript'>
						alert('PR Belum di VERIFIKASI');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr == 2){
				echo"
					<script type='text/javascript'>
						alert('PR Belum di MAP BARANG');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
			}elseif($qdata->status_pr == 3){
				echo"
					<script type='text/javascript'>
						alert('PR Belum di MAP VENDOR');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
				
					
			}elseif($qdata->status_pr >= 5 ){
				echo"
					<script type='text/javascript'>
						alert('PR dalam proses PERETUJUAN');
						document.location.href = 'prverifikasi';
						refreshTable();
					</script>
				";
				
			}else{				
				parent::posting($id);
			}			

		}
		
		
		
		function ok(){
			#extract(Populate(Form));
			
			extract(PopulateForm());
			
			$data = array(
						
				'status_pr'=> '3' 
			);
			
			$this->db->where('id_pr',$idpr)
						->update('db_pr',$data);
			
			
			redirect('prverifikasi');
		}
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				switch($data_type){
					case 'proj_id':
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt','44')
										->get('db_subproject')->result();
						break;
						
					case 'codebgt':
							$sql = $this->db->select('kode_bgtproj id, nm_bgtproj nama')
										->where('id_ssubbgtproj',$parent_id)
										->group_by('kode_bgtproj,nm_bgtproj')
										->get('db_bgtproj_update')->result();
							break;
					case 'totalbgt':
							$sql = $this->db->select('sum(nilai_bgtproj) nama')
										->where('kode_bgtproj',$parent_id)
										->get('db_bgtproj_update')->result();
							break;
					case 'scost' :
					    $sql = $this->db->select('c.id_scostproj id,c.nm_scost nama')
										->join('db_sbgtproj b','a.project_id = b.id_hbgbtproj')
										->join('db_costproj c','b.id_scostproj = c.id_scostproj')
										->where('project_id',$parent_id)
										->get('db_hbgtproject a')->result();	
						break;
					case 'sscost' :
						$sql = $this->db->select('id_ssubbgtproj id,nm_ssubbgtproj nama')
										->where('id_scostproj',$parent_id)
										->get('db_ssubbgtproj')->result();
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
						

		
	
	}

