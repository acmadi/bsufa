<?php
	class mrr extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('barangmasuk_model');
			$this->set_page_title('Material Receipt');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/mrr';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->id = $session_id['id'];
			$this->pt = $session_id['id_pt'];
			$this->div = $session_id['divisi_id'];
			
		}
		
		protected function setup_form($data=false){
			//Pengecekan No MRR
			$pt = $this->pt;
			$div = $this->div;
			$chkmrr = $this->db->query("sp_cek_mrr_no '".$pt."','".$div."'")->row();
			$this->parameters['no_mrr'] = $chkmrr->no_mrr;
		}

		function get_json(){
			$this->set_custom_function('kirm_tgl','indo_date');
			$this->set_custom_function('tgl_po','indo_date');
			parent::get_json();
		}		
		
		function index(){
			$this->set_grid_column('BrgPOH_ID','POH',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('reff_pr','Reff PR',array('width'=>120,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_po','No.PO',array('width'=>120,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_po','Tgl.PO',array('width'=>90,'formatter' => 'cellColumn'));
			$this->set_grid_column('kirm_tgl','Kirim Tgl.',array('width'=>90,'formatter' => 'cellColumn'));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>70,'formatter' => 'cellColumn'));
			$this->set_grid_column('ket_po','Keterangan',array('width'=>150,'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supp','Supplier',array('width'=>90,'formatter' => 'cellColumn'));
			$this->set_grid_column('up_supp','PIC Supplier',array('width'=>90,'formatter' => 'cellColumn'));
			$this->set_grid_column('up_supp','Outstanding Item',array('width'=>90,'formatter' => 'cellColumn'));
			$this->set_grid_column('status_pr','Status PR',array('hidden'=>true,'width'=>30,'formatter' => 'cellColumn'));			
			$this->set_jqgrid_options(array('width'=>1300,'height'=>400,'caption'=>'Material Receipt','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		function get_dg($idpo){
			$ckdata = $this->db->select('BrgPOD_ID,BrgPOH_ID,kd_brg,nm_brg,qty,satuan,qtybuy')
							   ->where('BrgPOH_ID',$idpo)
							   ->get('db_barangpod')->result();
			$data = array();
			foreach($ckdata as $row){
				$sisa = $row->qty - $row->qtybuy;
				$data[] = array 
				(
					'id' => $row->BrgPOD_ID,
					'kode' => $row->kd_brg,
					'brg' => $row->nm_brg,
					'qty_po' => number_format($row->qty),
					'out_po' => number_format($sisa),
					'qty_rc' => number_format($row->qtybuy),
					'satuan' => $row->satuan,
					'masuk' => ''
				);
			}
			die(json_encode($data));exit;
			
		}
		
		function show_mrr($idpo){
			$this->load->view('procurement/show_mrr');
		}
		
		
		//CRUD GRID
		function save_dg($id){
			$kode = $_REQUEST['kode'];
			$brg = $_REQUEST['brg'];
			$qty_po = $_REQUEST['qty_po'];
			$qty_rc = replace_numeric($_REQUEST['qty_rc']);
			$out_po = $_REQUEST['out_po'];
			$satuan = $_REQUEST['satuan'];
			$masuk = replace_numeric($_REQUEST['masuk']);
			
			$qtybuy =  $qty_rc + $masuk;
			
		
			
			$data = array 
				(
					'qtybuy' => replace_numeric($qtybuy),
					'qty_real' => replace_numeric($masuk)
				);
				
			/*$fdata = array 
			(
				'BrgPOD_ID' =>
				'BrgPOH_ID' =>
				'Reff_Tgl' =>
				'Reff_Type' =>
				'kd_brg' =>
				'nm_brg' =>
				'satuan' =>
				'qtyPO' =>
				'qtyMsk' =>
				'user_input' =>
				'tgl_input' =>
				'nm_input' =>
				'user_edit' =>
				'user_hapus' =>
				'tgl_mrr' =>
				'no_mrr' =>
			);*/
			
			
				// $this->db->where('id_subproject',$subproject);
				// $this->db->update('db_salesplan',$data);
			
			//$this->db->insert('db_barangpomsk',$fdata);
			
			// $this->db->where('BrgPOD_ID',$id);
			$this->db->where('brgpod_id',$id);
			$this->db->update('db_barangpod',$data);
			
            //Save MRR
            //sp_insert_mrr
			
			//Menampilkan di JSON
			$xtampil = array 
				(
					 'kode' => $kode,
					 'brg' => $brg,
					 'qty_po' => $qty_po,
					 'out_po' => $out_po,
					 'qty_rc' => $qtybuy,
					 'satuan' => $satuan,				
					 'masuk' => $masuk 				
				);
			die(json_encode($xtampil));
		}		
		
		
		function saveall(){
			extract(PopulateForm());
            //var_dump($idpoh);exit;
            //die ($reff_date.' '.$no_mrr);
			$id = $this->id;
			$user = $this->user;
			$this->db->query("sp_insert_mrr ".$idpoh.",'".$reff_type."','".inggris_date($reff_date)."','".inggris_date($tgl_mrr)."'
						,'".$no_mrr."',".$id.",'".$user."'");
			redirect("mrr");
		}
		
		
		function closemrr($id){
			$cek = $this->db->where('BrgPOH_ID',$id)
							->get('db_barangpoh')->row();
			
			
			$data = array 
			(
				'status_pr' => 6
			);
			$this->db->where('id_pr',$cek->id_pr);
			$this->db->update('db_pr',$data);	
			
			$datax = array
			(
				'isLockMR' => 1
			);
			
			$this->db->where('BrgPOH_ID',$id);
			$this->db->update('db_barangpoh',$datax);	
			redirect('procurement/mrr_call');		
		}
		

			
		
					
}

